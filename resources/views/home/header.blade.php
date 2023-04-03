
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img width="250" src="{{ asset('home/images/logo2.png') }}" alt="#" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fa fa-home" id="home-link" href="{{ url('/') }}" style="font-size: 30px;"></a>
                    </li>
                    <li class="nav-item dropdown flex">
                        <a class="nav-link dropdown sss fa fa-th-large" href="#" id="categoryDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 30px;"></a>
                        <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                            <h5 class="dropdown-header" style="font-weight: bold;">Categories</h5>
                            <div class="dropdown-divider"></div>
                            @foreach($categories as $category)
                                <a class="dropdown-item category-link" href="{{ url('categories', $category->category_name) }}">{{ $category->category_name }}</a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fa fa-phone" id="contact-link" href="{{ url('contact') }}" style="font-size: 30px;"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fa fa-shopping-cart" id="cart-link" href="{{ url('cart') }}" style="font-size: 30px;"></a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown fa fa-user mdi mdi-account" href="#" id="accountDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 30px;"></a>
                                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                                    <h5 class="dropdown-header" style="font-weight: bold;">Manage Account</h5>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item" style="margin-left: 10px;">
                                <a class="nav-link fa fa-lock" id="login-link" style="font-size: 30px;" href="{{ route('login') }}"></a>
                            </li>

                            <li class="nav-item" style="margin-left: 10px;">
                                <a class="nav-link fa fa-unlock-alt" id="register-link" href="{{ route('register') }}" style="font-size: 30px;"></a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>

</header>

@include('home.script')
<script>
    $(document).ready(function () {
        $(".dropdown").on("hide.bs.dropdown", function () {
            $(this).find(".dropdown-menu").first().stop(true, true).slideUp(300);
        });

        $(".dropdown").on("show.bs.dropdown", function () {
            $(this).find(".dropdown-menu").first().stop(true, true).slideDown(300);
        });
    });

</script>

