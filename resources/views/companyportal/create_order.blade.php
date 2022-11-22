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
                    <h4 class="header-title mt-0 mb-3">Create Order</h4> 
                    <form id="form-horizontal" class="form-horizontal form-wizard-wrapper" method="post" action="{{url('/customer_add_order')}}" enctype="multipart/form-data">
                    @csrf
                         
                        <h3>Sender</h3>
                        <fieldset>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender" class="col-lg-3 col-form-label">Sender <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="sender_name" id="sender_name" required disabled value="{{$companies->name}}">
                                            <input type="hidden" value="{{$companies->id}}" name="sender">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_email" class="col-lg-3 col-form-label">Email <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="sender_email" name="sender_email" type="email" class="form-control" value="{{$companies->email}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_phone_number" class="col-lg-3 col-form-label">Phone Number <span style="color:red">*</span></label>
                                        <div class="col-lg-2">
                                            <input id="sender_phone_code" name="sender_phone_code" type="text" class="form-control" value="{{$companies->phone_code}}" required disabled>
                                        </div>
                                        <div class="col-lg-7">
                                            <input id="sender_phone_number" name="sender_phone_number" type="text" class="form-control" value="{{$companies->phone_number}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_residential_type" class="col-lg-3 col-form-label">Residential Type <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="sender_residential_type" name="sender_residential_type" type="text" class="form-control" value="{{$companies->residential_type}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_office_appartment" class="col-lg-3 col-form-label">Office/Apartment</label>
                                        <div class="col-lg-9">
                                            <input id="sender_office_appartment" name="sender_office_appartment" type="text" class="form-control" value="{{$companies->office_apartment}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_building_villa" class="col-lg-3 col-form-label">Building/Villa</label>
                                        <div class="col-lg-9">
                                            <input id="sender_building_villa" name="sender_building_villa" type="text" class="form-control" value="{{$companies->building_villa}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_street" class="col-lg-3 col-form-label">Street</label>
                                        <div class="col-lg-9">
                                            <input id="sender_street" name="sender_street" type="text" class="form-control" value="{{$companies->street}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_address" class="col-lg-3 col-form-label">Address <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="sender_address" name="sender_address" type="text" class="form-control" value="{{$companies->address}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_region" class="col-lg-3 col-form-label">Region</label>
                                        <div class="col-lg-9">
                                            <input id="sender_region" name="sender_region" type="text" class="form-control" value="{{$companies->region}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_city" class="col-lg-3 col-form-label">City <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="sender_city" name="sender_city" type="text" class="form-control" value="{{$companies->city}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_country" class="col-lg-3 col-form-label">Country <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="sender_country" name="sender_country" type="text" class="form-control" value="{{$companies->country}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="sender_nearest_land_mark" class="col-lg-3 col-form-label">Nearest Land Mark</label>
                                        <div class="col-lg-9">
                                            <input id="sender_nearest_land_mark" name="sender_nearest_land_mark" type="text" class="form-control" value="{{$companies->nearest_land_mark}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                        <h3>Receiver</h3>
                        <fieldset>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_name" class="col-lg-3 col-form-label">Recipient Name <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="receiver_name" name="receiver_name" type="text" class="form-control" required >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="reference_id" class="col-lg-3 col-form-label">Reference ID</label>
                                        <div class="col-lg-9">
                                            <input id="reference_id" name="reference_id" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_phone_number" class="col-lg-3 col-form-label">Phone Number <span style="color:red">*</span></label>
                                        <div class="col-lg-2">
                                            <input id="receiver_phone_code" name="receiver_phone_code" type="text" class="form-control" required >
                                        </div>
                                        <div class="col-lg-7">
                                            <input id="receiver_phone_number" name="receiver_phone_number" type="text" class="form-control" required >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_email" class="col-lg-3 col-form-label">Recepient Email</label>
                                        <div class="col-lg-9">
                                            <input id="receiver_email" name="receiver_email" type="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_residential_type" class="col-lg-3 col-form-label">Residential Type</label>
                                        <div class="col-lg-9">
                                            <select name="receiver_residential_type" class="form-control">
                                                <option value="">Select Residential Type</option>
                                                <option value="Residential">Residential</option>
                                                <option value="Bussiness">Bussiness</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_office_appartment" class="col-lg-3 col-form-label">Office/Apartment</label>
                                        <div class="col-lg-9">
                                            <input id="receiver_office_appartment" name="receiver_office_appartment" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_building_villa" class="col-lg-3 col-form-label">Building/Villa</label>
                                        <div class="col-lg-9">
                                            <input id="receiver_building_villa" name="receiver_building_villa" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_street" class="col-lg-3 col-form-label">Street</label>
                                        <div class="col-lg-9">
                                            <input id="receiver_street" name="receiver_street" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_address" class="col-lg-3 col-form-label">Address <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="receiver_address" name="receiver_address" type="text" class="form-control" required >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_region" class="col-lg-3 col-form-label">Region</label>
                                        <div class="col-lg-9">
                                            <input id="receiver_region" name="receiver_region" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_city" class="col-lg-3 col-form-label">City <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="receiver_city" name="receiver_city" type="text" class="form-control" required >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_country" class="col-lg-3 col-form-label">Country <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="receiver_country" name="receiver_country" type="text" class="form-control" required >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="receiver_nearest_land_mark" class="col-lg-3 col-form-label">Nearest Land Mark</label>
                                        <div class="col-lg-9">
                                            <input id="receiver_nearest_land_mark" name="receiver_nearest_land_mark" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                        <h3>Parcel Info</h3>
                        <fieldset>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="item_description" class="col-lg-3 col-form-label">Item Description</label>
                                        <div class="col-lg-9">
                                            <input id="item_description" name="item_description" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="item_value" class="col-lg-3 col-form-label">Item Value <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="item_value" name="item_value" type="number" min="0.01" step="0.01" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="length" class="col-lg-3 col-form-label">Length <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="length" name="length" type="number" min="0.01" step="0.01" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="width" class="col-lg-3 col-form-label">Width <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="width" name="width" type="number" min="0.01" step="0.01" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="height" class="col-lg-3 col-form-label">Height <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="height" name="height" type="number" min="0.01" step="0.01" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="actual_weight" class="col-lg-3 col-form-label">Actual Weight <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="actual_weight" name="actual_weight" type="number" min="0.01" step="0.01" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="chargeable_weight" class="col-lg-3 col-form-label">Chargeable Weight <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="chargeable_weight" name="chargeable_weight" type="number" min="0.01" step="0.01" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="shipment_method" class="col-lg-3 col-form-label">Shipment Method <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <select id="shipment_method" name="shipment_method" class="form-control" required>
                                                <option value="">Select Shipment Method</option>
                                                <option value="Domestic">Domestic</option>
                                                <option value="International">International</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="service_type" class="col-lg-3 col-form-label">Service Type <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <select id="service_type" name="service_type" class="form-control" required>
                                                <option value="">Select Service Type</option>
                                                <option value="Standard">Standard</option>
                                                <option value="Urgent">Urgent</option>
                                                <option value="Next Day">Next Day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h3>Cash</h3>
                        <fieldset>
                            
                            <div class="row ml-4">
                                <div class="col-md-6 ml-4">
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cod" name="cod" onclick="checkcod()">
                                                <label class="custom-control-label" for="cod">COD</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row" style="visibility:hidden" id="amount_div">
                                        <label for="ddlCreditCardType" class="col-lg-3 col-form-label">Amount <span style="color:red">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="amount" name="amount" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                        <h3>Extra Info</h3>
                        <fieldset>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="description" class="col-lg-3 col-form-label">Description</label>
                                        <div class="col-lg-9">
                                            <input id="description" name="description" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="not_delivered" class="col-lg-3 col-form-label">If Recepient not available</label>
                                        <div class="col-lg-9">
                                            <select id="not_delivered" name="not_delivered" class="form-control">
                                                <option value="">Please Select An Option</option>
                                                <option value="Donot Deliver">Donot Deliver</option>
                                                <option value="Leave At Door">Leave At Door</option>
                                                <option value="Leave With Concierge">Leave With Concierge</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="paid_by" class="col-lg-3 col-form-label">Paid By</label>
                                        <div class="col-lg-9">
                                            <select id="paid_by" name="paid_by" class="form-control">
                                                <option value="">Please Select An Option</option>
                                                <option value="Sender">Sender</option>
                                                <option value="Receiver">Receiver</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="alternate_phone1" class="col-lg-3 col-form-label">Alternate Phone 1</label>
                                        <div class="col-lg-9">
                                            <input id="alternate_phone1" name="alternate_phone1" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="alternate_phone2" class="col-lg-3 col-form-label">Alternate Phone 2</label>
                                        <div class="col-lg-9">
                                            <input id="alternate_phone2" name="alternate_phone2" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="quantity" class="col-lg-3 col-form-label">Quantity</label>
                                        <div class="col-lg-9">
                                            <input id="quantity" name="quantity" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row ml-4">
                                <div class="col-md-6 ml-4">
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="is_fragile" name="is_fragile" value="1">
                                                <label class="custom-control-label" for="is_fragile">Parcel is Fragile</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                    </form>
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