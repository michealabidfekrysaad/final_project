@extends('layouts.app')

@section('content')

<div class="pt-5 container-fluid">
    <div class="row mt-2 pt-5 section-header">
        <h2 class="mx-auto">all Found Items</h2>
    </div>
    <h2 class="filter_data d-block"></h2>
    <div class="row justify-content-end ">
        <div class="col-lg-9 col-md-12">



            <input type="text" id="search" class="form-control mb-3 " placeholder="searching for lost Item by name "> </div>
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
                                <option value="" selected disabled hidden>
                                </option>

                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}} </option>
                                @endforeach
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
                                <option value="" selected disabled hidden>
                                </option>

                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}} </option>
                                @endforeach

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
                                <div class="hotel-img" style="width:348px;height:348px">
                                    <a href="/showReportItem/{{$item->id}}"><img src="https://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}" alt="Img Of Person" class="img-fluid"></a>
                                </div>
                                <h3>{{($item->category)->category_name}}</h3>
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
    $(document).ready(function() {
        //fetch_Data();
        function fetch_Data(query = '') {
            $.ajax({
                url: "{{route('search.actionItem')}}",
                method: 'GET',
                data: {
                    query: query
                },
                dataType: 'json',
                success: function(data) {
                    //$('#lost').html(data.div_data);
                    insertToHtml(data);

                }
            });
        }

        $("#CategoryList").change(function(e) {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type: "GET",
                    url: "/getforitem/" + category_id,
                    success: function(category) {
                        if (category) {
                            $("#attribute").empty();
                            $("#attribute").append(' <option value="" selected disabled hidden>\n' +
                                '                                </option>');

                            $.each(category[0].attributes, function(key, value) {
                                let itemAttributes = category[0].attributes;
                                $("#attribute").append(`<label>` + itemAttributes[key].attribute_name + `</label>
                                         <select class=" form-control" name="` + itemAttributes[key].attribute_name + `" id = "` + itemAttributes[key].id + `">
                                         </select>`);
                                $.ajax({
                                    type: "GET",
                                    url: "/valueofattribute/" + itemAttributes[key].id,
                                    success: function(result) {
                                        if (result) {
                                            $.each(result, function(key, value) {
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
                $("#CategoryList").empty();
            }

            filter_data_item();

        })
        $("#city").change(function(e) {
            var cityID = $(this).val();
            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "/get-area/" + cityID,
                    success: function(regions) {
                        if (regions) {
                            $("#region").empty();
                            $("#region").append('<option selected disabled hidden value=""></option>');
                            $.each(regions, function(key, value) {
                                $("#region").append('<option value="' + regions[key].id + '">' + regions[key].area_name + '</option>');
                            });
                        } else {
                            $("#region").empty();
                        }
                    }
                });
            } else {
                $("#region").empty();
                $("#city").empty();
            }
            filter_data_item();

        })
        $("#region").change(function(e) {

            filter_data_item();

        })
        // $("#attribute").change(function (e) {
        //
        //     // filter_data_item();
        //
        // })
        $("#attribueselect").select(function(e) {
            console.log("jjj");
            filter_data_item();
        })

        function filter_data_item() {
            var category_id = $("#CategoryList :selected").attr("value");
            var city_id = $("#city :selected").attr("value");
            var area_id = $("#region :selected").attr("value")
            let attribute = $("#attribute :selected").filter();
            let array = [];
            for (let index = 0; index < attribute.prevObject.length; index++) {
                const element = attribute.prevObject[index];
                if (element.innerHTML != "") {
                    array.push(element.innerHTML);
                }
            }
            var data = {
                category_id,
                city_id,
                area_id,
            }
            if (data.category_id || data.city_id || data.area_id) {
                console.log(data);
                $.ajax({
                    method: "GET",
                    url: "/filter/find/item/" + JSON.stringify(data),
                    traditional: true,
                    success: function(data) {
                        console.log(data);
                        insertToHtml(data)
                    }
                });
            }
        }

        function insertToHtml(data) {
            d1.innerHTML = " ";
            $("#next").remove();
            $("#pre").remove();
            data.data.forEach(element => {
                d1.insertAdjacentHTML('beforeend', `
      <div class="col-lg-4 col-md-6" >
                                    <div class="hotel text-center">
                                        <div class="hotel-img" style="width:348px;height:348px">
                                            <a href="/showReportItem/${element.id}"><img src="https://loseall.s3.us-east-2.amazonaws.com/${element.image}" alt="Img Of Person" class="img-fluid"></a>
                                        </div>
  <h3>${(element.category).category_name}</h3>

                                        <h3>Found Since : ${element.found_since}</h3>

                                    </div>
                                </div>

	`)
            });
            const footer = document.getElementById('footer1');
            const button = document.createElement('button');
            const button1 = document.createElement('button');
            button.id = "next";
            button1.id = "pre";
            button.innerHTML = "NEXT"
            button1.innerHTML = "PREVIOUS"
            button.value = data.next_page_url;
            button1.value = data.last_page_url;
            button.classList.add("btn");
            button.classList.add("ml-3");
            button1.classList.add("btn");
            footer.appendChild(button1);
            footer.appendChild(button);
            button.addEventListener("click", function(e) {
                $.get(e.target.value, function(response) {
                    insertToHtml(response)
                });
            })
            button1.addEventListener("click", function(e) {
                if (data.next_page_url == null) {
                    e.target.value = data.first_page_url;
                }
                $.get(e.target.value, function(response) {
                    insertToHtml(response)
                });
            })
        }
    });
</script>
@endsection