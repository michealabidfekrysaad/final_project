@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row mt-2 pt-5 section-header">
        <h2 class="mx-auto">{{ __('messages.Best Match With Your Photo') }}</h2>
    </div>
    <h2 class="filter_data d-block"></h2>

    <div class="row">
        @if(count($results) == 0)
            <div class="col-lg-4 col-md-6">
                <div class="hotel text-center">
                    <div class="hotel-img text-center">
                        <h1>{{ __('messages.Sorry No found Data') }}</h1>
                    </div>
            @else
            @foreach($results as $result)
                @foreach($result as $one)
                    <div class="col-lg-4 col-md-6">
                        <div class="hotel text-center">
                            <div class="hotel-img">
                                <a href="/people/details/{{$one->id}}"><img src="https://loseall.s3.us-east-2.amazonaws.com/{{$one->image}}" alt="Img Of Person" class="img-fluid "></a>
                            </div>
                            <a href="/acceptOtherReport/{{$one->id}}" type="button" class="btn btn-success mt-2" data-dismiss="modal">{{ __('messages.Contact With Report Owner') }}</a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
                @if(count($results) != 0)
    <div class="row justify-content-center mt-5 pt-3">
        <a href="/RejectOtherReport" type="button" class="btn btn-danger" data-dismiss="modal">{{ __('messages.Close all And Sumbit Report') }}</a>
    </div>
                    @endif
</div>
@endsection
