@extends('layouts.AdminPanel.page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-b-40">

                        <form action="/item/update/{{$item->id}}" method="POST" enctype="multipart/form-data">
                            @METHOD('PUT')
                            @csrf
                            <div class="row">
                                <div class="text-center col-md-12 mb-3">
                                    <h4 class="text-muted">it is not the best choice to update the report of the item
                                        without the
                                        knowledge of the owner
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Select_file">Upload Image :</label>
                                        <input type="file" class="form-control" name="image" id="fileUpload"
                                               accept=".jpg,.jpeg,.png" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">found since:</label>
                                        <input type="date" name="found_since" value="{{$item->found_since}}"
                                               class="form-control"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">select city:</label>
                                        <select name="city_id" id="city_id" class="form-control">
                                            @foreach($city as $c)
                                                @if(($item->city)->id !=$c->id)
                                                    <option value="{{$c->id}}">{{$c->city_name}}</option>
                                                @else
                                                    <option value="{{$c->id}}" selected>{{$c->city_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">select area:</label>
                                        <select name="area_id" id="state" class="form-control">
                                            @foreach($area as $key => $a)
                                                @if(($item->area)->id !=$a->id)
                                                    <option value="{{$a->id}}">{{$a->area_name}}</option>
                                                @else
                                                    <option value="{{$a->id}}" selected>{{$a->area_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group w-50 mx-auto">
                                <label for="title" class="text-danger">update category</label>
                                <select name="category_id" id="category_id" class="form-control ">
                                    @foreach($category as $key => $c)
                                        @if(($item->category)->id !=$c->id)
                                            <option value="{{$c->id}}">{{$c->category_name}}</option>
                                        @else
                                            <option value="{{$c->id}}" selected>{{$c->category_name}}</option>

                                        @endif
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group w-50 mx-auto" id="attribute">
                                <label for="title" class="text-danger">update attribute</label><br>
                                @foreach($attributes as $key => $attribute)
                                    @foreach ($attribute->attributes as $categoryitem)

                                        <label>{{$categoryitem->attribute_name}}</label>
                                        <select name="#{{$categoryitem->attribute_name}}" id="{{$categoryitem->id}}"
                                                value="{{$categoryitem->id}}" class="form-control">

                                            @foreach($values as $onevalue)
                                                @foreach($onevalue->valuesOfAttributes as $oneattribute)
                                                    @if($categoryitem->id == $oneattribute->attribute_id)
                                                        <option
                                                            value="{{$oneattribute->id}}">{{$oneattribute->value_name}}</option>

                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>

                                    @endforeach

                                @endforeach

                            </div>

                            <div class="text-center mt-5 mx-auto w-50">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#city_id').change(function () {
            var cityID = $(this).val();
            // console.log(cityID);

            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-state-list')}}?city_id=" + cityID,
                    success: function (states) {
                        console.log(states);
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

        $('#category_id').change(function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type: "GET",
                    url: "/get/" + category_id,
                    success: function (category) {
                        if (category) {
                            $("#attribute").empty();
                            $("#attribute").append('<label for="title" class="text-danger">update attribute</label><br>')
                            $.each(category[0].attributes, function (key, value) {
                                let itemAttributes = category[0].attributes;
                                $("#attribute").append(`<label>` + itemAttributes[key].attribute_name + `</label>
                                         <select class="form-control" name="#` + itemAttributes[key].attribute_name + `"
                                         id = "` + itemAttributes[key].id + `" value = "` + itemAttributes[key].id + `">
                                         </select>`);


                                $.ajax({
                                    type: "GET",
                                    url: "/valueofattribute/" + itemAttributes[key].id,
                                    success: function (result) {
                                        if (result) {
                                            $.each(result, function (key, value) {
                                                $(`#` + result[key].attribute_id + ``).append(`<option value = "` + result[key].id + `">` + result[key].value_name + `</option>`);
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
