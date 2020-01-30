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
                      <p>{{$repor->name}}</p>
              </div>
              <div class="row">
                      <h3>Location :</h3>
                      <p>{{$repor->location}}</p>
              </div>
              <div class="row">
                      <h3>Special Mark :</h3>
                      <p>{{$repor->special_mark}}</p>
              </div>
              <div class="row">
                      <h3>Last Seen At :</h3>
                      <p>{{$repor->last_seen_at}}</p>
              </div>
              <div class="row">
                      <h3>Lost Since :  </h3>
                      <p>{{$repor->lost_since}}</p>
              </div>
              <div class="row">
                      <h3>Age :  </h3>
                      <p>{{$repor->age}}</p>
              </div>
              <div class="row">
                      <h3>Height :  </h3>
                      <p>{{$repor->height}} cm</p>
              </div>
              <div class="row">
                      <h3>Weight :  </h3>
                      <p>{{$repor->weight}} kg</p>
              </div>
              <div class="row">
                      <h3>Gender :  </h3>
                      <p>{{$repor->gender}}</p>
              </div>
              <div class="row">
                      <h3>Last Seen On :  </h3>
                      <p> {{$repor->last_seen_on}}</p>
              </div>
              <div class="row">
                      <h3>Eye Color :  </h3>
                      <p>{{$repor->eye_color}}</p>
              </div>
              <div class="row">
                      <h3>Hair Color :  </h3>
                      <p>{{$repor->hair_color}}</p>
                </div>
                <div class="row ">
                 <button type="submit" class="btn" id="lostButton">Contact With Report Owner</button>
              </div>
                <!-- <form action="/sendEmail/{{$repor->id}}" method="POST">
                @csrf
                <div class="row">
                      <h3>Description:</h3>
                      <textarea name="description" cols="10" rows="5"></textarea>
                </div>
                <br>
                
                </form> -->
              </div>
              
              
              
            </div>
          </div>
          
        </div>
      </div>

    </section>

@endsection