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
                    
                    <h4 class="header-title mt-0 mb-3">Create Delivery Boy</h4>
                    
                    <form method="post" action="{{url('/add_delivery_boy')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Name</label>
                        <input type="text" name="name" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('name')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Contact</label>
                        <input type="text" name="contact" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('contact')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Email</label>
                        <input type="text" name="email" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('email')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Password</label>
                        <input type="text" name="password" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('password')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Address</label>
                        <input type="text" name="address" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('address')}}</p>
                    </div>
                    
                    <div class="form-group row m-t-20">
                        <div class="col-12 text-center">
                            <button class="btn btn-success w-md waves-effect waves-light" type="submit">Add Delivery Boy</button>
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