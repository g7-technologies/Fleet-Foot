<!-- Left Sidenav -->
<div class="left-sidenav">
    <div class="main-icon-menu">
        <nav class="nav">
            
            <a href="#Dashboard" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Dashboard">
                <i class="text-white mdi mdi-speedometer mdi-18px"></i>
            </a>
            
            <!--<a href="#Create_Order" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Create Order">-->
            <!--    <i class="text-white mdi mdi-plus-box mdi-18px"></i>-->
            <!--</a>-->
            
            <a href="#Create_Order" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Excel Order">
                <i class="text-white mdi mdi-plus-box mdi-18px"></i>
            </a>
            
            <a href="#Orders" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Orders">
                <i class="text-white mdi mdi-gift mdi-18px"></i>
            </a>
            
            <a href="#DeliveryBoy" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Delivery Boy">
                <i class="text-white mdi mdi-truck-fast mdi-18px"></i>
            </a>
            
            <a href="#Company" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Company">
                <i class="text-white mdi mdi-office-building mdi-18px"></i>
            </a>
            
            <a href="#ShipmentSizes" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Shipment Sizes">
                <i class="text-white mdi mdi-tape-measure mdi-18px"></i>
            </a> 
            
            <a href="#Bank" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Bank">
                <i class="text-white mdi mdi-bank mdi-18px"></i>
            </a>
            
            <a href="#Settings" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Settings">
                <i class="text-white mdi mdi-settings mdi-18px"></i>
            </a>
            
        </nav>
    </div>

    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            
            <div id="Dashboard" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Dashboard</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin_dashboard') }}">
                            <span class="w-100"> Dashboard</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
            
            
            <div id="Create_Order" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Excel Order</h6>       
                </div>
                <ul class="nav">
                    
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="{{url('/create_order')}}">-->
                    <!--        <span class="w-100">Create Order</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/upload_orders')}}">
                            <span class="w-100">Upload Excel Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
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
                        <a class="nav-link" href="{{url('/assign_delivery_boy')}}">
                            <span class="w-100">Unassigned Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/all_orders')}}">
                            <span class="w-100">All Orders</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/to_be_pickedup')}}">
                            <span class="w-100">To Be Picked Up</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/to_be_delivered')}}">
                            <span class="w-100">To Be Delivered</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/lost_and_damages')}}">
                            <span class="w-100">Lost & Damages</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/delivered')}}">
                            <span class="w-100">Delivered</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/to_be_returned')}}">
                            <span class="w-100">To Be Returned</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/rtos')}}">
                            <span class="w-100">RTOS</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/cancelled')}}">
                            <span class="w-100">Cancelled</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            
            
            <div id="DeliveryBoy" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Delivery Boy</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/create_delivery_boy')}}">
                            <span class="w-100">Create Delivery Boy</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/get_all_delivery_boys')}}">
                            <span class="w-100">View All Delivery Boys</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            
            
            <div id="Company" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Company</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/create_company')}}">
                            <span class="w-100">Create Company</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/get_all_companies')}}">
                            <span class="w-100">View All Companies</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>                   
                   
                </ul>
            </div>
            
            
            <div id="ShipmentSizes" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Shipment Sizes</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/create_shipment_size')}}">
                            <span class="w-100">Add Shipment Sizes</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>  
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/get_all_shipment_sizes')}}">
                           <span class="w-100">View Shipment Sizes</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            
            
            <div id="Bank" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Bank</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/create_bank')}}">
                            <span class="w-100">Create Bank</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/get_all_bank_details')}}">
                            <span class="w-100">View All Banks</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
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
                        <a class="nav-link" href="{{url('/change_password')}}">
                            <span class="w-100">Change Password</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/logout')}}">
                            <span class="w-100">Logout</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
            </div>
           
           
        </div>
    </div>
</div>