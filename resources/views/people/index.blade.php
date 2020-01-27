@extends('layouts.app')

@section('content')
<div class="pt-5 container-fluid">
	<div class="row mt-2 pt-5 section-header">
		<h2 class="mx-auto">all losts people</h2>	
	</div>
	<h2 class="filter_data d-block"></h2>
	<div class="row justify-content-end ">
		<div class="col-lg-9 col-md-12">
			<input type="text" id="search"  class="form-control mb-3 " placeholder="searching for lost people by name "> </div>
		</div>
	<div class="row w-100 mx-auto ">

		<div class="col-lg-3  d-none d-lg-block">
			
			<h4 class="text-muted">filter by</h4>
			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">Gender: </h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">52</span>
							<input type="checkbox" class="custom-control-input gender" id="Check1" name="male" value="male">
							<label class="custom-control-label" for="Check1">male</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">132</span>
							<input type="checkbox" class="custom-control-input gender" id="Check2" name="female" value="female">
							<label class="custom-control-label" for="Check2">female</label>
						</div> <!-- form-check.// -->

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
							<input type="checkbox" class="custom-control-input age" name="below_10_years" id="CheckAge1" value="below_10_years">
							<label class="custom-control-label" for="CheckAge1">below 10 years</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">number from database</span>
							<input type="checkbox" class="custom-control-input age" name="below_20_years" id="CheckAge2" value="below_20_years">
							<label class="custom-control-label" for="CheckAge2">below 20 years</label>
						</div>

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">number from database</span>
							<input type="checkbox" class="custom-control-input age" name="below_30_years" id="CheckAge3" value="below_30_years">
							<label class="custom-control-label" for="CheckAge3">below 30 years</label>
						</div>

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">number from database</span>
							<input type="checkbox" class="custom-control-input age" name="other_above_30" id="CheckAge4" value="other_above_30">
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
								<option  value="Cairo">Cairo</option>
								<option value="Portsaid">Portsaid</option>
								<option value="Golden">Golden</option>
							</select>
						</div>
						<!-- <div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">52</span>
							<input type="checkbox" class="custom-control-input" id="City1">
							<label class="custom-control-label" for="City1">Alexandria</label>
						</div> 

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">132</span>
							<input type="checkbox" class="custom-control-input" id="City2">
							<label class="custom-control-label" for="City2">Cairo</label>
						</div> 

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">17</span>
							<input type="checkbox" class="custom-control-input" id="City3">
							<label class="custom-control-label" for="City3">Portsaid</label>
						</div> 

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">7</span>
							<input type="checkbox" class="custom-control-input" id="City4">
							<label class="custom-control-label" for="City4">Minia</label>
						</div> --> 
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



		<form >

			<div class="form-group">
				<label for="inputName">Name Of Person :</label>
				<input type="text" class="form-control" id="inputName" placeholder="Name Of Person" required>
			</div>
			<div class="form-group">
				<label for="inputlocation">Location :</label>
				<input type="text" class="form-control" id="inputlocation" placeholder="Last Location Of Person" required>
			</div>
			<div class="form-group">
				<label for="inputspecial_mark">Special Mark :</label>
				<input type="text" class="form-control" id="inputspecial_mark" placeholder="Special Mark Of Person" >
			</div>
			<div class="form-group">
				<label for="inputlast_seen_at">Last Seen At	:</label>
				<input type="time" class="form-control" id="inputlast_seen_at" placeholder="Last Time Seen Of Person" required>
			</div>
			<div class="form-group">
				<label for="inputlost_since">Lost Since	:</label>
				<input type="date" class="form-control" id="inputlost_since" placeholder="Person Lost Since" required>
			</div>
			<div class="form-group ">
				<label for="inputAge">Age :</label>
				<input type="number" class="form-control" id="inputAge" placeholder="Age Of Person" min=1 max=100 required>
			</div>
			<div class="form-group ">
				<label for="inputHeight">Height :</label>
				<input type="number" class="form-control" id="inputHeight" placeholder="height Of Person In CM" min=1 max=250 required>
			</div>
			<div class="form-group ">
				<label for="inputWeight">Weight :</label>
				<input type="number" class="form-control" id="inputWeight" placeholder="Weight Of Person In KG" min=1 max=100 required>
			</div>
			<div class="form-group">
				<label for="gender">select Gender :</label>
				<select class="form-control" id="gender" required>
					<option value="male">Male</option>
					<option value="fmale">Fmale</option>
				</select>
			</div>
			<div class="form-group">
				<label for="last_seen_on">Last Seen On :</label>
				<select class="form-control" id="last_seen_on" required>
					<option value="blue">Saturday</option>
					<option value="black">Sunday</option>
					<option value="browan">Monday</option>
					<option value="green">Tuesday</option>
					<option value="gry">Wednesday</option>
					<option value="blue">Thursday</option>
					<option value="blue">Friday</option>

				</select>
			</div>
			<div class="form-group">
				<label for="eye_color">Select Eye Color :</label>
				<select class="form-control" id="eye_color" required>
					<option value="black">Black</option>
					<option value="browan">Browan</option>
					<option value="green">Green</option>
					<option value="gry">Grey</option>
					<option value="blue">Blue</option>
				</select>
			</div>
			<div class="form-group">
				<label for="hair_color">Select Hair Color :</label>
				<select class="form-control" id="hair_color">
					<option value="black">Black</option>
					<option value="browan">Browan</option>
					<option value="white">White</option>
					<option value="gry">Golden</option>
				</select>
			</div>
			<div class="text-center">
			<button type="submit" class="btn" id="lostButton">Send Report</button>
			</div>

		</form>

	</div>
</section>
@endsection