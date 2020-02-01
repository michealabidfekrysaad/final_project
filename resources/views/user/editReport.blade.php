@extends('layouts.app')

@section('content')

<!--==========================
      Contact Section
    ============================-->
<section id="contact" class="section-bg  py-5">

    <div class="container py-5">

        <div class="section-header pt-5">
            <h2>Edit Report</h2>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/updateReport/{{$report->id}}" method="POST"  enctype="multipart/form-data">
            @csrf
{{--            @method('PUT')--}}
            <div class="row">
                <div class="col-md-6">
                    <img id="image" src="http://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}">
                    <input type="file" name="image">
                    <span id="ImgError"></span>
                </div>

                <div class="col-md-6">
                    <div class="details">
                        <div class="row">
                            <div class="col">
                                <h3>Name Of Person :</h3>
                            </div>
                            <div class="col"><input type="text" class="form-control" id="inputName" placeholder="Name Of Person" required name="name" value="{{$report->name}}">
                                <span id="NameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Location :</h3>
                            </div>
                            <div class="col"><input type="text" class="form-control" id="inputlocation" placeholder="Last Location Of Person" required name="location" value="{{$report->location}}">
                                <span id="LocationErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Special Mark :</h3>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputspecial_mark" placeholder="Special Mark Of Person" required name="special_mark" value="{{$report->special_mark}}">
                                <span id="SpecialErr"></span>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Last Seen At :</h3>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputlast_seen_at" placeholder="Last Time Seen Of Person" required name="last_seen_at" value="{{$report->last_seen_at}}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Lost Since : </h3>
                            </div>
                            <div class="col">
                            <input type="date" class="form-control" id="inputlast_seen_at" placeholder="Last Time Seen Of Person" required name="last_seen_on" value="{{$report->last_seen_on}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Age : </h3>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="inputAge" placeholder="Age Of Person" min=1 max=90 required name="age" value="{{$report->age}}">
                                <span id="NumberErr"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Height : </h3>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="inputHeight" placeholder="height Of Person In CM ex:125" min=1 max=250 required name="height" value="{{$report->height}}">
                                <span id="HeightErr"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Weight : </h3>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="inputWeight" placeholder="Weight Of Person In KG" min=5 max=100 required name="weight" value="{{$report->weight}}">
                                <span id="WeightErr"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Gender : </h3>
                            </div>
                            <div class="col">
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">select your gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span id="GenderErr"></span>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Last Seen On : </h3>
                            </div>
                            <div class="col">
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
                        <div class="row">
                            <div class="col">
                                <h3>Eye Color : </h3>
                            </div>
                            <div class="col">
                                <select class="form-control" id="eye_color" name="eye_color" required>
                                    <option value="black">Black</option>
                                    <option value="brown">Browan</option>
                                    <option value="green">Green</option>
                                    <option value="grey">Grey</option>
                                    <option value="blue">Blue</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Hair Color : </h3>
                            </div>
                            <div class="col">
                                <select class="form-control" id="hair_color" name="hair_color">
                                    <option value="black">Black</option>
                                    <option value="brown">Brown</option>
                                    <option value="white">White</option>
                                    <option value="golden">Golden</option>
                                </select>
                            </div>


                        </div>
                        <div class="row ">
                            <button type="submit" class="btn" id="lostButton">Update Report</button>
                        </div>


                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

@endsection
