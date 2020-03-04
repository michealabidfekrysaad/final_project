@extends('layouts.AdminPanel.page')

@section('content')

    @foreach($category as $c)
        <h3>{{$c->category_name}}</h3>
        @foreach($c->attributes as $dd)
            <h3>{{$dd->attribute_name}}</h3>
        @endforeach
    @endforeach


@endsection
