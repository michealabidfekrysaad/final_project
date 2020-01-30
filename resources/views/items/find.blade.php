@extends('layouts.app')

@section('content')

    <div class="pt-5 container-fluid">
        <div class="row mt-2 pt-5 section-header">
            <h2 class="mx-auto">all Found Items</h2>
        </div>
        <h2 class="filter_data d-block"></h2>
        <div class="row justify-content-end ">
            <div class="col-lg-9 col-md-12">
                <input type="text" id="search"  class="form-control mb-3 " placeholder="searching for lost Item by name "> </div>
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
                                    <option value="none" selected disabled hidden>
                                    </option>

                                    @foreach ($categories as $category)
                                        <option value="{{$category->category_name}}">{{$category->category_name}} </option>
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
                                    <option value="none" selected disabled hidden>
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




{{--                @foreach($attrributeValue as $attribute)--}}
{{--                    <article class="card-group-item">--}}
{{--                        <header class="card-header">--}}
{{--                            <h6 class="title">{{$attribute->attribute_name}} : </h6>--}}
{{--                        </header>--}}
{{--                        <div class="filter-content">--}}
{{--                            <div class="card-body">--}}

{{--                                @foreach($attribute->valuesofattributes as $value)--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <span class="float-right badge badge-light round">52</span>--}}
{{--                                        <input type="checkbox" class="custom-control-input gender" id="{{$value->value_name}}" name="{{$value->value_name}}" value="{{$value->value_name}}">--}}
{{--                                        <label class="custom-control-label" for="{{$value->value_name}}">{{$value->value_name}}</label>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}


{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}
{{--                @endforeach--}}

            </div>

            <div class="col-lg-9 col-md-12 ">
                <section id="hotels" class="section-with-bg ">

                    <div class="container">
                        <div class="row" id="lost">
                            @foreach($items as  $item)
                                <div class="col-lg-4 col-md-6" >
                                    <div class="hotel text-center">
                                        <div class="hotel-img">
                                            <a href="/showReportItem/{{$item->id}}"><img src="https://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}" alt="Img Of Person" class="img-fluid"></a>
                                        </div>
                                        <h3>{{($item->category)->category_name}}</h3>
                                        <h3>Found Since : {{$item->found_since}}</h3>

                                    </div>
                                </div>
                                @endforeach




                        </div>

                    </div>

                </section>
            </div>
            </article>
            {{$items->links()}}
        </div>
    </div>


    <script>
        $(document).ready(function(){

            //fetch_Data();

            function fetch_Data(query = ''){
                $.ajax({
                    url:"{{route('search.actionItem')}}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        //$('#lost').html(data.div_data);
                        insertToHtml(data)
                    }
                });
            }
            function insertToHtml(data){

                let d1 = document.getElementById('lost');
                d1.innerHTML=" ";
                data.forEach(element => {
                    d1.insertAdjacentHTML('beforeend', `
	<div class="col-lg-4 col-md-6" >
	<div class="hotel text-center">
	<div class="hotel-img">
		 <img src="https://loseall.s3.us-east-2.amazonaws.com/${element.image}" alt="Img Of Person" class="img-fluid">
	</div>
<h3>${element.category_id}</a></h3>

	</div>
	</div>

	`)

                });

            }
            $(document).on('keyup' , '#search' , function(){
                var query = $(this).val();
                fetch_Data(query);
            });
        });
    </script>


    <script>
        $('#city').change(function(){
            var cityID = $(this).val();
            if(cityID){
                $.ajax({
                    type:"GET",
                    url:"/get-area/"+cityID,
                    success:function(regions){
                        if(regions){
                            $("#region").empty();
                            $("#region").append('<option selected disabled hidden value="none"></option>');
                            $.each(regions,function(key,value){
                                $("#region").append('<option value="'+regions[key].id+'">'+regions[key].area_name+'</option>');
                            });



                        }else{
                            $("#region").empty();
                        }
                    }
                });
            }else{
                $("#region").empty();
                $("#city").empty();
            }
        });
        $('#CategoryList').change(function(){
            var category_id = $(this).val();
            console.log(category_id);
            if(category_id){
                $.ajax({
                    type:"GET",
                    url:"/getforitem/"+category_id,
                    success:function(category){
                        if(category){
                            $("#attribute").empty();
                            $.each(category[0].attributes,function(key,value){
                                let itemAttributes=category[0].attributes;
                                $("#attribute").append( `<label>`+itemAttributes[key].attribute_name+`</label>
                                         <select class="form-control" name="+itemAttributes[key].attribute_name+" id = "+itemAttributes[key].id+">
                                         </select>`);


                                $.ajax({
                                    type:"GET",
                                    url:"/valueofattribute/"+itemAttributes[key].id,
                                    success:function(result){
                                        if(result){
                                            $.each(result,function(key,value){
                                                $(`#`+result[key].attribute_id+``).append(`<option value = "`+result[key].id+">`+result[key].value_name+`</option>`);
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
                $("#CategoryList").empty();
            }
        });
    </script>




@endsection
