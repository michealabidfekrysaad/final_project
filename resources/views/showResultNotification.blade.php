@extends('layouts.app')

@section('content')
<div>
    <div class="hotel text-center">
        @foreach($results as $result)
            @foreach($result as $one)
                <div class="hotel-img">
                    <a href="/people/details/15"><img src="https://loseall.s3.us-east-2.amazonaws.com/{{$one->image}}" alt="Img Of Person" class="img-fluid w-25 m-5"></a>
                </div>
                <a href="/acceptOtherReport/{{$one->id}}"  type="button" class="btn btn-success" data-dismiss="modal">Contact With Report Owner</a>
                @endforeach
            @endforeach
            <a href="/RejectOtherReport" type="button" class="btn btn-danger" data-dismiss="modal">Close all And Sumbit Report</a>
    </div>
</div>
@endsection
