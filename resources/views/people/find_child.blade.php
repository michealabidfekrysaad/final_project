@foreach ($reports as $report)
    <div class="col-lg-4 col-md-6">
        <div class="hotel text-center">
            <div class="hotel-img">

                <a href="/people/details/{{$report->id}}"><img style="width:348px;height:348px"
                                                               src="https://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}"
                                                               alt="Img Of Person" class="img-fluid"></a>
            </div>
            <h3>{{$report->name}}</h3>
            <p>Age is :{{$report->age}}</p>
            <span>{{$report->gender}}</span>
            <p>Click On Image for more details</p>
        </div>
    </div>
@endforeach
<div id="links">
    {{$reports->links()}}
</div>
