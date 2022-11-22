@extends('layouts.customer_master')

@section('content')

<link rel="stylesheet" href="{{ asset('public/assets/plugins/jquery-steps/jquery.steps.css') }}">

<div class="container-fluid">
    <div class="row" style="margin:20px">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div id="alertDiv">
                        @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                        @endif
                        @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                        @endif
                    </div>
                    <h4 class="header-title mt-0 mb-3">Order Details</h4>
                    
                    <div class="row mt-4 ml-2 mb-4">
                        <h5>Barcode</h5>
                        <div class="col-md-12">
                            {!! DNS1D::getBarcodeHTML($order->order_id, "C128",1.4,30) !!}
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <h5>Order Information</h5>
                            <div class="row mt-4 ml-4 mb-4">
                                <div class="col-md-4">
                                    <p>Order Id</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->order_id}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Shipment Method</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->shipment_method}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Service Type</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->service_type}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>COD Amount</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->cod}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Description</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->description}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Paid By</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->paid_by}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Order Status</p>
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        @if($order->status == 1)
                                        To be picked Up
                                        @elseif($order->status == 2)
                                        To Be Delivered
                                        @elseif($order->status == 3)
                                        Lost & Damages
                                        @elseif($order->status == 4)
                                        Delivered
                                        @elseif($order->status == 5)
                                        To Be Returned
                                        @elseif($order->status == 6)
                                        RTOS
                                        @elseif($order->status == 7)
                                        Cancelled
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Parcel Information</h5>
                            <div class="row mt-4 ml-4 mb-4">
                                <div class="col-md-4">
                                    <p>Reference Id</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->refrence_id}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Description</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->parcel_info->item_description}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Item Value</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->parcel_info->item_value}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Length</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->parcel_info->length}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Width</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->parcel_info->width}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Height</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->parcel_info->height}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Actual Weight</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->parcel_info->actual_weight}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Chargeable Weight</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->parcel_info->chargeable_weight}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Parcel Size Type</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->shipment_size->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <h5>Sender Information</h5>
                            <div class="row mt-4 ml-4 mb-4">
                                <div class="col-md-4">
                                    <p>Name</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Email</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->email}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Phone Number</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->phone_code}} {{$order->sender_info->phone_number}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Residential Type</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->residential_type}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Office/Appartment</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->office_apartment}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Building/Villa</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->building_villa}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Street</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->street}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Address</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->address}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Region</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->region}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>City</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->city}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Country</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->country}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Nearest Land Mark</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->sender_info->nearest_land_mark}}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Receiver Information</h5>
                            <div class="row mt-4 ml-4 mb-4">
                                <div class="col-md-4">
                                    <p>Name</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->receipt_name}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Email</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->receipt_email}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Phone Number</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->phone_code}} {{$order->drop_off_location->phone_number}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Residential Type</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->address_type}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Office/Appartment</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->office_apartment}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Building/Villa</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->building_villa}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Street</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->street}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Address</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->address}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Region</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->region}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>City</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->city}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Country</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->country}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Nearest Land Mark</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->drop_off_location->nearest_land_mark}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <h5>Delivery Boy Information</h5>
                            @if($order->delivery_boy_id == 0)
                                <div class="row mt-4 ml-4 mb-4">
                                    <div class="col-md-12">
                                        <span class="badge badge-warning">No delivery boy assigned yet..!</span>
                                    </div>
                                </div>
                            @else
                                <div class="row mt-4 ml-4 mb-4">
                                    <div class="col-md-4">
                                        <p>Name</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{$order->delivery_boy->name}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Email</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{$order->delivery_boy->email}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Phone Number</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{$order->delivery_boy->contact}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Address</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{$order->delivery_boy->address}}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Extra Information</h5>
                            <div class="row mt-4 ml-4 mb-4">
                                <div class="col-md-4">
                                    <p>Is Fragile</p>
                                </div>
                                <div class="col-md-8">
                                    <p>
                                        @if($order->is_fragile == 1)
                                        Parcel is Fragile
                                        @else
                                        Parcel is not Fragile
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>Quantity</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->quantity}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Alternate Phone 1</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->alternate_phone1}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>Alternate Phone 2</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->alternate_phone2}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p>If Receiver not available</p>
                                </div>
                                <div class="col-md-8">
                                    <p>{{$order->not_delivered}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script src="{{ asset('public/assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('public/assets/pages/jquery.form-wizard.init.js') }}"></script>

<script>
    $(document).ready( function() {
        $('#alertDiv').delay(3000).slideUp(1200);
    });
    
</script>
<script>

    function checkcod()
    {
        var cod = document.getElementById('cod').checked;
        
        if(cod)
        {
            document.getElementById("amount_div").style.visibility = "visible";
        }
        else
        {
            document.getElementById("amount_div").style.visibility = "hidden";
        }
    }
    
    function get_sender_info(){
        
        var senderId = document.getElementById('sender').value;
        var _token = $('input[name=_token]').val();
        
        $.ajax(
        {
            url: "{{ url('get_sender_all_info') }}",
            method: 'post',
            data: {  _token: _token,id:senderId },
            success: (response) => 
            {
                $('#sender_email').val(response.company.email);
                $('#sender_phone_code').val(response.company.phone_code);
                $('#sender_phone_number').val(response.company.phone_number);
                $('#sender_country').val(response.company.country);
                $('#sender_city').val(response.company.city);
                $('#sender_region').val(response.company.region);
                $('#sender_street').val(response.company.street);
                $('#sender_address').val(response.company.address);
                $('#sender_building_villa').val(response.company.building_villa);
                $('#sender_office_appartment').val(response.company.office_apartment);
                $('#sender_residential_type').val(response.company.residential_type);
                $('#sender_nearest_land_mark').val(response.company.nearest_land_mark);
            },
            error: (error) => {
                console.log(error)
            }
        })
        
    }

</script>


@endpush