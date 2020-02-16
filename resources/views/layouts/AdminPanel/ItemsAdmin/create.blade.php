@extends('layouts.AdminPanel.page')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class=" mb-4 w-100">
                <a href="/items/index"><i class="fa fa-arrow-left text-dark "></i></i> go back</a>
                <p class="text-center text-muted font-weight-bold">This item will pe published in the website
                    by your name as an found item </p>
            </div>
            <div class="col-lg-12">
                <div class="m-b-40">

                    <form action="/itemsStore" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group w-50">
                            <label for="image">Upload Image :</label>
                            <input type="file" class="form-control" name="image" id="fileUpload"
                                onchange="Filevalidation()" accept=".jpg,.jpeg,.png" required />
                            <span id="ImgError"></span>
                        </div>
                        <div class="form-group w-50">
                            <label for="inputfound_since">found Since :</label>
                            <input type="date" class="form-control" id="inputfound_since" name="found_since"
                                placeholder="Item found when" required>

                        </div>

                        <div class="form-group w-50">
                            <label for="category_id">item name:</label>
                            <select class="form-control" id="item" name="category_id" required>
                                <option value="none" selected disabled hidden>
                                    Select an item
                                </option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}"> {{$category->category_name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group w-50" id="attribute">

                        </div>

                        <div class="form-group w-50">
                            <label for="city">City:</label>
                            <select class="form-control" id="city" name="city_id" required>
                                <option value="none" selected disabled hidden>
                                    Select a city
                                </option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}"> {{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group w-50">
                            <label for="title">select region:</label>
                            <select name="area_id" id="state" class="form-control" required>
                                <option value="none" selected disabled hidden>
                                    Select city first
                                </option>
                            </select>
                        </div>




                        <div class="text-center">
                            <button type="submit" class="btn btn-dark" id="lostButton">
                                <i class="fa fa-pencil-square-o"></i>
                                add new item</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#city').change(function(){
        var cityID = $(this).val();
        // console.log(cityID);
        if(cityID){
            $.ajax({
               type:"GET",
               url:"{{url('get-state-list')}}?city_id="+cityID,
               success:function(states){
                   //console.log(states);
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

       $('#item').change(function(){
        var category_id = $(this).val();
        if(category_id){
            $.ajax({
               type:"GET",
               url:"/get/"+category_id,
               success:function(category){
                if(category){
                    $("#attribute").empty();
                    $.each(category[0].attributes,function(key,value){
                        let itemAttributes=category[0].attributes;
                    $("#attribute").append( `<label class="text-danger">`+itemAttributes[key].attribute_name+`</label>
                                             <select class="form-control" name="#`+itemAttributes[key].attribute_name+`"
                                             id = "`+itemAttributes[key].id+`" value = "`+itemAttributes[key].id+`">
                                             </select>`);


                        $.ajax({
                        type:"GET",
                        url:"/valueofattribute/"+itemAttributes[key].id,
                        success:function(result){
                            if(result){
                                $.each(result,function(key,value){
                                    $(`#`+result[key].attribute_id+``).append(`<option value = "`+result[key].id+`">`+result[key].value_name+`</option>`);
                                })


                            }
                            //  console.log(result.value_name)

                             }})


                    });


                }else{
                   $("#attribute").empty();
                }
               }
            });
        }else{
            $("#attribute").empty();
            $("#item").empty();
        }
       });




</script>

@endsection
