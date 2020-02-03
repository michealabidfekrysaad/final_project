@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row mt-2 pt-5 section-header">
        <h2 class="mx-auto">Best Match With Your Photo</h2>
    </div>
    <h2 class="filter_data d-block"></h2>

    <div class="row">

        @foreach($results as $result)
        @foreach($result as $one)
        <div class="col-lg-4 col-md-6">
            <div class="hotel text-center">
                <div class="hotel-img">
                    <a href="/people/details/{{$one->id}}"><img style="width:348px;height:348px" src="https://loseall.s3.us-east-2.amazonaws.com/{{$one->image}}" alt="Img Of Person" class="img-fluid "></a>
                    <h3><a href="/people/details/{{$one->id}}">{{$one->name}}</a></h3>
                    <p>Click On  Image for more details</p>
                </div>
                <a href="/acceptOtherReport/{{$one->id}}" type="button" class="btn btn-success mt-2" data-dismiss="modal">Contact With Report Owner</a>
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
    <div class="row justify-content-center mt-5 pt-3">
        <a href="/RejectOtherReport" type="button" class="btn btn-danger" data-dismiss="modal">Close all And Sumbit Report</a>
    </div>

</div>
@endsection