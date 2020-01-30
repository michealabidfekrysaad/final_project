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
                    <a class="nav-link " id="notification-tab" data-toggle="tab" href="#notification" role="tab" aria-controls="notification" aria-selected="true">Notification - {{count($notifications)}}</a>
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
                    <div class="tab-pane fade show active bg-white" id="notification" role="tabpanel" aria-labelledby="notification-tab">

                        <div class="row">
                            @foreach($notifications as $notification)
                                <span>View Result For Last Search </span>
                                <a href="/viewResultFromNotification/{{$notification['id']}}" >View Results</a>
                                <a href="/readNotification/{{$notification['id']}}" >Make As Read</a>
                                @endforeach

                    </div>
                    </div>
                    <div class="tab-pane fade bg-white" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">

                            <div class="col-lg-4 col-md-6">
                                <div class="hotel text-center">
                                    <a href="{{ url('/people/details') }}">
                                        <div class="hotel-img">
                                            <img src="{{asset('img/speakers/1.jpg')}}" alt="Hotel 1" class="img-fluid">
                                        </div>

                                        <h3><a href="{{ url('/people/details') }}">ahmed</a></h3>

                                        <p>5 mins ago</p>
                                        <p>the type of the report</p>
                                        <p>5 mins ago</p>
                                    </a>
                                    @foreach($report as $repo)
                                <a class="btn btn-primary" href="/edit/{{$repo->id}}">Update Report</a>
                                @endforeach
                                    <button class="btn btn-danger" href="">delete</button>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
