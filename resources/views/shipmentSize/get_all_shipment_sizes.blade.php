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
                    
                    <h4 class="header-title mt-0 mb-3">Shipment Sizes</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Name</th>
                                   <th>Measuring Unit</th>
                                   <th>Length</th>
                                   <th>Width</th>
                                   <th>Height</th>
                                   <th>Chargeable Weight</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 0;?>
                                @foreach($shipment_sizes as $data)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->measuring_unit}}</td>
                                    <td>{{$data->length}} cm</td>
                                    <td>{{$data->width}} cm</td>
                                    <td>{{$data->height}} cm</td>
                                    <td>{{$data->chargeable_weight}} kg</td>
                                    <td>
                                        <a href="{{url('/edit_shipment_size/'.$data->id)}}" title="Edit Shipment Size" class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                                        <a href="{{url('/delete_shipment_size/'.$data->id)}}" title="Delete Shipment Size" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
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