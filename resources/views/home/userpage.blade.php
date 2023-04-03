<head>
<title>Uzi-Shop - Home</title>
    @include('home.css')
</head>
<body>
        @include('sweetalert::alert')
<div class="hero_area">
        <!-- header section strats -->
        <!-- end header section -->
        <!-- product section -->
        @include('home.product')

</div>

</body>
<footer class="" style="color: #fff; background-color: #404040;">
    <div class="container ">
        <div class="row">
            <div class="col-md-4">
                <div class="full">
                    <div class="logo_footer">
                        <a href="#"><img width="210" style="color: #fff" src="{{ asset('home/images/logo2.png') }}" alt="#" /></a>
                    </div>
                    <div class="information_f">
                        <p><strong>ADDRESS:</strong> North Macedonia, Skopje, Studenican</p>
                        <p><strong>TELEPHONE:</strong> +389 076 838 516</p>
                        <p><strong>EMAIL:</strong> uzinarco2@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="widget_menu">
                                    <h3>Account</h3>
                                    <br>
                                    <ul>
                                        <li><a href="{{ route('profile.show') }}" style="color: #fff">Profile</a></li>
                                        <li><a href="{{ url('login') }}" style="color: #fff">Login</a></li>
                                        <li><a href="{{ url('register') }}" style="color: #fff">Register</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="widget_menu">
                            <h3>Newsletter</h3>
                            <div class="information_f">
                                <p>Subscribe by our newsletter and get our latest products.</p>
                            </div>
                            <div class="form_sub">
                                <form>
                                    <fieldset>
                                        <div class="field">
                                            <input type="email" placeholder="Enter Your Mail" name="email" />
                                            <input type="submit" value="Subscribe" />
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="cpy_">
                                    <p class="mx-auto" style="font-size: 13px;">© 2023 All Rights Reserved By Uzi-Shop<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
