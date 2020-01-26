@extends('layouts.app')
@section('content')
<div class="container pt-5">
    <form action="/update/{{$profile->id}}" method="POST">
    @csrf
    <div class="row pt-5">
        <div class="col-md-6 pt-2">
            <label>Name</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{$profile->name}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Email</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="email" value="{{$profile->email}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Phone</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="phone" value="{{$profile->phone}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>City</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="city" value="{{$profile->city}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Region</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="region" value="{{$profile->region}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit"  class="btn btn-danger" name="submit" value="Update"/>
        </div>
    </div>
    </form>
</div>
@endsection