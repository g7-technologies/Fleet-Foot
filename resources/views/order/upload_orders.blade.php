@extends('layouts.admin_master')

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
                    <h4 class="header-title mt-0 mb-3">Upload Order</h4>
                    <div class="row mb-4 mt-4">
                        <span class="col-lg-12" style="text-align: right !important;">
                            <a href="{{asset('public/excel_file/upload-format.xlsx')}}" download>
                                <i class="dripicons-cloud-download fa-2x mr-5"></i>
                            </a>
                        </span>
                        <span class="col-lg-12" style="text-align: right !important;">
                            <a href="{{asset('public/excel_file/upload-format.xlsx')}}" download>
                                <span class="badge badge-success justify-content-center">Download Excel Format</span>
                            </a>
                        </span>
                    </div>
                    <form class="form-horizontal form-wizard-wrapper" method="post" action="{{url('/upload_excel_orders')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="package_type" class="col-lg-12 col-form-label" style="text-align: left !important;">Package Type <span style="color:red">*</span></label>
                                <div class="col-lg-12">
                                    <select class="form-control" name="package_type" id="package_type" onChange="get_product_type()" required>
                                        <option value="">Select Package Type</option>
                                        <option value="Domestic">Domestic</option>
                                        <option value="International">International</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="product_type" class="col-lg-12 col-form-label" style="text-align: left !important;">Product Type <span style="color:red">*</span></label>
                                <div class="col-lg-12">
                                    <select class="form-control" name="product_type" id="product_type" required>
                                        <option value="">Select Product Type</option>
                                    </select>
                                </div>
                            </div>
                                 
                            
                            <div class="form-group col-md-4">
                                <label for="batch_number" class="col-lg-12 col-form-label" style="text-align: left !important;">Batch Number <span style="color:red">*</span></label>
                                <div class="col-lg-12">
                                    <input id="batch_number" name="batch_number" type="text" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-3 ml-4 mt-2">
                                <label for="excel_file" class="col-lg-12 custom-file-label" style="text-align: left !important;">Bulk Upload File <span style="color:red">*</span></label>
                                <div class="col-lg-12">
                                    <input id="excel_file" name="excel_file" type="file" class="custom-file-input" required>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12 m-t-20">
                                <div class="col-12 text-center">
                                    <button class="btn btn-success w-md waves-effect waves-light" type="submit">Save Orders To System</button>
                                </div>
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
<script src="{{ asset('public/assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('public/assets/pages/jquery.form-wizard.init.js') }}"></script>

<script>
    $(document).ready( function() {
        $('#alertDiv').delay(3000).slideUp(1200);
    });
    
    function get_product_type()
    {
        var data = $("#package_type").val();
        
        if(data == 'Domestic')
        {
            $("#product_type option").remove();
            $("#product_type").append( "<option value=''>Select Domestic Package</option><option value='Domestic Document'>Domestic Document</option><option value='Domestic Non Dox Upto 30kg'>Domestic non DOX upto 30kg</option>" );
        }
        else if(data == 'International')
        {
            $("#product_type option").remove();
            $( "#product_type" ).append( "<option value=''>Select International Package</option><option value='Export Document'>Export Document</option><option value='Import Document'>Import Document</option><option value='Export Non Dox Upto 30kg'>Export Non Dox Upto 30kg</option><option value='Domestic Non Dox Above 30kg'>Domestic Non Dox Above 30kg</option>" );
        }
        
    }
    
</script>

@endpush