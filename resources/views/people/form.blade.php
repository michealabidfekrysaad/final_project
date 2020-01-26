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

// above validation on person name and below is location validation
            let inputlocation=document.getElementById("inputlocation");
            let LocationErr=document.getElementById("LocationErr");
            if (inputlocation.value == "")                                  
                { 
                    inputlocation.focus();
                    LocationErr.classList.add("text-danger");
                    LocationErr.innerHTML = "location is required";
                    return false; 
                } 
                if(re.test(inputlocation.value) == false){
                    inputlocation.focus(); 
                    LocationErr.classList.add("text-danger");
                    LocationErr.innerHTML = "location can not contain numbers";
                    return false; 
                }
                else{
                    LocationErr.innerHTML = "";

                }

                // validation for special mark
                let inputspecial_mark=document.getElementById("inputspecial_mark");
                let SpecialErr=document.getElementById("SpecialErr");
                if (inputspecial_mark.value == "")                                  
                { 
                    inputspecial_mark.focus();
                    SpecialErr.classList.add("text-danger");
                    SpecialErr.innerHTML = "special mark is required";
                    return false; 
                } 
                if(re.test(inputspecial_mark.value) == false){
                    inputspecial_mark.focus(); 
                    SpecialErr.classList.add("text-danger");
                    SpecialErr.innerHTML = "special mark can not contain numbers";
                    return false; 
                }
                else{
                    SpecialErr.innerHTML = "";

                }
                // validation on date input
                // var date_regex = /^\d{2}\/\d{2}\/\d{4}$/ ;
                // var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;

                // let inputlost_since=document.getElementById("inputlost_since");
                // let LostErr=document.getElementById("LostErr");
                // if (inputlost_since.value == "")                                  
                // { 
                //     inputlost_since.focus();
                //     LostErr.classList.add("text-danger");
                //     LostErr.innerHTML = "Date  is required";
                //     return false; 
                // } 
                // if(date_regex.test(inputlost_since.value) == false){
                //     inputlost_since.focus(); 
                //     LostErr.classList.add("text-danger");
                //     LostErr.innerHTML = "the Date fromat is not correct";
                //     return false; 
                // }
                // else{
                //     LostErr.classList.remove('text-danger')
                //     LostErr.classList.add("text-success");
                //     LostErr.innerHTML = "Date is accepted";

                // }

                let NumberErr=document.getElementById("NumberErr");
                let inputAge= document.getElementById("inputAge");
                    if (inputAge.value < 0 || inputAge.value > 200 || inputAge.value == "" ||inputAge.value == "e") {
                        inputAge.focus();
                        NumberErr.classList.add("text-danger");
                        NumberErr.innerHTML = "Age is required";
                    return false; 
                    }
                    else{
                    NumberErr.innerHTML = "";

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
                @if($type == 'lookfor')  
                <h2>Report For Lost Person</h2>
                @endif
                @if($type == 'found')  
                <h2>Report For found Person</h2>
                @endif

                
            </div>
    
            
            <form onsubmit = "return(validate());" >

                
                  <div class="form-group">
                <label for="Select_file">Upload Image :</label>
                <input type="file" class="form-control" name="select_file" id="fileUpload" 
                 onchange="Filevalidation()" accept=".jpg,.jpeg,.png" required/>
                <span id="ImgError"></span>
                </div>
               
               <div class="form-group">
                    <label for="inputName">Name Of Person :</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Name Of Person" required>
                    <span id="NameErr"></span>
                </div> 

                <div class="form-group">
                    <label for="inputlocation">Location :</label>
                    <input type="text" class="form-control" id="inputlocation" placeholder="Last Location Of Person" required>
                    <span id="LocationErr"></span>
                </div>


               <div class="form-group">
                    <label for="inputspecial_mark">Special Mark :</label>
                    <input type="text" class="form-control" id="inputspecial_mark" placeholder="Special Mark Of Person" required>
                    <span id="SpecialErr"></span>
                </div>

                @if($type == 'lookfor') 
                <div class="form-group">
                    <label for="inputlost_since">Lost Since	:</label>
                    <input type="date" class="form-control" id="inputlost_since" placeholder="Person Lost Since" required>
                    <span id="LostErr"></span>
                </div>

                @endif
                
                <div class="form-group ">
                    <label for="inputAge">Age :</label>
                    <input type="number" class="form-control" id="inputAge" placeholder="Age Of Person" min=1 max=100 required>
                    <span id="NumberErr"></span>
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
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="fmale">Fmale</option>
                    </select>
                </div>

                @if($type == 'lookfor') 
                <div class="form-group">
                    <label for="last_seen_on">Last Seen On :</label>
                    <select class="form-control" id="last_seen_on" name="last_seen_on" required>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
    
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputlast_seen_at">Last Seen At	:</label>
                    <input type="time" class="form-control" id="inputlast_seen_at" placeholder="Last Time Seen Of Person" required>
                </div>

                @endif

                @if($type == 'found') 
                <div class="form-group">
                    <label for="inputfound_since">found Since	:</label>
                    <input type="date" class="form-control" id="inputfound_since" placeholder="Person found when" required>
                </div>

                @endif

                <div class="form-group">
                    <label for="eye_color">Select Eye Color :</label>
                    <select class="form-control" id="eye_color" name="eye_color" required>
                        <option value="black">Black</option>
                        <option value="browan">Browan</option>
                        <option value="green">Green</option>
                        <option value="gry">Grey</option>
                        <option value="blue">Blue</option>
                    </select>
                </div>

        

                
                <div class="form-group">
                    <label for="hair_color">Select Hair Color :</label>
                    <select class="form-control" id="hair_color" name="hair_color">
                        <option value="black">Black</option>
                        <option value="browan">Browan</option>
                        <option value="white">White</option>
                        <option value="gry">Golden</option>
                    </select>
                </div>
                <div class="text-center">
                <button type="submit" class="btn" id="lostButton" >Send Report</button>
                </div>
                
            </form>
    
        </div>
    </section>

    @endsection


    {{-- <script type="text/javascript">
        function ValidateExtension() {
            var allowedFiles = [".jpg", ".jpeg", ".png"];
            var fileUpload = document.getElementById("fileUpload");
            var ImgError = document.getElementById("ImgError");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.value.toLowerCase())) {
                ImgError.classList.add("text-danger");
                ImgError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
                return false;
            }
            ImgError.classList.add("text-success");
            ImgError.innerHTML = "Upload Image Successfully";
            return true;
        }
    </script> --}}