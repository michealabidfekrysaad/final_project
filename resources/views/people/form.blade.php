@extends('layouts.app')

@section('content')
{{-- @php dd($type);@endphp --}}

<!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg  py-5">

        <div class="container py-5">
    
            <div class="section-header pt-5">
                <h2>Report For Lost Person</h2>
            </div>
    
            <form >
                @if($type == 'lookfor') 

                <div class="form-group">
                <label for="Select_file">Upload Image :</label>
                <input type="file" class="form-control" name="select_file" required/>
                </div>

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
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="fmale">Fmale</option>
                    </select>
                </div>
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
                    <label for="eye_color">Select Eye Color :</label>
                    <select class="form-control" id="eye_color" name="eye_color" required>
                        <option value="black">Black</option>
                        <option value="browan">Browan</option>
                        <option value="green">Green</option>
                        <option value="gry">Grey</option>
                        <option value="blue">Blue</option>
                    </select>
                </div>

                @endif

                
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
                <button type="submit" class="btn" id="lostButton">Send Report</button>
                </div>
                
            </form>
    
        </div>
    </section>

    @endsection