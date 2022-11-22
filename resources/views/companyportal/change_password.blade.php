@extends('layouts.customer_master')
@section('content')
<div class="container-fluid">
    <div class="row" style="margin: 20px;">
        <div class="col-12">
            <div class="card">
                <div class="card-body order-list">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h4 class="page-title">Change Password</h4>
                    <form class="form-horizontal" method="POST" action="{{ url('customer_change_password_submit') }}">
                        {{ csrf_field() }}
                        <input id="company_id" type="hidden" class="form-control" name="company_id" value="{{Auth::guard('sender_infos')->user()->id}}">
                        <div class="form-group{{ $errors->has('currentpassword') ? ' has-error' : '' }}">
                            <label for="new-password" >Current Password</label>
                            <input id="currentpassword" type="password" class="form-control" name="currentpassword" value="{{old('currentpassword')}}">
                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('currentpassword') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                            <label for="new-password" >New Password</label>
                            <input id="newpassword" type="password" class="form-control" name="newpassword" value="{{old('newpassword')}}">
                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('newpassword') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirm">Confirm New Password</label>
                            <input id="newpassword-confirm" type="password" class="form-control" name="newpassword_confirmation" value="{{old('newpassword_confirmation')}}">
                        </div>
                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection