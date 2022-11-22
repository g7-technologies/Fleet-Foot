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
                    
                    <h4 class="header-title mt-0 mb-3">Get All Bank Details</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Company Name</th>
                                   <th>Company Email</th>
                                   <th>Company Phone</th>
                                   <th>Account Number</th>
                                   <th>Account Title</th>
                                   <th>Bank Name</th>
                                   <th>Branch Name</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($bank_details as $data)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$data->sender_details->name}}</td>
                                    <td>{{$data->sender_details->email}}</td>
                                    <td>{{$data->sender_details->phone_code}} {{$data->sender_details->phone_number}}</td>
                                    <td>{{$data->account_number}}</td>
                                    <td>{{$data->account_title}}</td>
                                    <td>{{$data->bank_name}}</td>
                                    <td>{{$data->branch}}</td>
                                    <td>
                                        <a href="{{url('/edit_bank_details/'.$data->id)}}" title="Edit Bank Details" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                                        <a href="{{url('/delete_bank_details/'.$data->id)}}" title="Delete Bank Details" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
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