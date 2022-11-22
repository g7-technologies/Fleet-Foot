@extends('layouts.customer_master')

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
                    
                    <h4 class="header-title mt-0 mb-3">To Be Returned Orders</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Order Id</th>
                                   <th>Shipping Method</th>
                                   <th>Service Type</th>
                                   <th>Recepient Name</th>
                                   <th>Recepient Phone</th>
                                   <th>Parcel Status</th>
                                   <th>COD Amount</th>
                                   <th>Shipping Address</th>
                                   <th>Sender Name</th>
                                   <th>Sender Phone</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($orders as $data)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$data->order_id}}</td>
                                    <td>{{$data->shipment_method}}</td>
                                    <td>{{$data->service_type}}</td>
                                    <td>{{$data->drop_off_location->receipt_name}}</td>
                                    <td>{{$data->drop_off_location->phone_code}} {{$data->drop_off_location->phone_number}}</td>
                                    <td>
                                        @if($data->status == 1)
                                        To be picked Up
                                        @elseif($data->status == 2)
                                        To Be Delivered
                                        @elseif($data->status == 3)
                                        Lost & Damages
                                        @elseif($data->status == 4)
                                        Delivered
                                        @elseif($data->status == 5)
                                        To Be Returned
                                        @elseif($data->status == 6)
                                        RTOS
                                        @elseif($data->status == 7)
                                        Cancelled
                                        @endif
                                    </td>
                                    @if($data->cod == '' || $data->cod == null)
                                        <td><span class="label label-default">$0</span></td>
                                    @else
                                        <td>${{$data->cod}}</td>
                                    @endif
                                    <td>{{$data->drop_off_location->address}}, {{$data->drop_off_location->city}}, {{$data->drop_off_location->country}}</td>
                                    <td>{{$data->sender_info->name}}</td>
                                    <td>{{$data->sender_info->phone_code}} {{$data->sender_info->phone_number}}</td>
                                    <td>
                                        <a href="{{url('/customer_view_order_details/'.$data->id)}}" title="View Order Details" class="btn btn-outline-warning"><i class="fas fa-eye"></i></a>
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