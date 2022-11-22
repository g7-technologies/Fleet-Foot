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
                    
                    <h4 class="header-title mt-0 mb-3">Edit Shipment Size</h4>
                    
                    <form method="post" action="{{url('/update_shipment_size')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="id" value="{{$shipment_size->id}}" required>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$shipment_size->name}}" required>
                        <p class="text-danger"> {{$errors->first('name')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Measuring Unit</label>
                        <input type="text" name="measuring_unit" class="form-control" value="cm/kg" disabled>
                        <p class="text-danger"> {{$errors->first('measuring_unit')}}</p>
                    </div> 
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Length</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="length">cm</span>
                            </div>
                            <input type="number" name="length" class="form-control" min="1" max="10000" step="0.01" value="{{$shipment_size->length}}" aria-describedby="length" required>
                        </div>
                        <p class="text-danger"> {{$errors->first('length')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Width</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="width">cm</span>
                            </div>
                            <input type="number" name="width" class="form-control" min="1" max="10000" step="0.01" value="{{$shipment_size->width}}" aria-describedby="width" required>
                        </div>
                        <p class="text-danger"> {{$errors->first('width')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Height</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="height">cm</span>
                            </div>
                            <input type="number" name="height" class="form-control" min="1" max="10000" step="0.01" value="{{$shipment_size->height}}" aria-describedby="height" required>
                        </div>
                        <p class="text-danger"> {{$errors->first('height')}}</p>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="example-input2-group1">Chargeable Weight</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="chargeable_weight">kg</span>
                            </div>
                            <input type="number" name="chargeable_weight" class="form-control" min="1" max="10000" step="0.01" value="{{$shipment_size->chargeable_weight}}" aria-describedby="chargeable_weight" required>
                        </div>
                        <p class="text-danger"> {{$errors->first('chargeable_weight')}}</p>
                    </div>
                    
                    <div class="form-group row m-t-20">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Update Shipment Size</button>
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