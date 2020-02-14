@extends('layouts.app')

@section('content')

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn pt-5">

        <section id="speakers-details" class="wow fadeIn pt-5">

            <div class="container  pt-5">
                <div class="section-header pt-2">
                    <h2>{{ __('messages.Item Details') }}</h2>
                </div>
                <form action="/updateReportItem/{{$item->id}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}"
                             alt="Img Of Person" class="img-fluid">
                        <input type="file" name="image" id="fileUpload" onchange="Filevalidation()"
                               accept=".jpg,.jpeg,.png"/>
                        <span id="ImgError"></span>
                    </div>

                    <div class="col-md-6">
                        <div class="details">
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Category :') }}</h3>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="item" name="category_id" required disabled>
                                        <option value="none" selected disabled hidden>
                                            {{ __('messages.Select an Option') }}
                                        </option>
                                        @if(app()->getLocale()=='ar')
                                            @foreach($categories as $category)
                                                <option {{$category->id==$item->category->id ? 'selected' : '' }} value="{{$category->id}}"> {{$category->category_name_ar}}</option>
                                            @endforeach
                                        @else

                                            @foreach($categories as $category)
                                                <option {{$category->id==$item->category->id ? 'selected' : '' }} value="{{$category->id}}"> {{$category->category_name}}</option>
                                            @endforeach
                                        @endif


                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Found Since :') }}</h3>
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="inputfound_since" name="found_since" placeholder="Item found when" required value="{{$item->found_since}}">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.City Where Found :') }}</h3>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="city" name="city_id" item="{{$item->city->id}}" required>
                                        <option value="none" selected disabled hidden>
                                            {{ __('messages.Select an Option') }}
                                        </option>
                                        @foreach($cities as $city)
                                            @if(app()->getLocale()=='ar')
                                                <option {{$city->id==$item->city->id ? 'selected' : '' }} value="{{$city->id}}"> {{$city->city_name_ar}}</option>
                                            @else
                                                <option {{$city->id==$item->city->id ? 'selected' : '' }} value="{{$city->id}}"> {{$city->city_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.select region:') }}</h3>
                                </div>
                                <div class="col">
                                    <select name="area_id" id="state" class="form-control">
                                        @foreach($areas as $area)
                                            @if(app()->getLocale()=='ar')
                                                <option {{$area->id==$item->area->id ? 'selected' : '' }} value="{{$area->id}}"> {{$area->area_name_ar}}</option>
                                            @else
                                                <option {{$area->id==$item->area->id ? 'selected' : '' }} value="{{$area->id}}"> {{$area->area_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @foreach($data as $one)
                                <div class="row">
                                    @if(app()->getLocale()=='ar')
                                        @foreach($globalAttributeValues as $globalAttributeValue)
                                            @if($globalAttributeValue->id==($one->attribute)->id)
                                                <div class="col">
                                                    <h3> {{($one->attribute)->attribute_name_ar}} :</h3>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="#{{$globalAttributeValue->attribute_name}}" id = "{{$globalAttributeValue->id}}" value ="{{$globalAttributeValue->id}}">
                                                        @foreach($globalAttributeValue->values as $v)
                                                            <option {{$v->id==($one->value)->id ? 'selected' : '' }} value="{{$v->id}}">  {{$v->value_name_ar}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                        @else
                                        @foreach($globalAttributeValues as $globalAttributeValue)
                                            @if($globalAttributeValue->id==($one->attribute)->id)
                                                <div class="col">
                                                    <h3> {{($one->attribute)->attribute_name}} :</h3>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control" name="#{{$globalAttributeValue->attribute_name}}" id = "{{$globalAttributeValue->id}}" value ="{{$globalAttributeValue->id}}">
                                                        @foreach($globalAttributeValue->values as $v)
                                                            <option {{$v->id==($one->value)->id ? 'selected' : '' }} value="{{$v->id}}">  {{$v->value_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            @endif
                                        @endforeach

                                  @endif
                                </div>
                            @endforeach

                            <div class="row ">
                                <button type="submit" class="btn" id="lostButton">{{ __('messages.Update Report') }}</button>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
            </div>

        </section>
        <script>
            $('#city').change(function(e){
                let itemCity=$(this).attr("item")
                var cityID = $(this).val();
                // console.log(cityID);
                if(cityID){
                    $.ajax({
                        type:"GET",
                        url:"{{url('get-state-list')}}?city_id=" + cityID,
                        success: function (states) {
                            //console.log(states);
                            if (states) {
                                $("#state").empty();
                                $("#state").append('<label for="inputfound_since" >enter attributes :</label>');
                                $.each(states, function (key, value) {
                                    $("#state").append('<option value="' + key + '">' + value + '</option>');
                                });

                            } else {
                                $("#state").empty();
                            }
                        }
                    });
                } else {
                    $("#state").empty();
                    $("#city").empty();
                }
            });
            </script>
@endsection
