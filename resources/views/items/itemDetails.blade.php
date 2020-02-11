@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<section id="speakers-details" class="wow fadeIn pt-5">

    <div class="container  pt-5">
        <div class="section-header pt-2">
            <h2>{{ __('messages.Item Details') }}</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}"
                     alt="Img Of Person" class="img-fluid">
            </div>

            <div class="col-md-6">
                <div class="details">
                    <div class="row">
<<<<<<< HEAD
                        <h3>{{ __('messages.Category :') }}</h3>
                        <p> {{($item->category)->category_name}}</p>
=======
                        <h3>Category :</h3>
                        @if(app()->getLocale()=='ar')
                            <p> {{($item->category)->category_name_ar}}</p>
                        @else
                            <p> {{($item->category)->category_name}}</p>
                        @endif
>>>>>>> 2c028dc661b34abdc322725a298434a7b7851686
                    </div>
                    <div class="row">
                        <h3>{{ __('messages.Found Since :') }}</h3>
                        <p> {{$item->found_since}}</p>
                    </div>
                    <div class="row">
<<<<<<< HEAD
                        <h3>{{ __('messages.City Where Found :') }}</h3>
                        <p> {{($item->city)->city_name}}</p>
=======
                        <h3>City Where Found :</h3>
                        @if(app()->getLocale()=='ar')
                            <p> {{($item->city)->city_name_ar}}</p>
                        @else
                            <p> {{($item->city)->city_name}}</p>
                        @endif
>>>>>>> 2c028dc661b34abdc322725a298434a7b7851686
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

</section>

@endsection
