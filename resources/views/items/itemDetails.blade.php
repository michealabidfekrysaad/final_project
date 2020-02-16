@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
<section id="speakers-details" class="wow fadeIn pt-5">

<section id="speakers-details" class="wow fadeIn pt-5">

    <div class="container  pt-5">
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="section-header pt-2">
            <h2>{{ __('messages.Item Details') }}</h2>
        </div>
        <div class="row">
            <div class="col-md-6 text-center">
                <img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}"
                     alt="Img Of Person" class="img-fluid">
                <div class="row mt-3 ml-2 justify-content-center">
                    <h5>{{ __('messages.Share Report :') }}</h5>
                    <div class="fb-share-button ml-2" data-href="http://127.0.0.1:8000/people/details/{{$item->id}}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2Fpeople%2Fdetails%2F3&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="details">
                    <div class="row">

                        <h3>{{ __('messages.Category :') }}</h3>
                        @if(app()->getLocale()=='ar')
                            <p> {{($item->category)->category_name_ar}}</p>
                        @else
                            <p> {{($item->category)->category_name}}</p>
                        @endif

                    </div>
                    <div class="row">
                        <h3>{{ __('messages.Found Since :') }}</h3>
                        <p> {{$item->found_since}}</p>
                    </div>
                    <div class="row">
                        <h3>{{ __('messages.City Where Found :') }}</h3>
                        @if(app()->getLocale()=='ar')
                            <p> {{($item->city)->city_name_ar}}</p>
                        @else
                            <p> {{($item->city)->city_name}}</p>
                        @endif

                    </div>

                    @foreach($data as $one)
                        <div class="row">
                            @if(app()->getLocale()=='ar')
                                <h3> {{($one->attribute)->attribute_name_ar}} :</h3>
                                <p> {{($one->value)->value_name_ar}} </p>
                            @else
                                <h3> {{($one->attribute)->attribute_name}} :</h3>
                                <p> {{($one->value)->value_name}} </p>
                            @endif
                        </div>
                    @endforeach

                    <div class="row ">
                        <button id="lostButton" type="button" class="btn" data-toggle="modal" data-target="#myModal">
                            {{ __('messages.Contact With Report Owner') }}
                        </button>
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog  mw-100 w-50">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ __('messages.Description') }}</h4>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body text-center">
                                        <form action="/sendEmailItem/{{$item->id}}" method="POST" class="form">
                                            @csrf
                                            <div class="form-group">
                                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Write Description To Founder To Know Your Are They Real Owner Of Item"></textarea>
                                            </div>
                                            <button type="submit" class="btn" id="lostButton">{{ __('messages.Send Description To Report Owner') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
    <script>
        $(document).ready(function(){
            $(".alert").slideDown(300).delay(3000).slideUp(300);
        });
    </script>

@endsection
