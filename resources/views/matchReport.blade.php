@extends('layouts.app')

@section('content')

<!--==========================
      Speaker Details Section
    ============================-->
<section id="speakers-details" class="wow fadeIn pt-5">
    <div class="container  pt-5">
        <!-- Button to Open the Modal -->
        <button hidden id="modalclick" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        </button>
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog mw-100 w-75">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Best Match</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="hotel text-center">
{{--                                    <a href="{{ url('/people/details') }}">--}}
                                        <div class="hotel-img">
                                            <img src="https://loseall.s3.us-east-2.amazonaws.com/{{$otherReport[0]->image}}" alt="Hotel 1" class="img-fluid">
                                        </div>
                                        <h3>{{$otherReport[0]->name}}</h3>
{{--                                    </a>--}}
                                </div>
                                <div class="modal-footer">
                                    <a href="/acceptOtherReport/{{$otherReport[0]->id}}"  type="button" class="btn btn-success" data-dismiss="modal">Contact With Report Owner</a>
                                    <a href="/RejectOtherReport" type="button" class="btn btn-danger" data-dismiss="modal">Close And Sumbit Report</a>

                                        <h3><a href="{{ url('/people/details') }}">micheal</a></h3>

                                        <p>5 mins ago</p>
                                    </a>
                                    <div class="row">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Contact With Report Owner</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close And Sumbit Report</button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="hotel text-center">
                                    <a href="{{ url('/people/details') }}">
                                        <div class="hotel-img">
                                            <img src="{{asset('img/speakers/1.jpg')}}" alt="Hotel 1" class="img-fluid">
                                        </div>

                                        <h3><a href="{{ url('/people/details') }}">micheal</a></h3>

                                        <p>5 mins ago</p>
                                    </a>
                                    <div class="row">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Contact With Report Owner</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close And Sumbit Report</button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="hotel text-center">
                                    <a href="{{ url('/people/details') }}">
                                        <div class="hotel-img">
                                            <img src="{{asset('img/speakers/1.jpg')}}" alt="Hotel 1" class="img-fluid">
                                        </div>

                                        <h3><a href="{{ url('/people/details') }}">micheal</a></h3>

                                        <p>5 mins ago</p>
                                    </a>
                                    <div class="row">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Contact With Report Owner</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close And Sumbit Report</button>
                                    </div>

                                </div>
                            </div>
                            

                        </div>
                    </div>
                    <!-- Modal footer -->

                </div>
            </div>
        </div>

    </div>
    </div>

</section>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            })
            $( "#modalclick" ).click();

        });
    </script>

@endsection
