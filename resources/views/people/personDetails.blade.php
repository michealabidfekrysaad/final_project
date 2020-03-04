@extends('layouts.app')

@section('content')

    <!--==========================
      Speaker Details Section
    ============================-->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
    <section id="speakers-details" class="wow fadeIn pt-5">

        <div class="container-fluid w-75 pt-5">

            <div class="section-header pt-2">
                <h2>{{ __('messages.Person Details') }}</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img style="width:348px;height:348px"
                         src="https://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}" alt="Speaker 1"
                         class="img-fluid">
                    <div class="row mt-3 ml-2">
                        <h5>{{ __('messages.Share Report :') }}</h5>
                        <div class="fb-share-button ml-2"
                             data-href="http://127.0.0.1:8000/people/details/{{$report->id}}" data-layout="button"
                             data-size="large"><a target="_blank"
                                                  href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2Fpeople%2Fdetails%2F3&amp;src=sdkpreparse"
                                                  class="fb-xfbml-parse-ignore">Share</a></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="details">
                        <div class="row">
                            <h3>{{ __('messages.Name :') }}</h3>
                            <p>{{$report->name}}</p>
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Age : ') }}</h3>
                            <p> {{$report->age}}</p>
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Gender') }} :</h3>
                            @if(app()->getLocale()=='ar')
                                @if($report->gender =='male')
                                    <p>{{ __('messages.male') }}</p>
                                @else
                                    <p>{{ __('messages.female') }}</p>
                                @endif
                            @else
                                @if($report->gender =='male')
                                    <p>{{ __('messages.male') }}</p>
                                @else
                                    <p>{{ __('messages.female') }}</p>
                                @endif
                            @endif
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Height : ') }}</h3>
                            <p>{{$report->height}}</p>
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Weight : ') }}</h3>
                            <p>{{$report->weight}}</p>
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Special Mark :') }}</h3>
                            <p>{{$report->special_mark}}</p>
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Eye Color : ') }}</h3>
                            @if(app()->getLocale() == 'ar')
                                @switch($report->eye_color)
                                    @case($report->eye_color == 'black')
                                    <p>{{__('messages.Black')}}</p>
                                    @break

                                    @case($report->eye_color == 'brown')
                                    <p>{{__('messages.Brown')}}</p>
                                    @break

                                    @case($report->eye_color == 'green')
                                    <p>{{__('messages.Green')}}</p>
                                    @break

                                    @case($report->eye_color == 'grey')
                                    <p>{{__('messages.Grey')}}</p>
                                    @break

                                    @case($report->eye_color == 'blue')
                                    <p>{{__('messages.Blue')}}</p>
                                    @break

                                    @default
                                    <p>{{$report->eye_color}}</p>
                                @endswitch
                            @else
                                <p>{{$report->eye_color}}</p>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="details">
                        <div class="row">
                            <h3>{{ __('messages.Hair Color : ') }}</h3>
                            @if(app()->getLocale() == 'ar')
                                @switch($report->hair_color)
                                    @case($report->hair_color == 'black')
                                    <p> {{__('messages.Black')}}</p>
                                    @break

                                    @case($report->hair_color == 'brown')
                                    <p> {{__('messages.Brown')}}</p>
                                    @break

                                    @case($report->hair_color == 'golden')
                                    <p> {{__('messages.Golden')}}</p>
                                    @break

                                    @case($report->hair_color == 'white')
                                    <p> {{__('messages.White')}}</p>
                                    @break

                                    @default
                                    <p>{{$report->hair_color}}</p>
                                @endswitch
                            @else
                                <p>{{$report->hair_color}}</p>
                            @endif
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.City:') }}</h3>
                            @if(app()->getLocale()=='ar')
                                <p>{{$report->city->city_name_ar}}</p>
                            @else
                                <p>{{$report->city->city_name}}</p>
                            @endif
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Region :') }}</h3>
                            @if(app()->getLocale()=='ar')
                                <p>{{$report->area->area_name_ar}}</p>
                            @else
                                <p>{{$report->area->area_name}}</p>
                            @endif

                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Location :') }}</h3>
                            <p>{{$report->location}}</p>
                        </div>

                        <div class="row">
                            <h3>{{ __('messages.Lost Since : ') }}</h3>
                            <p> {{$report->lost_since}}</p>
                        </div>

                        <div class="row">
                            <h3>{{ __('messages.Last Seen On : ') }}</h3>
                            <p> {{$report->last_seen_on}}</p>
                        </div>
                        <div class="row">
                            <h3>{{ __('messages.Last Seen At :') }}</h3>
                            <p> {{$report->last_seen_at}}</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <a href="/acceptOtherReport/{{$report->id}}" type="submit" class="btn" id="lostButton"
                   onclick="confirm('Are You Sure You Want To Contact With Report Owner');">Contact With Report
                    Owner</a>
            </div>
        </div>

    </section>

@endsection
