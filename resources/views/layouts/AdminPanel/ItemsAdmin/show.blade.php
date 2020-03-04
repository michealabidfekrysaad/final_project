@extends('layouts.AdminPanel.page')

@section('content')
    <style>
        span {
            color: red;
        }
    </style>


    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header">
                    Items Info
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3" style="height:250px">
                            <img style="height:250px" src="http://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}"/>
                        </div>
                        <div class="col-md-9 p-4">
                            <h4>this item form category <span>{{($item->category)->category_name}}</span>
                                and was found by <span>{{$item->user->name}} </span></h4><br>
                            <h4>it was found in <span>{{$item->city->city_name}}</span></h4><br>
                            <h4>
                                @foreach($itemAtributeValue as $one)
                                    its attribute is: <span>{{($one->attribute)->attribute_name}}</span>
                                    and has value: <span>{{($one->value)->value_name}}</span><br>
                                @endforeach
                            </h4>


                            {{-- <a href="#" class="btn btn-primary ">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    this item found by <span>{{$item->user->name}} </span> since <span>
                    {{$item->found_since}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
