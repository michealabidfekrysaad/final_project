@extends('layouts.AdminPanel.page')

@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class=" m-b-40">
                    <div class="text-center">
                        {{-- <a class="btn btn-default" href="/category/create/admin">Add New Category</a> --}}
                        <a type="button" href="/category/create/admin" class="btn btn-dark mb-2">
                            <i class="fa fa-lightbulb-o"></i>&nbsp; Add New Category</a>
                    </div>
                    <table id="table" class="table text-center">
                        <thead class="thead-dark">

                                <th scope="col">#</th>
                                <th scope="col">category</th>
                                <th scope="col">attribute</th>
                                <th scope="col">action</th>


                        </thead>
                        <tbody>
                            @foreach($categories as $key=>$category)

                            <tr>
                                <th scope="row">{{ ++$key}}</th>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    @foreach($category->attributes as $attribute)
                                    {{$attribute->attribute_name}} /
                                    @endforeach
                                </td>
                                <td >
                                    <a href="/category/editAdmin/{{$category->id}}" class="btn btn-primary">update</a>
                                    <form class="d-inline" action="/category/deleteAdmin/{{$category->id}}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger">delete</button>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </form>

                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
