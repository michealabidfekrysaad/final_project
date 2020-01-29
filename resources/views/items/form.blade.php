<script>
    function validate(ev) {
        var allowedFiles = [".jpg", ".jpeg", ".png"];
            let fileUpload = document.getElementById("fileUpload");
            let ImgError = document.getElementById("ImgError");
            let regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.value.toLowerCase())) {
                ImgError.classList.add("text-danger");
                ImgError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                return false;
            }
            
            
            ImgError.classList.add("text-success");
            ImgError.innerHTML = "Upload Image Successfully";
            Filevalidation();

// above is image validation and below is name validation

            let Name =document.getElementById("inputName");
            let NameErr=document.getElementById("NameErr");
            var re = /^[a-zA-Z ]*$/;
            if (Name.value == "")                                  
                { 
                    Name.focus();
                    NameErr.classList.add("text-danger");
                    NameErr.innerHTML = "name is required";
                    return false; 
                } 
                if(re.test(Name.value) == false){
                    Name.focus(); 
                    NameErr.classList.add("text-danger");
                    NameErr.innerHTML = "name can not contain numbers";
                    return false; 
                }
                else{
                    NameErr.innerHTML = "";

                }

               
            return( true );
    }





     Filevalidation = () => { 
        
        if (fileUpload.files.length > 0) { 
            for (const i = 0; i <= fileUpload.files.length - 1; i++) { 
  
                const fsize = fileUpload.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 4096) { 
                    ImgError.classList.add("text-danger");
                    ImgError.innerHTML = "size of image is" + file +"MB is very large";
                    break;
                } 
                var allowedFiles = [".jpg", ".jpeg", ".png"];
                let regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
                if (!regex.test(fileUpload.value.toLowerCase())) {
                ImgError.classList.add("text-danger");
                ImgError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                break;
                }
                else { 
                    ImgError.classList.remove('text-danger')
                    ImgError.classList.add("text-success");
                    ImgError.innerHTML = "Upload Image Successfully, size is "+file + "MB";
                    break;

                } 
            } 
        } 
    } 





</script>



@extends('layouts.app')

@section('content')

<section id="contact" class="section-bg  py-5">

    <div class="container py-5">

        <div class="section-header pt-5">
            <h2>Report For Lost Item</h2>
        </div>


        <form onsubmit="return(validate());">


            <div class="form-group">
                <label for="image">Upload Image :</label>
                <input type="file" class="form-control" name="image" id="fileUpload" onchange="Filevalidation()"
                    accept=".jpg,.jpeg,.png" required />
                <span id="ImgError"></span>
            </div>

            <div class="form-group">
                <label for="category_id">item name:</label>
                <select class="form-control" id="item" name="category_id" required>
                    <option value="none" selected disabled hidden>
                        Select an Option
                    </option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}"> {{$category->category_name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group" id="attribute">

            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="none" selected disabled hidden>
                        Select an Option
                    </option>
                    @foreach($cities as $key => $city)
                    <option value="{{$key}}"> {{$city}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="title">select region:</label>
                <select name="state" id="state" class="form-control">

                </select>
            </div>


            <div class="form-group">
                <label for="inputfound_since">found Since :</label>
                <input type="date" class="form-control" id="inputfound_since" placeholder="Item found when" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn" id="lostButton">Send Report</button>
            </div>

        </form>

    </div>
</section>


<script>
    $('#city').change(function(){
    var cityID = $(this).val();
    console.log(cityID);
    if(cityID){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?city_id="+cityID,
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

   $('#item').change(function(){
    var category_id = $(this).val();
    if(category_id){
        $.ajax({
           type:"GET",
           url:"/get/"+category_id,
           success:function(category){   
            if(category){
                $("#attribute").empty();
                $.each(category[0].attributes,function(key,value){
                    let itemAttributes=category[0].attributes;
                $("#attribute").append( `<label>`+itemAttributes[key].attribute_name+`</label>
                                         <select class="form-control" name="`+itemAttributes[key].attribute_name+`" id = "`+itemAttributes[key].id+`">
                                         </select>`);


                    $.ajax({
                    type:"GET",
                    url:"/valueofattribute/"+itemAttributes[key].id,
                    success:function(result){
                        if(result){
                            $.each(result,function(key,value){
                                $(`#`+result[key].attribute_id+``).append(`<option value = "`+result[key].id+`">`+result[key].value_name+`</option>`);
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
        $("#item").empty();
    }      
   });




</script>


@endsection