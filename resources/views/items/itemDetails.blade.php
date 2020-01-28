@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<section id="speakers-details" class="wow fadeIn pt-5">

    <div class="container  pt-5">
        <div class="section-header pt-2">
            <h2>Item Details</h2>
        </div>

        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('img/speakers/1.jpg')}}" alt="Speaker 1" class="img-fluid">
            </div>

            <div class="col-md-6">
                <div class="details">
                    <div class="row">
                        <h3>Category :</h3>
                        <p> Bag</p>
                    </div>
                    <div class="row">
                        <h3>Color :</h3>
                        <p> Red</p>
                    </div>
                    <div class="row">
                        <h3>Found Since :</h3>
                        <p> 22/12/2019</p>
                    </div>
                    <div class="row">
                        <h3>City Where Found :</h3>
                        <p> Alexandria</p>
                    </div>


                    <div class="row ">
                        <form action="" class="form">
                            <div class="form-group">
                                <h3 for="exampleFormControlTextarea1">Description :</h3>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write Description To Founder To Know Your Are They Real Owner Of Item"></textarea>
                            </div>
                            <button type="submit" class="btn" id="lostButton">Contact With Report Owner</button>
                        </form>
                    </div>


                </div>
            </div>

        </div>
    </div>

</section>

@endsection