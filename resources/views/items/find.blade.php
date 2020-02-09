@extends('layouts.app')

@section('content')

<div class="pt-5 container-fluid">
    <div class="row mt-2 pt-5 section-header">
        <h2 class="mx-auto">all Found Items</h2>
    </div>
    <h2 class="filter_data d-block"></h2>
    <div class="row justify-content-end ">
        <div class="col-lg-9 col-md-12">



            <input type="text" id="search" class="form-control mb-3 " placeholder="searching for lost Item by name ">
        </div>
    </div>
    <div class="row w-100 mx-auto ">
        {{-- d-none --}}
        <div class="col-lg-3   d-lg-block">
            <h4 class="text-muted">filter by</h4>

            <article class="card-group-item">
                <header class="card-header">
                    <h6 class="title">Category :</h6>
                </header>

                <div class="filter-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Select Category:</label>
                            <select class="form-control " id="CategoryList" name="category">
                                @if(app()->getLocale()=='ar')
                                <option value="" selected>الكل</option>
                                @else
                                <option value="" selected>All</option>
                                @endif
                                @if(app()->getLocale()=='ar')
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name_ar}} </option>
                                @endforeach
                                @else
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}} </option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                    </div> <!-- card-body.// -->
                </div>

            </article>
            <article>

                <div class="filter-content">
                    <div class="card-body">
                        <div class="form-group">

                            <div class="form-group" id="attribute">

                            </div>

                        </div>

                    </div>

                </div>



            </article>


            <article class="card-group-item">
                <header class="card-header">
                    <h6 class="title">City :</h6>
                </header>

                <div class="filter-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Select City:</label>
                            <select class="form-control " id="city" name="city">
                                @if(app()->getLocale()=='ar')
                                <option value="">الكل</option>
                                @else
                                <option value="">All</option>
                                @endif
                                @if(app()->getLocale()=='ar')
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name_ar}} </option>
                                @endforeach
                                @else
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}} </option>
                                @endforeach

                                @endif

                            </select>
                        </div>

                    </div> <!-- card-body.// -->
                </div>

            </article>

            <article class="card-group-item">
                <header class="card-header">
                    <h6 class="title">region :</h6>
                </header>

                <div class="filter-content">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">select region:</label>
                            <select name="region" id="region" class="form-control">
                                <option hidden value="">{{__('messages.Select City First') }}</option>
                            </select>
                        </div>
                    </div>
            </article>


        </div>

        <div class="col-lg-9 col-md-12 ">
            <section id="hotels" class="section-with-bg ">

                <div class="container">
                    <div class="row" id="lost">
                        @foreach($items as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="hotel text-center">
                                <div class="hotel-img">
                                    <a href="/showReportItem/{{$item->id}}"><img style="width:348px;height:348px"
                                            src="https://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}"
                                            alt="Img Of Person" class="img-fluid"></a>
                                </div>
                                @if(app()->getLocale()=='ar')
                                <h3>{{($item->category)->category_name_ar}}</h3>
                                @else
                                <h3>{{($item->category)->category_name}}</h3>
                                @endif
                                <h3>Found Since : {{$item->found_since}}</h3>

                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="row">
                        {{$items->links()}}
                    </div>
                    <div class="row justify-content-center" id="footer1">

                    </div>

                </div>

            </section>
        </div>
        </article>
    </div>
</div>


<script>
    let d1 = document.getElementById('lost');
    $(document).ready(function () {
        //fetch_Data();
        function fetch_Data(query = '') {
            $.ajax({
                method: 'GET',
                url: "/liveSearch/actionItem",
                data: {
                    query: query
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    //$('#lost').html(data.div_data);
                    insertToHtml(data);

                }
            });
        }

        $("#CategoryList").change(function (e) {
            console.log($(this).val());
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type: "GET",
                    url: "/getforitem/" + category_id,
                    success: function (category) {
                        if (category) {
                            $("#attribute").empty();
                            $.each(category[0].attributes, function (key, value) {
                                let itemAttributes = category[0].attributes;
                                $("#attribute").append(`
@if(app()->getLocale()=='ar')
                                <label>` + itemAttributes[key].attribute_name + `</label>
                                         <select class=" form-control" name="` + itemAttributes[key].attribute_name + `" id = "` + itemAttributes[key].id + `">
                                         <option value = " ">الكل</option>
                                         </select>
                                         @else
                                <label>` + itemAttributes[key].attribute_name + `</label>
                                         <select class=" form-control" name="` + itemAttributes[key].attribute_name + `" id = "` + itemAttributes[key].id + `">
                                         <option value = " ">All</option>
                                         </select>
                                    @endif
                                `);
                                $.ajax({
                                    type: "GET",
                                    url: "/valueofattribute/" + itemAttributes[key].id,
                                    success: function (result) {
                                        if (result) {
                                            $.each(result, function (key, value) {
                                                console.log("isalm" + result[key].value_name);
                                                $(`#` + result[key].attribute_id + ``).append(`
@if(app()->getLocale()=='ar')
                                                <option value = " ` + result[key].id + `"> ` + result[key].value_name_ar + `</option>
@else
                                                <option value = " ` + result[key].id + `"> ` + result[key].value_name + `</option>
                                                @endif
                                                `);
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
                // $("#CategoryList").empty();
                fetch_Data();
            }

            filter_data_item();

        });
        $("#city").change(function (e) {
            var cityID = $(this).val();
            console.log(cityID);

            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "/get-area/" + cityID,
                    success: function (regions) {
                        if (regions) {
                            $("#region").empty();
                            $("#region").append('@if(app()->getLocale()=="ar")<option selected  value="">الكل</option>@else<option selected  value="">All</option> @endif');
                            $.each(regions, function (key, value) {
                                $("#region").append('' +
                                    '@if(app()->getLocale()=="ar")<option value="' + regions[key].id + '">' + regions[key].area_name_ar + '</option>@else <option value="' + regions[key].id + '">' + regions[key].area_name + '</option>@endif');
                            });
                        } else {
                            $("#region").empty();
                        }
                    }
                });
            } else {
                $("#region").empty();
                $("#region").append('<option hidden value="">{{__('messages.Select City First') }}</option>');
                fetch_Data();
                // $("#city").empty();
            }
            filter_data_item();

        });


        $("#region").change(function (e) {

            filter_data_item();

        });
        $("#search").keyup(function (e) {
            console.log(document.getElementById("search").value);
            fetch_Data(document.getElementById("search").value)

        });
        // $("#attribute").change(function (e) {
        //
        //     // filter_data_item();
        //
        // })
        $("#attribueselect").select(function (e) {
            console.log("jjj");
            filter_data_item();
        });

        function filter_data_item() {
            var category_id = $("#CategoryList :selected").val();
            var city_id = $("#city :selected").val();
            var area_id = $("#region :selected").val();
            var data = {
                category_id,
                city_id,
                area_id
            };
            console.log(data);
            if (data.category_id || data.city_id || data.area_id) {
                console.log(data);
                $.ajax({
                    method: "GET",
                    url: "/filter/find/item/" + JSON.stringify(data),
                    traditional: true,
                    success: function (data) {
                        console.log(data.data);
                        insertToHtml(data.data)
                    }
                });
            }
        }


        function insertToHtml(data) {
            d1.innerHTML = " ";
            $("#next").remove();
            $("#pre").remove();
            data.forEach(element => {
                d1.insertAdjacentHTML('beforeend', `
                     <div class="col-lg-4 col-md-6" >
                                    <div class="hotel text-center">
                                        <div class="hotel-img" >
                                            <a href="/showReportItem/${element.id}"><img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/${element.image}" alt="Img Of Person" class="img-fluid"></a>
                                        </div>
{{--@if(app()->getLocale()=='ar')--}}
                {{--                <h3>${element.category_name_ar}</h3>--}}
                {{--                    @else--}}
                {{--                <h3>${element.category_name}</h3>--}}
                {{--                    @endif--}}

                <h3>Found Since : ${element.found_since}</h3>

                                    </div>
                                </div>

	`)
            });
        }
    });
</script>
@endsection