@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<section id="speakers-details" class="wow fadeIn pt-5">
    <div class="container  pt-5">
        <div class="card pt-2">
            <div class="card-header">
                {{ __('messages.Edit Your Profile') }} 
            </div>

            <div class="card-body">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active bg-white" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="/update/profile/{{$profile->id}}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ __('messages.Name') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" value="{{$profile->name}}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ __('messages.Email') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" value="{{$profile->email}}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ __('messages.Phone') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Your phone" data-rule="phone" data-msg="Please enter a valid phone" value="{{$profile->phone}}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ __('messages.city') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select id="city" name="city" class="form-control">

                                        <option selected>{{ __('messages.Choose your city') }}</option>
                                        <option value="{{$profile->city}}">{{$profile->city}}</option>
                                        <option>...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ __('messages.region') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <select id="region" name="region" class="form-control">
                                        <option selected>{{ __('messages.Choose your region') }}</option>
                                        <option value="{{$profile->region}}">{{$profile->region}}</option>
                                        <option>...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-cotent-center">
                                <div class="text-center">
                                    <button type="submit" class="btn" id="lostButton">{{ __('messages.Update Data') }}</button>
                                </div>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
