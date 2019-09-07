@extends('layouts.master_bootstrap')

@section('title'){{ (isset($title)) ? $title : 'Apps Register' }}@endsection

@section('header')
@endsection

@section('content')
<div class="container pt-5">
    <div class="jumbotron alert-primary">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="container pb-2">
                    <h3 class="text-center">Register Form</h3>
                </div>
                {!! form_open(base_url('OAuth/register'), array('accept-charset' => 'ISO-8859-1')) !!}
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" {!! placeholder_helper('Full Name') !!}>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" {!! placeholder_helper('Email') !!}>
                </div>
                <div class="form-group">
                    <label for="passwd_a">Password</label>
                    <input type="password" class="form-control" id="passwd_a" {!! placeholder_helper('Password') !!}>
                    <input type="hidden" id="return_passwd_a" name="password">
                </div>
                <div class="form-group">
                    <label for="passwd_b">Password Verify</label>
                    <input type="password" class="form-control" id="passwd_b" {!! placeholder_helper('Password Verify') !!}>
                    <input type="hidden" id="return_passwd_b" name="password_verify">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="encDaf()">Register</button>
                    <a href="{{ base_url() }}" class="btn btn-primary float-right">Sign In</a>
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