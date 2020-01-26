@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<section id="speakers-details" class="wow fadeIn pt-5">
    <div class="container  pt-5">
        <div class="card pt-2">
            <div class="card-header">
                Your Profile
            </div>
            <ul class="nav nav-tabs pt-3" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Your Reports</a>
                </li>
            </ul>
            <div class="card-body">
            <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Kshiti123</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Kshiti Ghelani</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>kshitighelani@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>123 456 7890</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Web Developer and Designer</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="hotel text-center">
								<a href="{{ url('/people/details') }}">
									<div class="hotel-img">
										<img src="{{asset('img/speakers/1.jpg')}}" alt="Hotel 1" class="img-fluid">
									</div>

									<h3><a href="{{ url('/people/details') }}">ahmed</a></h3>

									<p>5 mins ago</p>
								</a>
							</div>
                            </div>
                        </div>
            </div>
        </div>
    </div>

</section>

@endsection