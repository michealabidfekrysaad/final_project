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
            <img src="{{asset('img/speakers/1.jpg')}}" alt="Speaker 1" class="img-fluid">
          </div>

          <div class="col-md-6">
            <div class="details">
              <div class="row">
                      <h3>Name :</h3>
                      <p> Ahmed</p>
              </div>
              <div class="row">
                      <h3>Location :</h3>
                      <p> car</p>
              </div>
              <div class="row">
                      <h3>Special Mark :</h3>
                      <p> dark birthmark on face</p>
              </div>
              <div class="row">
                      <h3>Last Seen At :</h3>
                      <p> 10:00 pm</p>
              </div>
              <div class="row">
                      <h3>Lost Since :  </h3>
                      <p> 01/05/2019</p>
              </div>
              <div class="row">
                      <h3>Age :  </h3>
                      <p> 12</p>
              </div>
              <div class="row">
                      <h3>Height :  </h3>
                      <p>170 cm</p>
              </div>
              <div class="row">
                      <h3>Weight :  </h3>
                      <p>50 kg</p>
              </div>
              <div class="row">
                      <h3>Gender :  </h3>
                      <p>Male </p>
              </div>
              <div class="row">
                      <h3>Last Seen On :  </h3>
                      <p> Saturday</p>
              </div>
              <div class="row">
                      <h3>Eye Color :  </h3>
                      <p>Black</p>
              </div>
              <div class="row">
                      <h3>Hair Color :  </h3>
                      <p> Black</p>
              </div>
              <div class="row ">
                      <button type="submit" class="btn" id="lostButton">Contact With Report Owner</button>
              </div>
              
              
            </div>
          </div>
          
        </div>
      </div>

    </section>

@endsection