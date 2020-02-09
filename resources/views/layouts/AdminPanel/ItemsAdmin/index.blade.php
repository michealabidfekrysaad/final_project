@extends('layouts.AdminPanel.page')

@section('content')
<style>
</style>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-b-40">
                    <div class="text-center">
                        <a type="button" href="/item/create" class="btn btn-dark mb-2">
                            <i class="fa fa-pencil-square-o"></i>
                            Add New Item</a>
                    </div>
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>Found_Since</th>
                                <th>Loster</th>
                                <th>Category</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)

                            <tr>
                                <td>
                                    <img style="width:100px;height:80px;"
                                        src="http://loseall.s3.us-east-2.amazonaws.com/{{$item->image}}" />
                                </td>
                                <td>{{$item->city->city_name}}</td>
                                <td>{{$item->area->area_name}}</td>
                                <td>{{$item->found_since}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->category->category_name}}</td>
                                <td class="text-center" style="width:350px">
                                    <a href="/item/show/{{$item->id}}" class="btn btn-info m-1">show</a>
                                    <a href="/item/edit/{{$item->id}}" class="btn btn-primary m-1">update</a>
                                    <form class="d-inline" action="/item/delete/{{$item->id}}" method="POST">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <input type="submit" onclick="return confirm('Are you sure?')" value="Delete"
                                            class="btn btn-danger">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                        <div class="text-center">
                            <li>{{ $items->links() }}</li>
                        </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection