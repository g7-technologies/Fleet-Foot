<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ url('resturant_dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('public/images/woke_sheap_logo.png') }}" alt="logo-small" width="80">
            </span>
        </a>
    </div>
    <!--end logo-->
    <!-- Navbar -->
    <nav class="navbar-custom">    
        <ul class="list-unstyled topbar-nav float-right mb-0"> 
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    
                <img src="{{ asset('public/images/user.png')}}" height="80" class="mr-4" alt="...">
                    <span class="ml-1 nav-user-name hidden-sm">{{ Auth::guard('sender_infos')->user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{url('/customer_change_password')}}"><i class="fa fa-lock text-muted mr-2"></i> Change Password  </a>
                    <form action="{{ url('/customer_logout') }}" method="get">
                    <button type="submit" class="dropdown-item"><i class="dripicons-exit text-muted mr-2"></i> Logout</button>
                    </form>
                </div>
            </li>
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="dripicons-menu nav-icon"></i>
                </button>
            </li>
            
        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->