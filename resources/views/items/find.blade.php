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

		<div class="col-lg-3  d-none d-lg-block">
		<h4 class="text-muted">filter by</h4>

		@foreach($attrributeValue as $attribute)
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
			@endforeach

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
		url:"{{route('search.action')}}",
		method:'GET',
		data:{query:query},
		dataType:'json',
		success:function(data)
		{
			$('#lost').html(data.div_data);
		}
	});
}
$(document).on('keyup' , '#search' , function(){
	var query = $(this).val();
	fetch_Data(query);
});
});
</script>




@endsection