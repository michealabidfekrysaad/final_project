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
                <img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}" alt="Img Of Person" class="img-fluid">
            </div>

            <div class="col-md-6">
                <div class="details">
                    <div class="row">
                        <h3>Category :</h3>
                            <p> {{($item->category)->category_name}}</p>
                    </div>
                    <div class="row">
                        <h3>Color :</h3>
                        <p> Red</p>
                    </div>
                    <div class="row">
                        <h3>Found Since :</h3>
                        <p> {{$item->found_since}}</p>
                    </div>
                    <div class="row">
                        <h3>City Where Found :</h3>
                        <p> {{($item->city)->city_name}}</p>
                    </div>
                    
                        @foreach($data as $one)
                        <div class="row">
                            <h3> {{($one->attribute)->attribute_name}} :</h3>
                            <p> {{($one->value)->value_name}} </p>
                            </div>
                            @endforeach
                    
                    <div class="row ">
                        <form action="/sendEmailItem/{{$item->id}}" method="POST" class="form">
                           @csrf
                        <div class="form-group">
                                <h3 for="exampleFormControlTextarea1">Description :</h3>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Write Description To Founder To Know Your Are They Real Owner Of Item"></textarea>
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
