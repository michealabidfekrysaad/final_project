@extends('layouts.app')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success" role="alert">
	<strong>Success</strong>{{session()->get('message')}}
</div>
@endif
<div class="pt-5 container-fluid">
	<div class="row mt-2 pt-5 section-header">
		<h2 class="mx-auto">{{ __('messages.all lost people') }}</h2>
	</div>
	<div class="row justify-content-end ">
		<div class="col-lg-9 col-md-12">
			<input type="text" id="search" class="form-control mb-3 " placeholder="{{ __('messages.searching for lost people by name ') }}">
		</div>
	</div>

	<div class="row w-100 mx-auto ">

		<div class="col-lg-3 d-lg-block">

			<h4 class="text-muted">{{ __('messages.filter by') }}</h4>

			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">{{ __('messages.Gender') }}</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							<!-- <span class="float-right badge badge-light round">52</span> -->
							<input type="checkbox" class="custom-control-input gender" id="Check1" name="male" value="male">
							<label class="custom-control-label" for="Check1">{{ __('messages.Male') }}</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<!-- <span class="float-right badge badge-light round">132</span> -->
							<input type="checkbox" class="custom-control-input gender" id="Check2" name="female" value="female">
							<label class="custom-control-label" for="Check2">{{ __('messages.Female') }}</label>
						</div> <!-- form-check.// -->

					</div> <!-- card-body.// -->
				</div>
			</article>



			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">{{ __('messages.Age: ') }}</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							{{-- <span class="float-right badge badge-light round">number from database</span>--}}
							<input type="checkbox" class="custom-control-input age" name="below_10_years" id="CheckAge1" value="below_10_years">
							<label class="custom-control-label" for="CheckAge1">{{ __('messages.Under 10 Years old') }}</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							{{-- <span class="float-right badge badge-light round">number from database</span>--}}
							<input type="checkbox" class="custom-control-input age" name="below_20_years" id="CheckAge2" value="below_20_years">
							<label class="custom-control-label" for="CheckAge2">{{ __('messages.Between 11 and 20 Years old') }}</label>
						</div>

						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input age" name="below_30_years" id="CheckAge3" value="below_30_years">
							<label class="custom-control-label" for="CheckAge3">{{ __('messages.Between 21 and 30 Years old') }}</label>
						</div>

						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input age" name="other_above_30" id="CheckAge4" value="other_above_30">
							<label class="custom-control-label" for="CheckAge4">{{ __('messages.Above 30 Years old') }}</label>
						</div>

					</div> <!-- card-body.// -->
				</div>
			</article>


			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">{{ __('messages.City:') }}</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="form-group">
							<select class="form-control " id="DropDownList1" name="city">
								<option value="" >{{ __('messages.All') }}</option>
                                @foreach ($cities as $city)
                                    @if(app()->getLocale()=='ar')
                                        <option value="{{$city->id}}">{{$city->city_name_ar}} </option>
                                    @else
                                        <option value="{{$city->id}}">{{$city->city_name}} </option>
                                    @endif
                                @endforeach
							</select>
						</div>

					</div> <!-- card-body.// -->
				</div>
			</article>


			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">{{ __('messages.Region :') }}</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="form-group">
							<label for="title">{{ __('messages.select region:') }}</label>
							<select name="region" id="region" class="form-control">
								<option hidden value="">{{ __('messages.Select City First') }}</option>
							</select>
						</div>
					</div> <!-- card-body.// -->
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
    let globalArray=[];
    function paginate (array) {
        document.getElementById("lost").innerHTML="";
        document.getElementById("pages").innerHTML="";
        globalArray=[];
        let slicedArray;
        let pageNumber=0;
        let SPAN=document.getElementById('pages')
        for (let i=0;i<array.length;i+=6) {
            pageNumber++

            SPAN.insertAdjacentHTML("beforeend",
                `<button id='${i/6}' class="pn btn" style="margin:2px" onclick="changeColor();setHtmlAndInsert(getAttribute('id'));this.style.backgroundColor='red';this.style.color='white'">${pageNumber}</button>
`)
            slicedArray = array.slice(i,i+6);
            // console.log(slicedArray);
            globalArray.push(slicedArray);
        }
          document.getElementById("0").style.backgroundColor="red"
		  document.getElementById("0").style.color="white"
    }
    function setHtmlAndInsert(id) {
         insertToHtml(globalArray[id]);
    }
    function insertToHtml(data) {
         let d1 = document.getElementById('lost');
         d1.innerHTML = " ";
        data.forEach(element => {
            d1.insertAdjacentHTML('beforeend', `
	<div class="col-lg-4 col-md-6" >
		<div class="hotel text-center">
		<div class="hotel-img" >

		 	<a href="/people/details/${element.id}"><img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/${element.image}" alt="Img Of Person" class="img-fluid"></a>
		</div>
			<h3>${element.name}</h3>
			<p>Age is :${element.age}</p>
			<p>${element.gender}</p>
<!--        	<p>Click On  Image for more details</p>-->
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
            // console.log(elements[i].id)
        }
    }
	$(document).ready(function() {
		fetch_Data();
		function fetch_Data(query = '') {
			$.ajax({
				url: "{{route('search.action')}}",
				method: 'GET',
				data: {
					query: query
				},
				dataType: 'json',
				success: function(data) {
				    console.log(data)
				   let d1= document.getElementById("lost")
                    let SPAN= document.getElementById("pages")
                    d1.innerHTML=" ";
                    SPAN.innerHTML = " ";
                    if(data.length !=0){
                        paginate(data)
                        insertToHtml(globalArray[0]);
                    }
                    else{
                        d1.innerHTML="No Results Founded";
                        SPAN.innerHTML = " ";
                    }
				}
			});
		}
		$(document).on('keyup', '#search', function() {
			var query = $(this).val();
			//filter_data()
			fetch_Data(query);
		});

		function filter_data() {

			var gender = get_filter('gender');
			var age = get_filter('age');
            var city
            var region
            if ($("#DropDownList1 :selected").text() != "All" || $("#DropDownList1 :selected").text() != "الكل") {
				 city = $("#DropDownList1 :selected").val();

			}
			else{
				 city ="";
			}
            if ($("#region :selected").text() != "All" || $("#region :selected").text() != "الكل") {
                 region = $("#region :selected").val();
            }
            else{
                 region ="";
            }
			var data = {
				gender,
				city,
				age,
                region
			};
			if ((data.gender).length != 0 || data.city != "" || data.region != "" || (data.age).length != 0) {
                console.log(JSON.stringify(data));
				$.ajax({
					method: "GET",
                    url: "/filter/" + JSON.stringify(data),
                    traditional: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    //data: JSON.stringify(data),
                    success: function (data) {
                        console.log(data)
                        if(data.length != 0){
                            paginate(data)
                            console.log(globalArray[0])
                            insertToHtml(globalArray[0]);
                        }
			else{
			    document.getElementById("lost").innerHTML="No Results Founded"
                            document.getElementById("pages").innerHTML = " ";
                        }
					}
                });
            } else {
                fetch_Data()
            }
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        }

        $('.custom-control-input').click(function () {
            filter_data();
        });
        $("#DropDownList1").change(function (e) {
            filter_data();
        });


        $("#DropDownList1").change(function (e) {
            var cityID = $(this).val();
            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "/get-area/" + cityID,
                    success: function (regions) {
                        if (regions) {
                            $("#region").empty();
                            $("#region").append('' + '' + '' + '' +
                                '@if(app()->getLocale()=="ar")
                                    <option selected value="">الكل</option>@else
                                    <option selected value="">All</option>@endif'
                            );
                            $.each(regions, function (key, value) {
                                $("#region").append('@if(app()->getLocale()=="ar")<option value="' + regions[key].id + '">' + regions[key].area_name_ar + '</option>@else"<option value="' + regions[key].id + '">' + regions[key].area_name + '</option>"@endif');
                            });
                        } else {
                            $("#region").empty();
                        }
                    }
                });
            } else {
                $("#region").empty();
                $("#region").append('<option hidden value="">Select City First</option>');
                $("#city").empty();
            }
            // filter_data_item();
        });

        $("#region").change(function (e) {

             filter_data();

        })
    });
</script>


@endsection
