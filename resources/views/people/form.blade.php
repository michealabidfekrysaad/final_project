<script>
    function validate(ev) {
        var allowedFiles = [".jpg", ".jpeg", ".png"];
        let fileUpload = document.getElementById("fileUpload");
        let ImgError = document.getElementById("ImgError");
        let regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase())) {
            ImgError.classList.add("text-danger");
            ImgError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
            return false;
        }


        ImgError.classList.add("text-success");
        ImgError.innerHTML = "Upload Image Successfully";
        Filevalidation();

        // above is image validation and below is name validation

        let Name = document.getElementById("inputName");
        let NameErr = document.getElementById("NameErr");
        var re = /^[a-zA-Z ]*$/;
        if (Name.value == "") {
            Name.focus();
            NameErr.classList.add("text-danger");
            NameErr.innerHTML = "name is required";
            return false;
        }
        if (re.test(Name.value) == false) {
            Name.focus();
            NameErr.classList.add("text-danger");
            NameErr.innerHTML = "name can not contain numbers";
            return false;
        } else {
            NameErr.innerHTML = "";

        }

        // above validation on person name and below is location validation

        let inputlocation = document.getElementById("inputlocation");
        let LocationErr = document.getElementById("LocationErr");
        if (inputlocation.value == "") {
            inputlocation.focus();
            LocationErr.classList.add("text-danger");
            LocationErr.innerHTML = "location is required";
            return false;
        }
        if (re.test(inputlocation.value) == false) {
            inputlocation.focus();
            LocationErr.classList.add("text-danger");
            LocationErr.innerHTML = "location can not contain numbers";
            return false;
        } else {
            LocationErr.innerHTML = "";

        }

        // validation for special mark that is  text
        let inputspecial_mark = document.getElementById("inputspecial_mark");
        let SpecialErr = document.getElementById("SpecialErr");
        if (inputspecial_mark.value == "") {
            inputspecial_mark.focus();
            SpecialErr.classList.add("text-danger");
            SpecialErr.innerHTML = "special mark is required";
            return false;
        }
        if (re.test(inputspecial_mark.value) == false) {
            inputspecial_mark.focus();
            SpecialErr.classList.add("text-danger");
            SpecialErr.innerHTML = "special mark can not contain numbers";
            return false;
        } else {
            SpecialErr.innerHTML = "";

        }




        //validation on date input
        const queryString = window.location.href;
        spliturl = queryString.split("/");
        let lookfor;
        for (i = 0; i < spliturl.length; i++) {
            if (spliturl[i] == 'lookfor') {
                lookfor = true;
            } else {
                lookfor = false;

            }
        }
        if (lookfor) {
            console.log("inside lost since")
            let inputlost_since = document.getElementById("inputlost_since");
            let LostErr = document.getElementById("LostErr");
            SplitLostSince = inputlost_since.value.split("-");
            let today = new Date();
            let year = today.getFullYear();
            let day = String(today.getDate()).padStart(2, '0');
            let month = String(today.getMonth() + 1).padStart(2, '0');
            var dateformat = /^\d{4}-\d{2}-\d{2}$/;
            if (!inputlost_since.value.match(dateformat) || SplitLostSince[0] > year) {
                LostErr.classList.add("text-danger");
                LostErr.innerHTML = "year is not valid";
                return false;
            }
            if (SplitLostSince[1] > month || SplitLostSince[2] > day) {
                LostErr.classList.add("text-danger");
                LostErr.innerHTML = "day or month is not valid";
                return false;
            } else {
                LostErr.innerHTML = "";
            }


        }

        //    validation on age input

        let inputAge = document.getElementById("inputAge");
        let NumberErr = document.getElementById("NumberErr");
        let RegexNumber = /^[0-9]+$/;
        if (inputAge.value == "" || inputAge.value == 0) {
            inputAge.focus();
            NumberErr.classList.add("text-danger");
            NumberErr.innerHTML = "Age is required";
            return false;
        }
        if (RegexNumber.test(inputAge.value) == false || inputAge.value > 100) {
            inputAge.focus();
            NumberErr.classList.add("text-danger");
            NumberErr.innerHTML = "Age is not valid";
            return false;
        } else {
            NumberErr.innerHTML = "";

        }

        //validation on height in cm
        let inputHeight = document.getElementById("inputHeight");
        let HeightErr = document.getElementById("HeightErr");
        let RegexAge = /^[0-9]+$/;
        if (inputHeight.value == "" || inputHeight.value == 0) {
            inputHeight.focus();
            HeightErr.classList.add("text-danger");
            HeightErr.innerHTML = "Height is required ";
            return false;
        }
        if (RegexAge.test(inputHeight.value) == false || inputHeight.value > 250) {
            inputHeight.focus();
            HeightErr.classList.add("text-danger");
            HeightErr.innerHTML = "Height is not valid";
            return false;
        } else {
            HeightErr.innerHTML = "";

        }


        //validation on weight
        let inputWeight = document.getElementById("inputWeight");
        let WeightErr = document.getElementById("WeightErr");
        let RegexWeight = /^[0-9]+$/;
        if (inputWeight.value == "" || inputWeight.value == 0) {
            inputWeight.focus();
            WeightErr.classList.add("text-danger");
            WeightErr.innerHTML = "Weight is required ";
            return false;
        }
        if (RegexWeight.test(inputWeight.value) == false || inputWeight.value > 100) {
            inputWeight.focus();
            WeightErr.classList.add("text-danger");
            WeightErr.innerHTML = "Weight is not valid";
            return false;
        } else {
            WeightErr.innerHTML = "";

        }


        //validate on dropdown gender
        let gender = document.getElementById("gender");
        let strUser = gender.options[gender.selectedIndex].value;
        let GenderErr = document.getElementById("GenderErr");
        if (strUser == "") //for text use if(strUser1=="Select")
        {
            GenderErr.classList.add("text-danger");
            GenderErr.innerHTML = "gender is required ";
        } else {
            GenderErr.innerHTML = "";

        }






        return (true)
    }





    Filevalidation = () => {

        if (fileUpload.files.length > 0) {
            for (const i = 0; i <= fileUpload.files.length - 1; i++) {

                const fsize = fileUpload.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file. 
                if (file >= 4096) {
                    ImgError.classList.add("text-danger");
                    ImgError.innerHTML = "size of image is" + file + "MB is very large";
                    break;
                }
                var allowedFiles = [".jpg", ".jpeg", ".png"];
                let regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
                if (!regex.test(fileUpload.value.toLowerCase())) {
                    console.log("inside")
                    ImgError.classList.add("text-danger");
                    ImgError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                    break;
                } else {
                    ImgError.classList.remove('text-danger')
                    ImgError.classList.add("text-success");
                    ImgError.innerHTML = "Upload Image Successfully, size is " + file + "MB";
                    break;

                }
            }
        }
    }
