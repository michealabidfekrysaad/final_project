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
                    console.log("inside")
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
                <label for="Select_file">Upload Image :</label>
                <input type="file" class="form-control" name="select_file" id="fileUpload" onchange="Filevalidation()"
                    accept=".jpg,.jpeg,.png" required />
                <span id="ImgError"></span>
            </div>

            <div class="form-group">
                <label for="inputName">Name Of Item :</label>
                <input type="text" class="form-control" id="inputName" placeholder="Name Of Item" required>
                <span id="NameErr"></span>
            </div>


            <div class="form-group">
                <label for="city">City:</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="alexandria">alexandria</option>
                    <option value="cairo">cairo</option>
                    <option value="fayoum">fayoum</option>
                    <option value="ismailia">ismailia</option>
                    <option value="matrouh">matrouh</option>

                </select>
            </div>

            <div class="form-group">
                <label for="region">region:</label>
                <select class="form-control" id="region" name="city" required>
                    <option value="0">- Select -</option>
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
    // the ajax request of the city ro response the region
$(document).ready(function(){

$("#city").change(function(){
    var cityvalue = $(this).val();
    console.log(cityvalue);

    $.ajax({
        url:'/ajaxRequest',
        type: 'POST',
        data: {cityvalue:cityvalue},
        dataType: 'json',
        success:function(response){
            alert(response);

            var len = response.length;

            $("#sregion").empty();
            for( var i = 0; i<len; i++){
                var id = response[i]['id'];
                var name = response[i]['name'];
                
                $("#region").append("<option value='"+id+"'>"+name+"</option>");

            }
        }
    });
});

});
</script>


@endsection


