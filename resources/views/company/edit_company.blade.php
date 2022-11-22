@extends('layouts.admin_master')

@section('content')

<div class="container-fluid">
    <div class="row" style="margin: 20px;">
        <div class="col-12">
            <div class="card">
                <div class="card-body order-list">
                    
                    <div id="alertDiv">
                        @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                        @endif
                        @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                        @endif
                    </div>
                    
                    <h4 class="header-title mt-0 mb-3">Edit Company</h4>
                    
                    <form method="post" action="{{url('/update_company')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="id" class="form-control" value="{{$company->id}}" required>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$company->name}}" required>
                        <p class="text-danger"> {{$errors->first('name')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Phone Code</label>
                        <input type="text" name="phone_code" class="form-control" value="{{$company->phone_code}}" required>
                        <p class="text-danger"> {{$errors->first('phone_code')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Phone Number</label>
                        <input type="tel" name="phone_number" class="form-control" value="{{$company->phone_number}}" required>
                        <p class="text-danger"> {{$errors->first('phone_number')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$company->email}}" required>
                        <p class="text-danger"> {{$errors->first('email')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Update Password</label>
                        <input type="password" name="password" class="form-control">
                        <p class="text-danger"> {{$errors->first('password')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Country</label>
                        <input type="text" name="country" class="form-control" value="{{$company->country}}" required>
                        <p class="text-danger"> {{$errors->first('country')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">City</label>
                        <input type="text" name="city" class="form-control" value="{{$company->city}}" required>
                        <p class="text-danger"> {{$errors->first('city')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Region</label>
                        <input type="text" name="region" class="form-control" value="{{$company->region}}" required>
                        <p class="text-danger"> {{$errors->first('region')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Street</label>
                        <input type="text" name="street" class="form-control" value="{{$company->street}}" required>
                        <p class="text-danger"> {{$errors->first('street')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Address</label>
                        <input type="text" name="address" class="form-control" value="{{$company->address}}" required>
                        <p class="text-danger"> {{$errors->first('address')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Building/Villa</label>
                        <input type="text" name="building_villa" class="form-control" value="{{$company->building_villa}}" required>
                        <p class="text-danger"> {{$errors->first('building_villa')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Office Apartment</label>
                        <input type="text" name="office_apartment" class="form-control" value="{{$company->office_apartment}}" required>
                        <p class="text-danger"> {{$errors->first('office_apartment')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Residential Type</label>
                        <select name="residential_type" class="form-control" required>
                            <option value="">Select Residential Type</option>
                            @if($company->residential_type == 'Residential')
                                <option value="Residential" selected>Residential</option>
                                <option value="Bussiness">Bussiness</option>
                            @else
                                <option value="Residential">Residential</option>
                                <option value="Bussiness" selected>Bussiness</option>
                            @endif
                        </select>
                        <p class="text-danger"> {{$errors->first('residential_type')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Nearest Land Mark</label>
                        <input type="text" name="nearest_land_mark" class="form-control" value="{{$company->nearest_land_mark}}" required>
                        <p class="text-danger"> {{$errors->first('nearest_land_mark')}}</p>
                    </div>
                    
                    
                    <div class="form-group row m-t-20">
                        <div class="col-12 text-center">
                            <button class="btn btn-success w-md waves-effect waves-light" type="submit">Update Company</button>
                        </div>
                    </div>
        
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')

<script>
    $(document).ready( function() {
        $('#alertDiv').delay(3000).slideUp(1200);
    });
    
</script>

@endpush