@extends('layouts.admin_master')

@section('content')

<div class="container-fluid">
    <div class="row" style="margin: 20px;">
        <div class="col-11">
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
                    
                    <h4 class="header-title mt-0 mb-3">Companies</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Name</th>
                                   <th>Phone Code</th>
                                   <th>Phone Number</th>
                                   <th>Email</th>
                                   <th>Country</th>
                                   <th>City</th>
                                   <th>Region</th>
                                   <th>Street</th>
                                   <th>Address</th>
                                   <th>Building/Villa</th>
                                   <th>Office/Apartment</th>
                                   <th>Residential Type</th>
                                   <th>Nearest Land Mark</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($companies as $data)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->phone_code}}</td>
                                    <td>{{$data->phone_number}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->country}}</td>
                                    <td>{{$data->city}}</td>
                                    <td>{{$data->region}}</td>
                                    <td>{{$data->street}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$data->building_villa}}</td>
                                    <td>{{$data->office_apartment}}</td>
                                    <td>{{$data->residential_type}}</td>
                                    <td>{{$data->nearest_land_mark}}</td>
                                    <td>
                                        <a href="{{url('/edit_company/'.$data->id)}}" title="Edit Company" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                                        <a href="{{url('/delete_company/'.$data->id)}}" title="Delete Company" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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