@extends('layouts.app')

@section('content')
<html align='right' dir="rtl>">
@if(session()->has('message'))
<div class="alert alert-success" role="alert">
	<strong>Success</strong>{{session()->get('message')}}
</div>
@endif
<div class="pt-5 container-fluid">
	<div class="row mt-2 pt-5 section-header">
		<h2 class="mx-auto">كل المفقودين</h2>
	</div>
	<h2 class="filter_data d-block"></h2>
	<div class="row justify-content-end ">
		<div class="col-lg-9 col-md-12">
			<input type="text" id="search" class="form-control mb-3 " placeholder="searching for lost people by name ">
		</div>
	</div>
	<div class="row w-100 mx-auto ">

		<div class="col-lg-3  d-none d-lg-block">

			<h4 class="text-muted">فلترة</h4>

			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">الفئة: </h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">52</span>
							<input type="checkbox" class="custom-control-input gender" id="Check1" name="male"
								value="male">
							<label class="custom-control-label" for="Check1">ذكر</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">132</span>
							<input type="checkbox" class="custom-control-input gender" id="Check2" name="female"
								value="female">
							<label class="custom-control-label" for="Check2">أنثي</label>
						</div> <!-- form-check.// -->

					</div> <!-- card-body.// -->
				</div>
			</article>



			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">عمر: </h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
{{--							<span class="float-right badge badge-light round">number from database</span>--}}
							<input type="checkbox" class="custom-control-input age" name="below_10_years" id="CheckAge1"
								value="below_10_years">
							<label class="custom-control-label" for="CheckAge1">تحت 10 سنين</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
{{--							<span class="float-right badge badge-light round">number from database</span>--}}
							<input type="checkbox" class="custom-control-input age" name="below_20_years" id="CheckAge2"
								value="below_20_years">
							<label class="custom-control-label" for="CheckAge2">بين 11 و 20 سنة</label>
						</div>

						<div class="custom-control custom-checkbox">
{{--							<span class="float-right badge badge-light round">number from database</span>--}}
							<input type="checkbox" class="custom-control-input age" name="below_30_years" id="CheckAge3"
								value="below_30_years">
							<label class="custom-control-label" for="CheckAge3">بين 21 و 30</label>
						</div>

						<div class="custom-control custom-checkbox">
{{--							<span class="float-right badge badge-light round">number from database</span>--}}
							<input type="checkbox" class="custom-control-input age" name="other_above_30" id="CheckAge4"
								value="other_above_30">
							<label class="custom-control-label" for="CheckAge4">أكبر من 30</label>
						</div>

					</div> <!-- card-body.// -->
				</div>
			</article>


			<article class="card-group-item">
				<header class="card-header">
					<h6 class="title">المدينة</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="form-group">
							<select class="form-control " id="DropDownList1" name="city">
                                <option value=" "></option>
								<option value="Alexandria">الاسكندرية </option>
								<option value="Cairo">القاهرة</option>
								<option value="Portsaid">بور سعيد</option>
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
					<h6 class="title">المنطقة</h6>
				</header>
				<div class="filter-content">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">52</span>
							<input type="checkbox" class="custom-control-input region" id="region1" value="sidibishr">
							<label class="custom-control-label" for="region1">سيدي بشر</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">132</span>
							<input type="checkbox" class="custom-control-input region" id="region2" value="region">
							<label class="custom-control-label" for="region2">سيدي بشر</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">17</span>
							<input type="checkbox" class="custom-control-input region" id="region3" value="region">
							<label class="custom-control-label" for="region3">بور سعيد</label>
						</div> <!-- form-check.// -->

						<div class="custom-control custom-checkbox">
							<span class="float-right badge badge-light round">7</span>
							<input type="checkbox" class="custom-control-input region" id="region4" value="region">
							<label class="custom-control-label" for="region4">منيا</label>
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

			</section>
		</div>
  </article>

 </div>
</div>
</html>

<script>
	$(document).ready(function(){
        filter_data();
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

let d1 = document.getElementById('lost');
d1.innerHTML=" ";
data.forEach(element => {
	d1.insertAdjacentHTML('beforeend', `
	<div class="col-lg-4 col-md-6" >
		<div class="hotel text-center">
		<div class="hotel-img" style="width:348px;height:348px">

		 	<a href="/people/details/${element.id}"><img src="https://loseall.s3.us-east-2.amazonaws.com/${element.image}" alt="Img Of Person" class="img-fluid"></a>
		</div>
			<h3>${element.name}</h3>
			<p>Age is :${element.age}</p>
			<span>${element.gender}</span>
        	<p>Click On  Image for more details</p>
	</div>
	</div>

	`)

});

}
$(document).on('keyup' , '#search' , function(){
	var query = $(this).val();
    //filter_data()
	fetch_Data(query);
});
        function filter_data() {
            var gender = get_filter('gender');
            var age = get_filter('age');
            if($("#DropDownList1 :selected").text()!=" "){
                var city = $("#DropDownList1 :selected").text();
            }
            var data = {gender,city,age};
            console.log(data);
            if((data.gender).length!=0||(data.city).length!=0||(data.age).length!=0) {
                $.ajax({

                        method: "GET",
                        url: "/filter/" + JSON.stringify(data),
                        traditional: true,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        //data: JSON.stringify(data),
                        success: function (data) {
                            console.log(data);
                            insertToHtml(data);
                        }
                    }
                );
            }
            else{
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
        })
});
</script>

@endsection
