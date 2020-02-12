@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
@if (session('message'))
<div class="alert alert-warning">{{ session('message') }}</div>
@endif
<section id="speakers-details" class="wow fadeIn pt-5">
    <div class="container mt-2  pt-5">
        <div class="card pt-2">
            <div class="card-header">
                {{ __('messages.Your Profile') }}
            </div>
            <ul class="nav nav-tabs pt-3" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('messages.About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="notification-tab" data-toggle="tab" href="#notification" role="tab" aria-controls="notification" aria-selected="true">{{ __('messages.Notification') }} - {{count($notifications)}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('messages.Your Reports') }}</a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active bg-white" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="row">
                            <div class="col-md-2">
                                <label> {{ __('messages.Name') }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ __('messages.Email') }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->email}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ __('messages.Phone') }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$profile->phone}}</p>
                            </div>
                        </div>

                        <div class="row justify-content-center">

                            <a href="/edit/{{$profile->id}}" id="lostButton">
                                {{ __('messages.Update Profile') }}
                            </a>

                        </div>
                    </div>
                    <div class="tab-pane fade show  bg-white" id="notification" role="tabpanel" aria-labelledby="notification-tab">

                        <div class="row">
                            @foreach($notifications as $notification)

                            <div class="col-12">
                                <h5>{{ __('messages.View Result For Last Search') }} </h5>
                                <a class="btn btn-primary" href="/viewResultFromNotification/{{$notification['id']}}">{{ __('messages.View Results') }}</a>
                                <a class="btn btn-danger" href="/readNotification/{{$notification['id']}}">{{ __('messages.Make As Read') }}</a>
                            </div>

                                <div class="col-12">
                                    <h5>View Result For Last Search </h5>
                                    <a class="btn btn-primary"
                                       href="/viewResultFromNotification/{{$notification['id']}}">View Results</a>
                                    <a class="btn btn-danger" href="/readNotification/{{$notification['id']}}">Make As
                                        Read</a>
                                </div>

                            @endforeach

                        </div>
                    </div>
                    <div class="tab-pane fade bg-white" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container">
                            <div class="row">
                                @foreach($reports as $report)
                                <div class="col-lg-4 col-md-6 pb-3">
                                    <div class="hotel text-center">
                                        <a href="people/details/{{$report->id}}">
                                            <div class="hotel-img">
                                                <img style="width:348px;height:348px" src="http://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}" alt="Img Of Person" class="img-fluid">
                                            </div>
                                            <h3><a href="/people/details/{{$report->id}}">{{$report->name}}</a></h3>
                                            <p>Age is :{{$report->age}}</p>
                                            <span>{{$report->gender}}</span>
                                            <p>{{ __('messages.Click On  Image for more details') }} </p>

                                        </a>
                                        <div class="row justify-content-center">
                                            <a class="btn btn-primary mr-2" href="/editReport/{{$report->id}}">{{ __('messages.Update Report') }}</a>
                                            <form action="/report/delete/{{$report->id}}" method="POST">
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
    </div>

</section>

@endsection