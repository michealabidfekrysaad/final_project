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

    
        <input type="checkbox" name="checkbox" value="male" id="male">male</label>
        <input type="checkbox" name="checkbox" value="female" id="female">Female</label>
        <input type="checkbox" name="checkbox" value="city" id="city">city</label>
        <input type="checkbox" name="checkbox" value="age" id="age">10</label>



    <h5>***********************************</h5>
    
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
    var obj = [];
    var gendeo=[];
    var male = $('#male').val();
    var female = $('#female').val();
    var city = $('#city').val();
    var age = $('#age').val();

    $("input:checkbox[name=checkbox]:checked").each(function() { 
                console.log('fahmy') 
    });
    
    // $('input[type="checkbox"]').click(function(){
    //         if($(this).prop("checked") == true){

    //             obj.push({
    //                 gender:$(this).val(),
    //                 gender:$(this).val(),
    //                 city:$(this).val(),
    //                 age:$(this).val()
    //             });
    //         }
    //         console.log(obj);
    //     });
        
    // $.each($("input[type='checkbox']:checked"), function(){
    //     obj.push($(this).val());
    //  });
    //  console.log(obj);

   });

    



// $(document).ready(function(){

    
// function fetch_Data(query = ''){
    // //fetch_Data();
// 	$.ajax({
// 		url:"{{route('search.action')}}",
// 		method:'GET',
// 		data:{query:query},
// 		dataType:'json',
// 		success:function(data)
// 		{
// 			$('#datas').html(data.div_data);
// 		}
// 	});
// }
// $(document).on('keyup' , '#search' , function(){
// 	var query = $(this).val();
// 	fetch_Data(query);
// });
// });
    </script>
</body>
</html>