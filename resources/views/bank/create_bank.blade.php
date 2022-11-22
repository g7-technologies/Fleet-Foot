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
                    
                    <h4 class="header-title mt-0 mb-3">Create Bank</h4>
                    
                    <form method="post" action="{{url('/add_bank_details')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Sender</label>
                        <select required class="form-control" name="sender_id">
                            <option value="">Select Sender</option>
                            @foreach($company as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                        <p class="text-danger"> {{$errors->first('sender_id')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Account Number</label>
                        <input type="text" name="account_number" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('account_number')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Account Title</label>
                        <input type="text" name="account_title" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('account_title')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('bank_name')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Bank Branch</label>
                        <input type="text" name="branch" class="form-control" required>
                        <p class="text-danger"> {{$errors->first('branch')}}</p>
                    </div>
                    
                    <div class="form-group row m-t-20">
                        <div class="col-12 text-center">
                            <button class="btn btn-success w-md waves-effect waves-light" type="submit">Add Bank Details</button>
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