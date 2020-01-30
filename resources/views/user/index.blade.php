@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<section id="speakers-details" class="wow fadeIn pt-5">
    <div class="container  pt-5">
        <div class="card pt-2">
            <div class="card-header">
                Your Profile
            </div>
            <ul class="nav nav-tabs pt-3" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Your Reports</a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active bg-white" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->email}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->phone}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>City</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->city}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Region</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->region}}</p>
                            </div>
                        </div>
                        <a href="/edit/{{$profile->id}}" id="lostButton">
                            Update Profile
                        </a>
                    </div>
                    <div class="tab-pane fade bg-white" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                        @foreach($report as $repo)
                            <div class="col-lg-4 col-md-6">
                                <div class="hotel text-center">
                                    <a href="/showRepo/{{$repo->id}}">
                                        <div class="hotel-img">
                                            <img src="${element.image}" alt="Img Of Person" class="img-fluid">
                                        </div>
                                        <h3><a href="/showRepo/{{$repo->id}}">{{$repo->name}}</a></h3>
                                        <p>Age is :{{$repo->age}}</p>
                                        <span>last seen on :{{$repo->last_seen_on}}</span>

                                    </a>
                                    <div class="row justify-content-center">
                                    <a class="btn btn-primary" href="/edit/{{$repo->id}}">Update Report</a>
                                    <form action="/report/{{$repo->id}}" method="POST">
                                    @csrf 
                                    @method('Delete')
                                    <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection