@extends('layouts.AdminPanel.page')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Reports</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Report Info</h3>
                        </div>
                        <hr>

                        <form method="POST" action="/reportUpdate/{{$report->id}}" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="owner" class="control-label mb-1">Report owner:</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                            value="{{$user[0]->name}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="x_card_code" class="control-label mb-1">lost / find</label>
                                        <input id="type" name="type" type="text" class="form-control cc-cvc"
                                            value="{{$report->type}}" READONLY>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Image</label>
                                        <input type="file" class="form-control" name="image"
                                         id="fileUpload"  accept=".jpg,.jpeg,.png" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="name" class="control-label mb-1">Name:</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                            value="{{$report->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="type" class="control-label mb-1">Age</label>
                                        <input id="age" name="age" type="number" class="form-control"
                                            value="{{$report->age}}">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            @if(($report->gender) == "male")
                                            <option value="male" selected>{{$report->gender}}</option>
                                            <option value="female">female</option>
                                            @else
                                            <option value="male">male</option>
                                            <option value="female" selected>{{$report->gender}}</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Special_Mark</label>
                                        <input id="special_mark" name="special_mark" type="text" class="form-control"
                                            value="{{$report->special_mark}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eye_color">Select Eye Color :</label>
                                        <select class="form-control" id="eye_color" name="eye_color" required="">
                                            <option value="black"
                                                {{ $report->eye_color === "black" ? "selected" : " " }}>Black</option>
                                            <option value="brown"
                                                {{ $report->eye_color === "brown" ? "selected" : " " }}>Brown</option>
                                            <option value="green"
                                                {{ $report->eye_color === "green" ? "selected" : " " }}>Green</option>
                                            <option value="grey" {{ $report->eye_color === "grey" ? "selected" : " " }}>
                                                Grey</option>
                                            <option value="blue" {{ $report->eye_color === "blue" ? "selected" : " " }}>
                                                Blue</option>
                                        </select>
                                    </div>



                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hair_color">Select Hair Color :</label>
                                        <select class="form-control" id="hair_color" name="hair_color">
                                            <option value="black"
                                                {{ $report->hair_color === "black" ? "selected" : " " }}>Black</option>
                                            <option value="brown"
                                                {{ $report->hair_color === "brown" ? "selected" : " " }}>Brown</option>
                                            <option value="white"
                                                {{ $report->hair_color === "white" ? "selected" : " " }}>White</option>
                                            <option value="grey"
                                                {{ $report->hair_color === "grey" ? "selected" : " " }}>grey</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_seen_on">Last Seen On :</label>
                                        <select class="form-control" id="last_seen_on" name="last_seen_on" required="">
                                            <option value="Saturday"
                                                {{ $report->last_seen_on === "Saturday" ? "selected" : " " }}>Saturday
                                            </option>
                                            <option value="Sunday"
                                                {{ $report->last_seen_on === "Sunday" ? "selected" : " " }}>Sunday
                                            </option>
                                            <option value="Monday"
                                                {{ $report->last_seen_on === "Monday" ? "selected" : " " }}>Monday
                                            </option>
                                            <option value="Tuesday"
                                                {{ $report->last_seen_on === "Tuesday" ? "selected" : " " }}>Tuesday
                                            </option>
                                            <option value="Wednesday"
                                                {{ $report->last_seen_on === "Wednesday" ? "selected" : " " }}>Wednesday
                                            </option>
                                            <option value="Thursday"
                                                {{ $report->last_seen_on === "Thursday" ? "selected" : " " }}>Thursday
                                            </option>
                                            <option value="Friday"
                                                {{ $report->last_seen_on === "Friday" ? "selected" : " " }}>Friday
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Last_Seen_At</label>
                                        <input id="last_seen_at" name="last_seen_at" type="time" class="form-control"
                                            value="{{$report->last_seen_at}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Lost_Since</label>
                                        <input id="lost_since" name="lost_since" type="date" class="form-control"
                                            value="{{$report->lost_since}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Found_Since</label>
                                        <input id="found_since" name="found_since" type="date" class="form-control"
                                            value="{{$report->found_since}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Height</label>
                                        <input id="height" name="height" type="number" class="form-control"
                                            value="{{$report->height}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Weight</label>
                                        <input id="weight" name="weight" type="number" class="form-control"
                                            value="{{$report->weight}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lost_since" class="control-label mb-1">Location</label>
                                        <input id="location" name="location" type="text" class="form-control"
                                            value="{{$report->location}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">select city:</label>
                                        <select name="city_id" id="city" class="form-control">
                                            @foreach($cities as $city)
                                            @if(($report->city)->id !=$city->id)
                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                            @else
                                            <option value="{{$city->id}}" selected>{{$city->city_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"><div class="form-group">
                                    <label for="title">select area:</label>
                                    <select name="area_id" id="state" class="form-control">
                                        @foreach($area as $key => $a)
                                        @if(($report->area)->id !=$a->id)
                                        <option value="{{$a->id}}">{{$a->area_name}}</option>
                                        @else
                                        <option value="{{$a->id}}" selected>{{$a->area_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div></div>
                            </div>










                            <div>
                                <button id="btn_submit" type="submit" class="btn btn-lg btn-info btn-block text-white">
                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                    <span id="payment-button-amount">Update</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#city').change(function(){
    var cityID = $(this).val();
    if(cityID){
        $.ajax({
           type:"GET",
           url:"{{url('get-area-list')}}?city_id="+cityID,
           success:function(states){
            if(states){
                $("#state").empty();
                // $("#state").append('<label for="inputfound_since" >enter attributes :</label>');
                $.each(states,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });

            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }
   });
</script>

@endsection