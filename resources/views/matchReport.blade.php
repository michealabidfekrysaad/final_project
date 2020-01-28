@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<section id="speakers-details" class="wow fadeIn pt-5">
    <div class="container  pt-5">
        <h2>Fading Modal</h2>
        <p>Add the "fade" class to the modal container if you want the modal to fade in on open and fade out on close.</p>

        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Open modal
        </button>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Best Match</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-12 col-md-6">
                                <div class="hotel text-center">
                                    <a href="{{ url('/people/details') }}">
                                        <div class="hotel-img">
                                            <img src="{{asset('img/speakers/1.jpg')}}" alt="Hotel 1" class="img-fluid">
                                        </div>

                                        <h3><a href="{{ url('/people/details') }}">micheal</a></h3>

                                        <p>5 mins ago</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Contact With Report Owner</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close And Sumbit Report</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>

</section>

@endsection