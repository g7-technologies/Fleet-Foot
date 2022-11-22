@extends('layouts.admin_master')

@section('content')
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row" style="margin:20px">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body invoice-head"> 
                    <div class="row">
                        <div class="col-md-4 align-self-center">                                                
                            <img src="{{asset('public/images/woke_sheap_logo.png')}}" alt="logo-large" class="logo-lg logo-dark" height="50">
                            <p class="mt-2 mb-0 text-muted">If account is not paid within 7 days the credits details supplied as confirmation.</p>                                             
                        </div><!--end col-->    
                        <div class="col-md-8">
                                
                            <ul class="list-inline mb-0 contact-detail float-right">                                                   
                                <li class="list-inline-item">
                                    <div class="pl-3">
                                        <i class="mdi mdi-web"></i>
                                        <p class="text-muted mb-0">www.abcdefghijklmno.com</p>
                                        <p class="text-muted mb-0">www.qrstuvwxyz.com</p>
                                    </div>                                                
                                </li>
                                <li class="list-inline-item">
                                    <div class="pl-3">
                                        <i class="mdi mdi-phone"></i>
                                        <p class="text-muted mb-0">+123 123456789</p>
                                        <p class="text-muted mb-0">+123 123456789</p>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="pl-3">
                                        <i class="mdi mdi-map-marker"></i>
                                        <p class="text-muted mb-0">2821 Kensington Road,</p>
                                        <p class="text-muted mb-0">Avondale.</p>
                                    </div>
                                </li>
                            </ul>
                        </div><!--end col-->    
                    </div><!--end row-->     
                </div><!--end card-body-->
                <div class="card-body">
                    <div class="row mt-2 mb-4">
                        <div class="col-md-4">
                            <h6 class="mb-0"><b>Order Date :</b> <?php echo date_format($order->created_at,"Y-m-d"); ?></h6>
                            <h6><b>Order ID :</b> # {{$order->order_id}}</h6>
                        </div>
                        <div class="col-md-8 text-right">
                            {!! DNS1D::getBarcodeSVG($order->order_id, "C128",1.4,30) !!}
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="text-center bg-light p-3 mb-3 h-100">
                                <h5 class="bg-info mt-0 p-2 text-white d-sm-inline-block" style="width:100%">Sender</h5>
                                <h6 class="font-13">Name:</h6>
                                <p class="mb-0 text-muted">{{$order->sender_info->name}}</p>
                                <h6 class="font-13">Phone Number:</h6>
                                <p class="mb-0 text-muted">{{$order->sender_info->phone_code}} {{$order->sender_info->phone_number}}</p>
                                <h6 class="font-13">Email:</h6>
                                <p class="mb-0 text-muted">{{$order->sender_info->email}}</p>
                                <h6 class="font-13">Address:</h6>
                                <p class="mb-0 text-muted">
                                    {{$order->sender_info->building_villa}}, {{$order->sender_info->street}}<br>
                                    {{$order->sender_info->address}}<br>
                                    {{$order->sender_info->region}} {{$order->sender_info->city}}<br>
                                </p>
                            </div>                                              
                        </div>
                        
                        <div class="col-md-4">
                            <div class="text-center bg-light p-3 mb-3 h-100">
                                <h5 class="bg-info mt-0 p-2 text-white d-sm-inline-block" style="width:100%">Receiver</h5>
                                <h6 class="font-13">Name:</h6>
                                <p class="mb-0 text-muted">{{$order->drop_off_location->receipt_name}}</p>
                                <h6 class="font-13">Phone Number:</h6>
                                <p class="mb-0 text-muted">{{$order->drop_off_location->phone_code}} {{$order->drop_off_location->phone_number}}</p>
                                <h6 class="font-13">Email:</h6>
                                <p class="mb-0 text-muted">{{$order->drop_off_location->receipt_email}}</p>
                                <h6 class="font-13">Address:</h6>
                                <p class="mb-0 text-muted">
                                    {{$order->drop_off_location->building_villa}}, {{$order->drop_off_location->street}}<br>
                                    {{$order->drop_off_location->address}}<br>
                                    {{$order->drop_off_location->region}} {{$order->drop_off_location->city}}<br>
                                </p>
                            </div>                                              
                        </div>
                        
                        <div class="col-md-4">
                            <div class="text-center bg-light p-3 mb-3 h-100">
                                <h5 class="bg-info mt-0 p-2 text-white d-sm-inline-block" style="width:100%">Parcel Info</h5>
                                <h6 class="font-13">Shipment Method:</h6>
                                <p class="mb-0 text-muted">{{$order->shipment_method}}</p>
                                <h6 class="font-13">Service Type:</h6>
                                <p class="mb-0 text-muted">{{$order->service_type}}</p>
                                <h6 class="font-13">Weight:</h6>
                                <p class="mb-0 text-muted">{{$order->parcel_info->actual_weight}}</p>
                                <h6 class="font-13">Is Fragile:</h6>
                                <p class="mb-0 text-muted">
                                    @if($order->is_fragile == 1)
                                    Parcel is Fragile
                                    @else
                                    Parcel is not Fragile
                                    @endif
                                </p>
                                <h6 class="font-13">If Receiver not available:</h6>
                                <p class="mb-0 text-muted">{{$order->not_delivered}}</p>
                                <h6 class="font-13">COD Amount:</h6>
                                <p class="mb-0 text-muted">{{$order->cod}}</p>
                                
                            </div>                                              
                        </div>
                        
                    </div><!--end row-->

                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <h5 class="mt-4">Terms And Condition :</h5>
                            <ul class="pl-3">
                                <li><small class="font-12">All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                <li><small class="font-12">To be paid by cheque or credit card or direct payment online.</small ></li>
                                <li><small class="font-12"> If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.</small></li>                                            
                            </ul>
                        </div>
                        <div class="col-lg-7 align-self-end">
                            <div class="w-25 float-right mb-4">
                                <small>Account Manager</small>
                                <p class="border-top mt-4">Signature</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                            <div class="text-center"><small class="font-12">Thank you very much for doing business with us.</small></div>
                        </div><!--end col-->
                        <div class="col-lg-12 col-xl-4">
                            <div class="float-right d-print-none">
                                <a href="javascript:window.print()" class="btn btn-gradient-info"><i class="fa fa-print"></i></a>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

</div><!-- container -->
@endsection

@push('scripts')

@endpush