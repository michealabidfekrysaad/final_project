@extends('layouts.AdminPanel.page')

@section('content')
    <style>
        span {
            color: red;
        }
    </style>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="d-flex bd-highlight mb-3">
                <a class="ml-auto p-2 bd-highlight text-dark" href="/admin/panel/report">
                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card ">
                <div class="card-header">
                    Report Info
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3" style="height:250px">
                            <img style="height:250px"
                                 src="http://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}"/>
                        </div>
                        <div class="col-md-9 p-4">
                            <h4><span>{{$report->name}}</span> is <span>{{$report->age}}</span> years old, was lost at
                                <span>{{$report->location}}</span>
                                .
                            </h4><br>
                            <h4> style:- <span>{{$report->hair_color}}</span> hair and
                                <span>{{$report->eye_color}}</span> eye .
                            </h4><br>
                            <h4>
                                special mark:- <span>{{$report->special_mark}}</span>
                            </h4><br>
                            <h4>
                                height is <span>{{$report->height}}</span>, weight is <span>{{$report->weight}}</span>
                            </h4><br>

                            @if (($report->found_since) != "")
                                <h4>
                                    {{$report->name}} was found at <span>{{$report->found_since}}</span>
                                </h4><br>
                            @endif


                            {{-- <h4>
                              if you know any information:- <span>hena 3ayez akteb el madena !!</span>
                              </h4><br> --}}


                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <P>this report was created at <span>{{$report->created_at}}</span></p>
                </div>
            </div>
        </div>
    </div>

@endsection
