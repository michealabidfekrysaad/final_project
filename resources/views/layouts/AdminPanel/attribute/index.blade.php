@extends('layouts.AdminPanel.page')

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                        <div class="text-center">
                            <a type="button" href="/addvalueadmin" class="btn btn-dark mb-2">
                                <i class="fa fa-lightbulb-o"></i>&nbsp; Add New Attribute
                            </a>
                        </div>
                        <table id="table" class="table text-center">
                            <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col">attribute</th>
                            <th scope="col">values</th>
                            <th scope="col">action</th>

                            </thead>
                            <tbody>
                            @foreach($attrributeValues as $key=>$attrributeValue)

                                <tr>
                                    <th scope="row">{{ ++$key}}</th>
                                    <td>{{$attrributeValue->attribute_name}}</td>
                                    <td>
                                        @foreach($attrributeValue->valuesofattributes as $value)
                                            {{$value->value_name}} /
                                        @endforeach
                                    </td>
                                    <td>
                                        {{--                                        <a href="/category/editAdmin/{{$category->id}}" class="btn btn-primary">update</a>--}}
                                        <form class="d-inline" action="/deleteAttribute/{{$attrributeValue->id}}"
                                              method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="btn btn-danger">Delete
                                            </button>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        </form>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        {{$attrributeValues->links()}}

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
