@extends('layouts.master_bootstrap')

@section('title'){{ (isset($title)) ? $title : 'Lost Password' }}@endsection

@section('header')
@endsection

@section('content')
<div class="container pt-5">
    <div class="jumbotron alert-primary">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="container pb-2">
                    <h3 class="text-center">Lost Password</h3>
                </div>
                {!! form_open(base_url('OAuth/lost_pass'), array('accept-charset' => 'ISO-8859-1')) !!}
                <div class="form-group">
                    <label for="email">Enter Your Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" {!! placeholder_helper('Email') !!} autocomplete="off" value="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send Request</button>
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
@endsection