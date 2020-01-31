@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@if(session()->has('message'))
<div class="alert alert-success" role="alert">
	<strong>Success</strong>{{session()->get('message')}}
</div>
@endif
<div class="pt-5 container-fluid">
	<div class="row mt-2 pt-5 section-header">
		<h2 class="mx-auto">all lost people</h2>


	</div>
	<h2 class="filter_data d-block"></h2>
	<div class="row justify-content-end ">
		<div class="col-lg-9 col-md-12">
			<input type="text" id="search" class="form-control mb-3 " placeholder="searching for lost people by name ">
		</div>
	</div>
	<div class="row w-100 mx-auto ">

		<div class="col-lg-3  d-none d-lg-block">

			<h4 class="text-muted">filter by</h4>
			
			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">Category: </h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						{{-- kan feh male w female masa7to w ana 3ayezhom --}}

					</div> <!-- card-body.// -->
				</div>
			</article>

			

			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">Age: </h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">number from database</span>
							<input type="checkbox" class="custom-control-input age" name="below_10_years" id="CheckAge1"
								value="below_10_years">
							<label class="custom-control-label" for="CheckAge1">below 10 years</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">number from database</span>
							<input type="checkbox" class="custom-control-input age" name="below_20_years" id="CheckAge2"
								value="below_20_years">
							<label class="custom-control-label" for="CheckAge2">below 20 years</label>
						</div>

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">number from database</span>
							<input type="checkbox" class="custom-control-input age" name="below_30_years" id="CheckAge3"
								value="below_30_years">
							<label class="custom-control-label" for="CheckAge3">below 30 years</label>
						</div>

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">number from database</span>
							<input type="checkbox" class="custom-control-input age" name="other_above_30" id="CheckAge4"
								value="other_above_30">
							<label class="custom-control-label" for="CheckAge4">other > 30</label>
						</div>

					</div> <!-- card-body.// -->
				</div>
			</article>


			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">City:</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="form-group">
							<select class="form-control " id="DropDownList1" name="city">
								<option value=""> </option>
								<option value="Alexandria">Alexandria </option>
								<option value="Cairo">Cairo</option>
								<option value="Portsaid">Portsaid</option>
								<option value="Golden">Golden</option>
							</select>
						</div>
						<!-- <div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">52</span>
							<input type="checkbox" class="custom-control-input" id="City1">
							<label class="custom-control-label" for="City1">Alexandria</label>
						</div> 
					-->
					</div> <!-- card-body.// -->
				</div>
			</article>


			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">Region :</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">52</span>
							<input type="checkbox" class="custom-control-input region" id="region1" value="sidibishr">
							<label class="custom-control-label" for="region1">sidibishr</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">132</span>
							<input type="checkbox" class="custom-control-input region" id="region2" value="region">
							<label class="custom-control-label" for="region2">sidibishr</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">17</span>
							<input type="checkbox" class="custom-control-input region" id="region3" value="region">
							<label class="custom-control-label" for="region3">Portsaid</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">7</span>
							<input type="checkbox" class="custom-control-input region" id="region4" value="region">
							<label class="custom-control-label" for="region4">Minia</label>
						</div> <!-- form-check.// -->
					</div> <!-- card-body.// -->
				</div>
			</article>

		</div>

		<div class="col-lg-9 col-md-12 ">
			<section id="hotels" class="section-with-bg ">

				<div class="container">
					<div class="row" id="htmlinject">

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
			
			 console.log(data);
			insertToHtml(data)
		
		}
	});
}
function insertToHtml(data){

let d1 = document.getElementById('htmlinject');
d1.innerHTML=" ";
data.forEach(element => {
	d1.insertAdjacentHTML('beforeend', `
	<div class="col-lg-4 col-md-6" >
	<div class="hotel text-center">
	<a href="/showRepo/${element.id}">
	<div class="hotel-img">	
		 <img src="${element.image}" alt="Img Of Person" class="img-fluid">
	</div>
		<h3><a href="/showRepo/${element.id}">${element.name}</a></h3>
		<p>Age is :${element.age}</p>
		<span>last seen on  :${element.last_seen_on}</span>

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




@endsection