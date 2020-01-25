<html>
<head>
<title>Seacrh</title>
<link href="{{asset('js/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

</head>
<body>
    <form action="/searchReports" method="POST">
    @csrf
    <input type="text" name="search" />
    <input type="submit" name="submit"/>
    </form>
    
    <div>
    @if(isset($_POST['submit']))
    @foreach($FilterSearch as $search)
       <h3>{{$search->name}}</h3>
       <h3>{{$search->age}}</h3>
       <h3>{{$search->gender}}</h3>
       <h3>{{$search->image}}</h3>
       <h3>{{$search->type}}</h3>
       <h3>{{$search->special_mark}}</h3>
       <h3>{{$search->city}}</h3>
       @endforeach
       @endif
    </div>

    <form action="/searchCheckbox" method="POST">
    @csrf
        <input type="checkbox" name="locationfilter1">male</label>
        <input type="checkbox" name="locationfilter2">Female</label>
        <input type="submit" name="submit2"/>
    </form>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <input type="text" id="search" name="searchAjax" placeholder="Enter Text To Search" class="form-control"/>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-12">

                    <div id="datas">
                       
                    </div>
                    
            </div>
        </div>
    </div>



    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/easing/easing.min.js') }}"></script>
    <script src="{{ asset('js/superfish/hoverIntent.js') }}"></script>
    <script src="{{ asset('js/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('js/wow/wow.min.js') }}"></script>
    <script src="{{ asset('js/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('js/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function(){

//fetch_Data();

function fetch_Data(query = ''){
	$.ajax({
		url:"{{route('search.action')}}",
		method:'GET',
		data:{query:query},
		dataType:'json',
		success:function(data)
		{
			$('#datas').html(data.div_data);
		}
	});
}
$(document).on('keyup' , '#search' , function(){
	var query = $(this).val();
	fetch_Data(query);
});
});
    </script>
</body>
</html>