@extends('layouts.master_bootstrap')

@section('title'){{ (isset($title)) ? $title : 'Apps Home' }}@endsection

@section('header')
@endsection

@section('content')
@include('layouts.includes._navbar')
<section class="body pt-5">
    <div class="container">
        <div class="jumbotron alert-primary">
            <h3>Your Credentials</h3>
            <div class="jumbotron alert-light">
                <div class="form-group row">
                    <label for="userID" class="col-sm-2 col-form-label">User ID</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="userID" value="{{ $catchData['user_id'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="UserName" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="UserName" value="{{ $catchData['name'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="UserEmail" class="col-sm-2 col-form-label">User Email</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="UserEmail" value="{{ $catchData['email'] }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="UserToken" class="col-sm-2 col-form-label">User Token</label>
                    <div class="col-sm-10">
                        <textarea readonly class="form-control-plaintext" id="UserToken" cols="30" rows="3">{{ $catchData['token'] }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
@endsection