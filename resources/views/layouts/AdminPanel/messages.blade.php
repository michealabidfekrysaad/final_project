@extends('layouts.AdminPanel.page')

@section('content')
    <style>
        table {
            table-layout: fixed;
            white-space: normal!important;
        }

        td {
            word-wrap: break-word;
        }
    </style>

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                        <table class="table text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">email</th>
                                <th scope="col">subject</th>
                                <th scope="col">message</th>
                                <th scope="col">action</th>



                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $key=>$contact)
                                <tr>
                                    <td scope="row">{{$contact->id}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->subject}}</td>
                                    <td >{{$contact->message}}</td>
                                    <td >

                                        <form class="d-inline" action="/contact/delete/{{$contact->id}}" method="get">
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
                        {{ $contacts->links() }}


                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
