@extends('layouts.AdminPanel.page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="w-75 text-center mx-auto  mt-5">
                    <a href="{{route('category.create')}}" class="btn btn-success mb-2">add new category</a>
                </div>
                <div class="col-lg-12">
                    <table id="table  class=" table text-center
                    ">
                    <thead class="thead-dark">

                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>

                    </thead>
                    <tbody>
                    @if($categories->count())
                        @foreach ($categories as $key => $category)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    <form class="d-inline" action="/category/{{$category->id}}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger">delete
                                        </button>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection
