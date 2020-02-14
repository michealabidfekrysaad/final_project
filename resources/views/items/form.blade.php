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

            let Name =document.getElementById("inputName");
            let NameErr=document.getElementById("NameErr");
            var re = /^[a-zA-Z ]*$/;
            if (Name.value == "")
                {
                    Name.focus();
                    NameErr.classList.add("text-danger");
                    NameErr.innerHTML = "name is required";
                    return false;
                }
                if(re.test(Name.value) == false){
                    Name.focus();
                    NameErr.classList.add("text-danger");
                    NameErr.innerHTML = "name can not contain numbers";
                    return false;
                }
                else{
                    NameErr.innerHTML = "";

                }
        let image= document.getElementById('fileUpload').value;
        let item= document.getElementById('item').value;
        let city= document.getElementById('city').value;
        let state= document.getElementById('state').value;
        let inputfound_since= document.getElementById('inputfound_since').value;
        if(image == "" || item == "" || city == "" || state == "" || inputfound_since == ""){
            document.getElementById('formErr').innerText ="all fields are required";
            return false;
        }

            return( true );
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
                    ImgError.classList.add("text-danger");
                    ImgError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                    break;
                } else {
                    ImgError.classList.remove('text-danger');
                    ImgError.classList.add("text-success");
                    ImgError.innerHTML = "Upload Image Successfully, size is " + file + "MB";
                    break;

                }
            }
        }
    }

    // function myFunction() {
    //    let image= document.getElementById('fileUpload').value;
    //     let item= document.getElementById('item').value;
    //     let city= document.getElementById('city').value;
    //     let state= document.getElementById('state').value;
    //     let inputfound_since= document.getElementById('inputfound_since').value;
    //     if(image == "" || item == "" || city == "" || state == "" || inputfound_since == ""){
    //         document.getElementById('formErr').innerText ="all fields are required";
    //         return false;
    //     }
    //
    //
    // }

</script>



@extends('layouts.app')

@section('content')

<section id="contact" class="section-bg  py-5">

    <div class="container py-5">

        <div class="section-header pt-5">
            <h2>{{ __('messages.Report For Found Item') }}</h2>
        </div>



            @csrf

        <form action="{{route("items.store")}}" method="POST" onsubmit="return(validate());" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                <label for="image">{{ __('messages.Upload Image :') }}</label>
                <input type="file" class="form-control" name="image" id="fileUpload" onchange="Filevalidation()"
                       accept=".jpg,.jpeg,.png" required/>
                <span id="ImgError"></span>
                    @if ($errors->has('image'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                    @endif
            </div>

            <div class="form-group">
                <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label for="category_id">{{ __('messages.item name:') }}</label>
                <select class="form-control" id="item" name="category_id" required>
                    <option value="" selected disabled hidden>
                        {{ __('messages.Select an Option') }}
                    </option>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                    @endif
                    @if(app()->getLocale()=='ar')
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"> {{$category->category_name_ar}}</option>
                        @endforeach
                    @else

                        @foreach($categories as $category)
                            <option value="{{$category->id}}"> {{$category->category_name}}</option>
                        @endforeach
                    @endif


                </select>
            </div>

            <div class="form-group" id="attribute">

            </div>

            <div class="form-group">
                <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                <label for="city">{{ __('messages.City:') }}</label>
                <select class="form-control" id="city" name="city_id" required>
                    <option value="" selected disabled hidden>
                        {{ __('messages.Select an Option') }}
                    </option>
                    @if ($errors->has('city_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>

                    @endif
                    @if(app()->getLocale()=='ar')
                        @foreach($cities as $city)
                            <option value="{{$city->id}}"> {{$city->city_name_ar}}</option>
                        @endforeach
                    @else
                        @foreach($cities as $city)
                            <option value="{{$city->id}}"> {{$city->city_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <div class="form-group {{ $errors->has('area_id') ? ' has-error' : '' }}">
                <label for="title">{{ __('messages.select region:') }}</label>
                <select name="area_id" id="state" class="form-control">
                </select>
                    @if ($errors->has('area_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('area_id') }}</strong>
                                    </span>
                    @endif

            </div>


            <div class="form-group">
                <div class="form-group {{ $errors->has('found_since') ? ' has-error' : '' }}">
                <label for="inputfound_since">{{ __('messages.found Since :') }}</label>
                <input type="date" class="form-control" id="inputfound_since" name="found_since" placeholder="Item found when" required>
                    @if ($errors->has('found_since'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('found_since') }}</strong>
                        </span>
                    @endif
                </div>


            <div class="text-center">
                <button type="submit" class="btn" id="lostButton">{{ __('messages.Send Report') }}</button>
                <span class="d-block mt-2 text-danger" id="formErr"></span>
            </div>

        </form>

    </div>
</section>


<script>
    $('#city').change(function(){
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

    $('#item').change(function () {
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                type: "GET",
                url: "/get/" + category_id,
                success: function (category) {
                    console.log(category);
                    if (category) {
                        $("#attribute").empty();
                        $.each(category[0].attributes, function (key, value) {
                            let itemAttributes = category[0].attributes;
                            $("#attribute").append(`@if(app()->getLocale()=='ar')<label>` + itemAttributes[key].attribute_name_ar + `</label>
                                         <select class="form-control" name="#` + itemAttributes[key].attribute_name + `" id = "` + itemAttributes[key].id + `" value = "` + itemAttributes[key].id + `">
                                         </select>@else <label>` + itemAttributes[key].attribute_name + `</label>
                                         <select class="form-control" name="#` + itemAttributes[key].attribute_name + `" id = "` + itemAttributes[key].id + `" value = "` + itemAttributes[key].id + `">
                                         </select> @endif`);


                            $.ajax({
                                type: "GET",
                                url: "/valueofattribute/" + itemAttributes[key].id,
                                success: function (result) {
                                    if (result) {
                                        $.each(result, function (key, value) {
                                            $(`#` + result[key].attribute_id + ``).append(`@if(app()->getLocale()=='ar')<option value = "` + result[key].id + `">` + result[key].value_name_ar + `</option>
@else<option value = "` + result[key].id + `">` + result[key].value_name + `</option>@endif`);
                                        })


                                    }
                                    //  console.log(result.value_name)

                                }
                            })


                        });


                    } else {
                        $("#attribute").empty();
                    }
                }
            });
        } else {
            $("#attribute").empty();
            $("#item").empty();
        }
    });


</script>

@endsection
