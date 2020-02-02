@extends('layouts.AdminPanel.page')

@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- DATA TABLE-->
                <div class=" m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>date</th>
                                <th>type</th>
                                <th>description</th>
                                <th>status</th>
                                <th class="text-center">price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2018-09-29 05:57</td>
                                <td>Mobile</td>
                                <td>iPhone X 64Gb Grey</td>
                                <td class="process">Processed</td>
                                <td class="text-center">
                                    <a href="/report/id" class="btn btn-info m-1">show</a><br>
                                    <a href="/report/edit/id" class="btn btn-primary m-1">update</a><br>
                                    <form class="d-inline" action="" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger">delete</button>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </form>

                                 </td>
                            </tr>

                            

                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->

                
            </div>
        </div>
    </div>
</div>
@endsection