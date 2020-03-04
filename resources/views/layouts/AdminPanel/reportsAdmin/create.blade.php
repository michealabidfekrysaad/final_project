@extends('layouts.AdminPanel.page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-b-40">
                        <form action="/report/Add" method="POST" name="add_report" class="m-5"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fileUpload">Upload Image :</label>
                                        <input type="file" class="form-control" name="image" id="fileUpload"
                                               onchange="Filevalidation()" accept=".jpg,.jpeg,.png" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="inputName">Name Of Person :</label>
                                        <input type="text" class="form-control" id="inputName"
                                               placeholder="Name Of Person"
                                               name="name" required>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputlocation">Location :</label>
                                        <input type="text" class="form-control" id="inputlocation"
                                               placeholder="Last Location Of Person" name="location" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('special_mark') ? ' has-error' : '' }}">
                                        <label for="inputspecial_mark">Special Mark :</label>
                                        <input type="text" class="form-control" id="inputspecial_mark"
                                               placeholder="Special Mark Of Person" name="special_mark" required>
                                        @if ($errors->has('special_mark'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('special_mark') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('lost_since') ? ' has-error' : '' }}">
                                        <label for="inputlost_since">Lost Since :</label>
                                        <input type="date" class="form-control" id="inputlost_since"
                                               placeholder="Person Lost Since" max="2020-02-01" min="1920-02-01"
                                               name="lost_since" required>
                                        @if ($errors->has('lost_since'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('lost_since') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('age') ? ' has-error' : '' }}">
                                        <label for="inputAge">Age :</label>
                                        <input type="number" class="form-control" id="inputAge"
                                               placeholder="Age Of Person"
                                               min=1 max=90 name="age" required>
                                        @if ($errors->has('age'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('height') ? ' has-error' : '' }}">
                                        <label for="inputHeight">Height :</label>
                                        <input type="number" class="form-control" id="inputHeight"
                                               placeholder="height Of Person In CM ex:125" min=1 max=250 name="height"
                                               required>
                                        @if ($errors->has('height'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group  {{ $errors->has('weight') ? ' has-error' : '' }}">
                                        <label for="inputWeight">Weight :</label>
                                        <input type="number" class="form-control" id="inputWeight"
                                               placeholder="Weight Of Person In KG" min=5 max=100 name="weight"
                                               required>
                                        @if ($errors->has('weight'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <label for="gender">select Gender :</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="">select your gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_seen_on">Last Seen On :</label>
                                        <select class="form-control" id="last_seen_on" name="last_seen_on" required>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputlast_seen_at">Last Seen At :</label>
                                        <input type="time" class="form-control" id="inputlast_seen_at"
                                               placeholder="Last Time Seen Of Person" name="last_seen_at" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputfound_since">found Since :</label>
                                        <input type="date" class="form-control" id="inputfound_since"
                                               placeholder="Person found when" name="found_since" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eye_color">Select Eye Color :</label>
                                        <select class="form-control" id="eye_color" name="eye_color" required>
                                            <option value="black">Black</option>
                                            <option value="brown">Browan</option>
                                            <option value="green">Green</option>
                                            <option value="gry">Grey</option>
                                            <option value="blue">Blue</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hair_color">Select Hair Color :</label>
                                        <select class="form-control" id="hair_color" name="hair_color">
                                            <option value="black">Black</option>
                                            <option value="browan">Browan</option>
                                            <option value="white">White</option>
                                            <option value="gry">Golden</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City:</label>
                                        <select class="form-control" id="city" name="city" required>
                                            <option value="none" selected disabled hidden>
                                                Select a city
                                            </option>
                                            @foreach($cities as $key => $city)
                                                <option value="{{$key}}"> {{$city}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">select region:</label>
                                        <select name="region" id="state" class="form-control">
                                            <option value="none" selected disabled hidden>
                                                Select city first
                                            </option>

                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-dark" id="lostButton">Send Report</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#city').change(function () {
            var cityID = $(this).val();
            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-area-list')}}?city_id=" + cityID,
                    success: function (states) {
                        if (states) {
                            $("#state").empty();
                            // $("#state").append('<label for="inputfound_since" >enter attributes :</label>');
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
