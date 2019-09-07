@extends('layouts.master_bootstrap')

@section('title'){{ (isset($title)) ? $title : '' }}@endsection

@section('header')
@endsection

@section('content')

<div class="container pt-5">
    <div class="jumbotron alert-primary">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="container pb-2">
                    <h3 class="text-center">Login Form</h3>
                </div>
                {!! form_open(base_url('OAuth/signin'), array('accept-charset' => 'ISO-8859-1')) !!}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" {!! placeholder_helper('Email') !!} autocomplete="off" value="">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" {!! placeholder_helper('Password') !!} autocomplete="off" value="">
                    <input type="hidden" id="return_password" name="password" readonly>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="encLog()">Sign In</button>
                    <a href="{{ base_url() }}lost_pass" class="btn btn-primary">Lost Password</a>
                    <a href="{{ base_url() }}register" class="btn btn-primary">Register</a>
                </div>
                {!! form_close() !!}
            </div>
            <div class="col-12 col-lg-7">
                {{ get_flashdata() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/node-forge@0.7.0/dist/forge.min.js"></script>
<script src="{{ asset_js('login_register') }}"></script>
@endsection