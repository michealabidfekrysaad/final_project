@extends('layouts.AdminPanel.page')

@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class=" m-b-40">
                    <div class="text-center">
                        <a type="button" href="/report/create" class="btn btn-dark mb-2">
                            <i class="fa fa-pencil-square-o"></i>
                            Add New Report</a>
                    </div>
                    
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Location</th>
                                <th>Last_Seen_On</th>
                                <th>Last_Seen_At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach($reports as $report)
                        
                            <tr>
                                <td>
                                    <img style="width:100px;height:80px;" src="http://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}"/>
                                </td>
                                <td>{{$report->name}}</td>
                                <td>{{$report->age}}</td>
                                <td>{{$report->location}}</td>
                                <td>{{$report->last_seen_on}}</td>
                                <td>{{$report->last_seen_at}}</td>
                                <td class="text-center" style="width:410px">
                                    <a href="/reportShow/{{$report->id}}" class="btn btn-info m-1"><i class="fa fa-eye"></i> show</a>
                                    <a href="/report/edit/{{$report->id}}" class="btn btn-primary m-1"><i class="fa fa-pencil-square-o"></i>
                                         update</a>
                                    <form class="d-inline" action="/reportDelete/{{$report->id}}" method="POST">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                        value = "Delete"class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
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