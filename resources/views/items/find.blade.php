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
						<select class="form-control " id="DropDownList1" name="category">
							<option value="none" selected disabled hidden>
								Select an Option
							</option>

							@foreach ($categories as $category)
							<option value="{{$category->category_name}}">{{$category->category_name}} </option>
							@endforeach
						</select>
					</div>
			
				</div> <!-- card-body.// -->
			</div>

		</article>

		<article class="card-group-item">
			<header class="card-header">
				<h6 class="title">City :</h6>
			</header>

			<div class="filter-content">
				<div class="card-body">
					<div class="form-group">
						<select class="form-control " id="city" name="city">
							<option value="none" selected disabled hidden>
								Select an Option
							</option>

							@foreach ($cities as $city)
							<option value="{{$city}}">{{$city}} </option>
							@endforeach
							
						</select>
					</div>
			
				</div> <!-- card-body.// -->
			</div>

		</article>

		<article class="card-group-item">
			<header class="card-header">
				<h6 class="title">Region :</h6>
			</header>

			<div class="filter-content">
				<div class="card-body">
					<div class="form-group">
						<select class="form-control " id="DropDownList1" name="city">
							<option value="none" selected disabled hidden>
								Select an Option
							</option>

							@foreach ($cities as $city)
							<option value="{{$city}}">{{$city}} </option>
							@endforeach
							
						</select>
					</div>
			
				</div> <!-- card-body.// -->
			</div>

		</article>
			

		{{-- @foreach($attrributeValue as $attribute)
			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">{{$attribute->attribute_name}} : </h6>
				</header>
				<div class="filter-content">
					<div class="card-body">

						@foreach($attribute->valuesofattributes as $value)
						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">52</span>
							<input type="checkbox" class="custom-control-input gender" id="{{$value->value_name}}" name="{{$value->value_name}}" value="{{$value->value_name}}">
							<label class="custom-control-label" for="{{$value->value_name}}">{{$value->value_name}}</label>
						</div>
						@endforeach
 

					</div> 
				</div>
			</article>
			@endforeach --}}

		</div>

		<div class="col-lg-9 col-md-12 ">
			<section id="hotels" class="section-with-bg ">

				<div class="container">
					<div class="row" id="lost">

						




					</div>

				</div>

			</section>
		</div>
  </article>
  
 </div>
</div>


<script>
	 $(document).ready(function(){

fetch_Data();

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
	<a href="/showRepoItems/${element.id}">
	<div class="hotel-img">	
		 <img src="${element.image}" alt="Img Of Person" class="img-fluid">
	</div>
		<h3><a href="/showRepoItems/${element.id}">${element.image}</a></h3>

	</a>
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
	console.log(cityID);
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