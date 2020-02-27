@extends('layouts.app')

@section('content')

<div class="pt-5 container-fluid">
    <div class="row mt-2 pt-5 section-header">
        <h2 class="mx-auto">{{ __('messages.all Found Items') }}</h2>
    </div>
	
    <div class="row w-100 mx-auto ">
        <div class="col-lg-3   d-lg-block">
            <h4 class="text-muted">{{ __('messages.filter by') }}</h4>

            <article class="card-group-item">
                <header class="card-header">
                    <h6 class="title">{{ __('messages.Category :') }}</h6>
                </header>

                <div class="filter-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">{{ __('messages.Select Category:') }}</label>
                            <select class="form-control " id="CategoryList" name="category">
                                <option value="" selected>{{ __('messages.All') }}</option>


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
                    <h6 class="title">{{ __('messages.City :') }}</h6>
                </header>

                <div class="filter-content">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">{{ __('messages.Select City:') }}</label>
                            <select class="form-control " id="city" name="city">
                                <option value="">{{ __('messages.All') }}</option>

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
                    <h6 class="title">{{ __('messages.region :') }}</h6>
                </header>

                <div class="filter-content">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">{{ __('messages.select region:') }}</label>
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
                    </div>
                    <div class="row justify-content-center" id="pages">
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>
<script>
    function paginate (data) {
        document.getElementById("pages").innerHTML="";
        let SPAN=document.getElementById('pages')
        for (let i=1;i<=data.last_page;i++) {
                SPAN.insertAdjacentHTML("beforeend",
                `<button id='pageBtb${i}' page=${i} path='${data.path}' class="pn btn" style="margin:2px" onclick="changeColor();setHtmlAndInsert(getAttribute('path'),getAttribute('page'));this.style.backgroundColor='red';this.style.color='white'">${i}</button>
`)
        }
        document.getElementById("pageBtb1").style.backgroundColor="red"
        document.getElementById("pageBtb1").style.color="white"
    }
    function setHtmlAndInsert(path,pageNumber) {
        $.get(path+"?page="+pageNumber, function(data, status){
            console.log(data);
            insertToHtml(data);
        });
    }
    function insertToHtml(data) {
        let d1 = document.getElementById('lost');
        d1.innerHTML = " ";
        data.data.forEach(element => {
            d1.insertAdjacentHTML('beforeend', `

                                    <div class="col-lg-4 col-md-6">
                                        <div class="hotel text-center">
                                            <div class="hotel-img">
                                                <a href="/showReportItem/${element.id}"><img style="width:348px;height:348px"
                                                        src="https://loseall.s3.us-east-2.amazonaws.com/${element.image}"
                                                        alt="Img Of Person" class="img-fluid"></a>
                                            </div>
                                            @if(app()->getLocale()=='ar')
                                            <h3>${(element.category).category_name_ar}</h3>
                                            @else
                                            <h3>${(element.category).category_name}</h3>
                                            @endif
                                            <h3> {{ __('messages.Found Since') }} : ${element.found_since}</h3>

                                        </div>
                                    </div>


	`)
        });
    }
    function changeColor() {
        let elements = document.getElementsByClassName("pn");
        for (let i=0; i<elements.length; i++ ) {
            document.getElementById(elements[i].id).style.backgroundColor = "#BBC2C2";
			document.getElementById(elements[i].id).style.color = "black";
        }
    }
    $(document).ready(function () {
        filter_data_item();
        function fetch_Data() {
            $.ajax({
                method: 'GET',
                url: "/fetchall",
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    let d1= document.getElementById("lost")
                    let SPAN= document.getElementById("pages")
                    d1.innerHTML=" ";
                    SPAN.innerHTML = " ";
                    if(data.data.length != 0){
                        console.log(data.last_page)
                        insertToHtml(data);
                        paginate(data)
                    }
                    else{
                         d1.innerHTML="No Results Found";
                        d1.className="row font-weight-bold text-danger";
                    }
                    

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
                                         <select class=" attr form-control" name="attr[]" id = "` + itemAttributes[key].id + `">
                                         <option value = " ">الكل</option>
                                         </select>
                                         @else
                                          <label>` + itemAttributes[key].attribute_name + `</label>
                                         <select class=" attr form-control" name="attr[]" id = "` + itemAttributes[key].id +`">
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
                                                $(`#` + result[key].attribute_id + ``).append(`
@if(app()->getLocale()=='ar')
                                                <option value = " ` + result[key].id + `"> ` + result[key].value_name_ar + `</option>
@else
                                                <option value = " ` + result[key].id + `"> ` + result[key].value_name + `</option>
                                                @endif
                                                `);
                                            })


                                        }

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
                fetch_Data();
            }
            filter_data_item();

        });
        $("#city").change(function (e) {
            var cityID = $(this).val();
            console.log(cityID);
            $("#region").empty();

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
            }
            else {
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
        $("#attribute").change(function (e) {
             values = [];
            $('.attr').each(function(){
                if(this.value !== " ")
                    values.push(this.value);
            });
             console.log(values)
             filter_data_item();

        })
        // $(".attr").change(function (e) {
        //     console.log(values);
        //    // filter_data_item();
        // });
        var data
        var values = [];
        function filter_data_item() {
            var category_id = $("#CategoryList :selected").val();
            var city_id = $("#city :selected").val();
            var area_id = $("#region :selected").val();
            var value_id=values;
             data = {
                category_id,
                city_id,
                area_id,
                value_id
            };
            if (data.category_id !="" || data.city_id !="" || data.area_id !="") {
                console.log(data)
                $.ajax({
                    method: "GET",
                    url: "/filter/find/item/" + JSON.stringify(data),
                    traditional: true,
                    success: function (data) {
                        values=[]
                        console.log(data)
                       let d1= document.getElementById("lost")
                       let SPAN= document.getElementById("pages")
                       d1.innerHTML=" ";
                       SPAN.innerHTML = " ";
                       if(data.data.length != 0){
                           paginate(data)
                           insertToHtml(data);
                       }
                       else{
                           d1.className="row font-weight-bold  text-danger"
                            d1.innerHTML="No Results Found";

                       }
                    }
                });
            }
            else{
                console.log('fetch_Data')
                fetch_Data()
            }
        }
{{--        function insertToHtml(data) {--}}
{{--            let d1=document.getElementById("lost")--}}
{{--            d1.innerHTML = " ";--}}
{{--            // $("#next").remove();--}}
{{--            // $("#pre").remove();--}}
{{--            data.data.forEach(element => {--}}
{{--                d1.insertAdjacentHTML('beforeend', `--}}
{{--                     <div class="col-lg-4 col-md-6" >--}}
{{--                                    <div class="hotel text-center">--}}
{{--                                        <div class="hotel-img" >--}}
{{--                                            <a href="/showReportItem/${element.id}"><img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/${element.image}" alt="Img Of Person" class="img-fluid"></a>--}}
{{--                                        </div>--}}
{{--@if(app()->getLocale()=='ar')--}}
{{--                                <h3>${(element.category).category_name_ar}</h3>--}}
{{--                                    @else--}}
{{--                                <h3>${(element.category).category_name}</h3>--}}
{{--                                    @endif--}}

{{--                <h3>{{ __('messages.Found Since') }} : ${element.found_since}</h3>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

{{--	`)--}}
{{--            });--}}
{{--        }--}}
    });
</script>
@endsection
