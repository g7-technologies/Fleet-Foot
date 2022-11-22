@extends('layouts.admin_master')
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
                    <form class="form-horizontal" method="POST" action="{{ url('change_password_submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" >Current Password</label>
                            <input id="current-password" type="password" class="form-control" name="current-password" value="{{old('current-password')}}">
                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" >New Password</label>
                            <input id="new-password" type="password" class="form-control" name="new-password" value="{{old('new-password')}}">
                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('new-password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirm">Confirm New Password</label>
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" value="{{old('new-password_confirmation')}}">
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