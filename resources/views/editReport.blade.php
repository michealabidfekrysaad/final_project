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
        <form action="" method="">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('img/speakers/1.jpg')}}" alt="Speaker 1" class="img-fluid">
                    <input type="file" class="form-control" name="select_file" id="fileUpload" onchange="Filevalidation()" accept=".jpg,.jpeg,.png" required />
                    <span id="ImgError"></span>
                </div>

                <div class="col-md-6">
                    <div class="details">
                        <div class="row">
                            <div class="col">
                                <h3>Name Of Person :</h3>
                            </div>
                            <div class="col"><input type="text" class="form-control" id="inputName" placeholder="Name Of Person" required>
                                <span id="NameErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Location :</h3>
                            </div>
                            <div class="col"><input type="text" class="form-control" id="inputlocation" placeholder="Last Location Of Person" required>
                                <span id="LocationErr"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Special Mark :</h3>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="inputspecial_mark" placeholder="Special Mark Of Person" required>
                                <span id="SpecialErr"></span>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Last Seen At :</h3>
                            </div>
                            <div class="col">
                                <input type="time" class="form-control" id="inputlast_seen_at" placeholder="Last Time Seen Of Person" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Lost Since : </h3>
                            </div>
                            <div class="col">
                                <p> 01/05/2019</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Age : </h3>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="inputAge" placeholder="Age Of Person" min=1 max=90 required>
                                <span id="NumberErr"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Height : </h3>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="inputHeight" placeholder="height Of Person In CM ex:125" min=1 max=250 required>
                                <span id="HeightErr"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Weight : </h3>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="inputWeight" placeholder="Weight Of Person In KG" min=5 max=100 required>
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
                                    <option value="browan">Browan</option>
                                    <option value="green">Green</option>
                                    <option value="gry">Grey</option>
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
                                    <option value="browan">Browan</option>
                                    <option value="white">White</option>
                                    <option value="gry">Golden</option>
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