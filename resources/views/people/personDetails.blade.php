@extends('layouts.app')

@section('content')

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn pt-5">

      <div class="container  pt-5">

        <div class="section-header pt-2">
          <h2>Person Details</h2>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="https://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}" alt="Speaker 1" class="img-fluid">
          </div>
          <div class="col-md-6">
            <div class="details">
              <div class="row">
                      <h3>Name :</h3>
                      <p>{{$report->name}}</p>
              </div>
              <div class="row">
                      <h3>Location :</h3>
                      <p>{{$report->location}}</p>
              </div>
              <div class="row">
                      <h3>Special Mark :</h3>
                      <p>{{$report->special_mark}}</p>
              </div>
              <div class="row">
                      <h3>Last Seen At :</h3>
                      <p> {{$report->last_seen_at}}</p>
              </div>
              <div class="row">
                      <h3>Lost Since :  </h3>
                      <p> {{$report->lost_since}}</p>
              </div>
              <div class="row">
                      <h3>Age :  </h3>
                      <p> {{$report->age}}</p>
              </div>
              <div class="row">
                      <h3>Height :  </h3>
                      <p>{{$report->height}}</p>
              </div>
              <div class="row">
                      <h3>Weight :  </h3>
                      <p>{{$report->weight}}</p>
              </div>
              <div class="row">
                      <h3>{{$report->gender}}</h3>
                      <p>Male </p>
              </div>
              <div class="row">
                      <h3>Last Seen On :  </h3>
                      <p> {{$report->last_seen_on}}</p>
              </div>
              <div class="row">
                      <h3>Eye Color :  </h3>
                      <p>{{$report->eye_color}}</p>
              </div>
              <div class="row">
                      <h3>Hair Color :  </h3>
                      <p> {{$report->hair_color}}</p>
              </div>
              <div class="row ">
                      <a href="/acceptOtherReport/{{$report->id}}" type="submit" class="btn" id="lostButton">Contact With Report Owner</a>
              </div>


            </div>
          </div>

        </div>
      </div>

    </section>

@endsection
