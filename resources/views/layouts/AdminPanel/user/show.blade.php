@extends('layouts.AdminPanel.page')

@section('content')

<div class="card mt-5 w-75 mx-auto">
    <div class="card-header">
      User info is : 
    </div>
    <div class="card-body">
      <h4 class="card-title">Name:- {{$user->name}}</h4>
      <p class="card-title">Email:- {{$user->email}} </p>
      <p class="card-title">Email verified at:- {{$user->email_verified_at}}</p>
      <p class="card-title">Phone:- {{$user->phone}} </p>
      <p class="card-title">created_at:- {{$user->created_at}} </p>
      <p class="card-title">Ban:- BAN OR NOT </p>

      
        <a href="/admin/panel/userstable" class="btn btn-outline-info mt-2">Go Back To Table</a>
    </div>
  </div>

  @endsection