</script>



@extends('layouts.app')

@section('content')

<section id="contact" class="section-bg  py-5">

    <div class="container py-5">

        <div class="section-header pt-5">
            @if($type == 'lookfor')
            <h2>Report For Lost Person</h2>
            @endif
            @if($type == 'found')
            <h2>Report For found Person</h2>
            @endif


        </div>


        {{-- <form onsubmit="return(validate());"> --}}
<form action="/people/search" method="post" enctype="multipart/form-data">
@csrf
            <div class="form-group">
                <label for="Select_file">Upload Image :</label>
                <input type="file" class="form-control" name="image" id="fileUpload" onchange="Filevalidation()" accept=".jpg,.jpeg,.png" required />
                <span id="ImgError"></span>
            </div>

            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="inputName">Name Of Person :</label>
                <input type="text" class="form-control" id="inputName" name="name" placeholder="Name Of Person" required>
                <span id="NameErr"></span>
                @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
            </div>

            <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                <label for="inputlocation">Location :</label>
                <input type="text" class="form-control" id="inputlocation" name="location" placeholder="Last Location Of Person" required>
                <span id="LocationErr"></span>
                @if ($errors->has('location'))
                <span class="help-block">
                <strong>{{ $errors->first('location') }}</strong>
            </span>
            @endif
            </div>


            <div class="form-group {{ $errors->has('special_mark') ? ' has-error' : '' }}">
                <label for="inputspecial_mark">Special Mark :</label>
                <input type="text" class="form-control" id="inputspecial_mark" name="special_mark" placeholder="Special Mark Of Person" required>
                <span id="SpecialErr"></span>
                @if ($errors->has('special_mark'))
                <span class="help-block">
                <strong>{{ $errors->first('special_mark') }}</strong>
            </span>
            @endif
            </div>

            @if($type == 'lookfor')
            <div class="form-group {{ $errors->has('lost_since') ? ' has-error' : '' }}">
                <label for="inputlost_since">Lost Since :</label>
                <input type="date" class="form-control" id="inputlost_since" name="lost_since" placeholder="Person Lost Since" max="2020-02-01" min="1920-02-01" required>
                <span id="LostErr"></span>
                @if ($errors->has('lost_since'))
                <span class="help-block">
                <strong>{{ $errors->first('lost_since') }}</strong>
            </span>
            @endif
            </div>

            @endif


            <div class="form-group {{ $errors->has('age') ? ' has-error' : '' }}">
                <label for="inputAge">Age :</label>
                <input type="number" class="form-control" id="inputAge" name="age" placeholder="Age Of Person" min=1 max=90 required>
                <span id="NumberErr"></span>
                @if ($errors->has('age'))
                <span class="help-block">
                <strong>{{ $errors->first('age') }}</strong>
            </span>
            @endif
            </div>


            <div class="form-group {{ $errors->has('height') ? ' has-error' : '' }}">
                <label for="inputHeight">Height :</label>
                <input type="number" class="form-control" name="height" id="inputHeight" placeholder="height Of Person In CM ex:125" min=1 max=250 required>
                <span id="HeightErr"></span>
                @if ($errors->has('height'))
                <span class="help-block">
                <strong>{{ $errors->first('height') }}</strong>
            </span>
            @endif
            </div>


            <div class="form-group  {{ $errors->has('weight') ? ' has-error' : '' }}">
                <label for="inputWeight">Weight :</label>
                <input type="number" class="form-control" name="weight" id="inputWeight" placeholder="Weight Of Person In KG" min=5 max=100 required>
                <span id="WeightErr"></span>
                @if ($errors->has('weight'))
                <span class="help-block">
                <strong>{{ $errors->first('weight') }}</strong>
            </span>
            @endif
            </div>


            <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                <label for="gender">select Gender :</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span id="GenderErr"></span>
                @if ($errors->has('gender'))
                <span class="help-block">
                <strong>{{ $errors->first('gender') }}</strong>
            </span>
            @endif
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="none" selected disabled hidden>
                        Select an Option
                    </option>
                    @foreach($cities as $key => $city)
                    <option value="{{$key}}"> {{$city}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="title">select region:</label>
                <select name="region" id="state" class="form-control">

                </select>
            </div>

            @if($type == 'lookfor')
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


            <div class="form-group">
                <label for="inputlast_seen_at">Last Seen At :</label>
                <input type="time" class="form-control" name="last_seen_at" id="inputlast_seen_at" placeholder="Last Time Seen Of Person" required>
            </div>

            @endif

            @if($type == 'found')
            <div class="form-group">
                <label for="inputfound_since">found Since :</label>
                <input type="date" class="form-control" name="found_since" id="inputfound_since" placeholder="Person found when" required>
            </div>

            @endif

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




            <div class="form-group">
                <label for="hair_color">Select Hair Color :</label>
                <select class="form-control" id="hair_color" name="hair_color">
                    <option value="black">Black</option>
                    <option value="browan">Browan</option>
                    <option value="white">White</option>
                    <option value="gry">Golden</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn" id="lostButton">Send Report</button>
            </div>

        </form>

    </div>
</section>

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
                $("#state").append('<label for="inputfound_since" >enter attributes :</label>');
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