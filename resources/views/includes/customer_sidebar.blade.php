<!-- Left Sidenav -->
<div class="left-sidenav">
    <div class="main-icon-menu">
        <nav class="nav">
            
            <a href="#Dashboard" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Dashboard">
                <i class="text-white mdi mdi-speedometer mdi-18px"></i>
            </a>
            
            <a href="#Create_Order" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Create Order">
                <i class="text-white mdi mdi-plus-box mdi-18px"></i>
            </a>
            
            <a href="#Orders" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Orders">
                <i class="text-white mdi mdi-gift mdi-18px"></i>
            </a>

            <a href="#Settings" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Settings">
                <i class="text-white mdi mdi-settings"></i>
            </a>

        </nav><!--end nav-->
    </div><!--end main-icon-menu-->

    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            <div id="Dashboard" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Customer Dashboard</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/customer_dashboard') }}">
                            <i class="dripicons-meter"></i><span class="w-100"> Dashboard</span> 
                        </a>
                    </li>
                </ul>
            </div>
            
            
            <div id="Create_Order" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Create Order</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_create_order/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">Create Order</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>
            
            
            <div id="Orders" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Orders</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_all_orders/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">All Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_to_be_pickedup/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">To Be Picked Up</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_to_be_delivered/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">To Be Delivered</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_lost_and_damages/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">Lost & Damages</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_delivered/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">Delivered</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_to_be_returned/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">To Be Returned</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_rtos/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">RTOS</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_cancelled/'.Auth::guard('sender_infos')->user()->id)}}">
                            <span class="w-100">Cancelled</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
            </div>

            <div id="Settings" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Settings</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_change_password')}}">
                            <span class="w-100">Change Password</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customer_logout')}}">
                            <span class="w-100">Logout</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                </ul>
            </div><!-- end Analytic -->                                        
           
        </div><!--end menu-body-->
    </div><!-- end main-menu-inner-->
</div>
<!-- end left-sidenav