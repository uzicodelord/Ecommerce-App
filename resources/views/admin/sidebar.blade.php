<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ url('/redirect') }}"><img src="{{ asset('home/images/logo2.png') }}" style="width: 300px;height: 50px"  alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{ url('/redirect') }}"><img src="{{ asset('home/images/logo1.png') }}" alt="logo" style="width: 50px;height: 50px" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/redirect') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('viewProduct') }}">
              <span class="menu-icon">
                <i class="mdi mdi-view-carousel"></i>
              </span>
                <span class="menu-title">Add a Product</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('showProduct') }}">
              <span class="menu-icon">
                <i class="mdi mdi-hanger"></i>
              </span>
                <span class="menu-title">Show Products</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('view_category') }}">
              <span class="menu-icon">
                <i class="mdi mdi-shape"></i>
              </span>
                <span class="menu-title">Categories</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('orders') }}">
              <span class="menu-icon">
                <i class="mdi mdi-border-all"></i>
              </span>
                <span class="menu-title">Orders</span>
            </a>
        </li>
    </ul>
</nav>
