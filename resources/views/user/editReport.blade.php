@extends('layouts.app')

@section('content')

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg  py-5">

        <div class="container py-5">

            <div class="section-header pt-5">
                <h2>{{ __('messages.Edit Report') }}</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/updateReport/{{$report->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{--            @method('PUT')--}}
                <div class="row">
                    <div class="col-md-6">
                        <img style="width:348px;height:348px" id="image"
                             src="http://loseall.s3.us-east-2.amazonaws.com/{{$report->image}}">
                        <input type="file" name="image" onchange="readURL(this);">
                        <span id="ImgError"></span>
                    </div>

                    <div class="col-md-6">
                        <div class="details">
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Name Of Person :') }}</h3>
                                </div>
                                <div class="col"><input type="text" class="form-control" id="inputName"
                                                        placeholder="Name Of Person" required name="name"
                                                        value="{{$report->name}}">
                                    <span id="NameErr"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Location :') }}</h3>
                                </div>
                                <div class="col"><input type="text" class="form-control" id="inputlocation"
                                                        placeholder="Last Location Of Person" required name="location"
                                                        value="{{$report->location}}">
                                    <span id="LocationErr"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Special Mark :') }}</h3>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="inputspecial_mark"
                                           placeholder="Special Mark Of Person" required name="special_mark"
                                           value="{{$report->special_mark}}">
                                    <span id="SpecialErr"></span>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Last Seen At :') }}</h3>
                                </div>
                                <div class="col">
                                    <input type="time" class="form-control" id="inputlast_seen_at"
                                           placeholder="Last Time Seen Of Person" required name="last_seen_at"
                                           value="{{$report->last_seen_at}}">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Lost Since : ') }}</h3>
                                </div>
                                <div class="col">
                                    <input type="date" class="form-control" id="inputlast_seen_at"
                                           placeholder="Last Time Seen Of Person" required name="last_seen_on"
                                           value="{{$report->lost_since}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Age : ') }}</h3>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="inputAge" placeholder="Age Of Person"
                                           min=1 max=90 required name="age" value="{{$report->age}}">
                                    <span id="NumberErr"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Height : ') }}</h3>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="inputHeight"
                                           placeholder="height Of Person In CM ex:125" min=1 max=250 required
                                           name="height" value="{{$report->height}}">
                                    <span id="HeightErr"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Weight : ') }}</h3>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="inputWeight"
                                           placeholder="Weight Of Person In KG" min=5 max=100 required name="weight"
                                           value="{{$report->weight}}">
                                    <span id="WeightErr"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Gender : ') }}</h3>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option disabled value="">{{ __('messages.select your gender') }}</option>
                                        <option
                                            {{ $report->gender=="male" ? 'selected' : '' }} value="male">{{ __('messages.Male') }}</option>
                                        <option
                                            {{ $report->gender=="female" ? 'selected' : '' }}  value="female">{{ __('messages.Female') }}</option>
                                    </select>
                                    <span id="GenderErr"></span>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Last Seen On : ') }}</h3>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="last_seen_on" name="last_seen_on" required>
                                        <option
                                            {{ $report->last_seen_on=="Saturday" ? 'selected' : '' }} value="Saturday">{{ __('messages.Saturday') }}</option>
                                        <option
                                            {{ $report->last_seen_on=="Sunday" ? 'selected' : '' }} value="Sunday">{{ __('messages.Sunday') }}</option>
                                        <option
                                            {{ $report->last_seen_on=="Monday" ? 'selected' : '' }} value="Monday">{{ __('messages.Monday') }}</option>
                                        <option
                                            {{ $report->last_seen_on=="Tuesday" ? 'selected' : '' }}value="Tuesday">{{ __('messages.Tuesday') }}</option>
                                        <option
                                            {{ $report->last_seen_on=="Wednesday" ? 'selected' : '' }} value="Wednesday">{{ __('messages.Wednesday') }}</option>
                                        <option
                                            {{ $report->last_seen_on=="Thursday" ? 'selected' : '' }} value="Thursday">{{ __('messages.Thursday') }}</option>
                                        <option
                                            {{ $report->last_seen_on=="Friday" ? 'selected' : '' }} value="Friday">{{ __('messages.Friday') }}</option>

                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Eye Color : ') }}</h3>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="eye_color" name="eye_color" required>
                                        <option
                                            {{ $report->eye_color=="black" ? 'selected' : '' }} value="black">{{ __('messages.Black') }}</option>
                                        <option
                                            {{ $report->eye_color=="brown" ? 'selected' : '' }} value="brown">{{ __('messages.Brown') }}</option>
                                        <option
                                            {{ $report->eye_color=="green" ? 'selected' : '' }} value="green">{{ __('messages.Green') }}</option>
                                        <option
                                            {{ $report->eye_color=="grey" ? 'selected' : '' }} value="grey">{{ __('messages.Grey') }}</option>
                                        <option
                                            {{ $report->eye_color=="blue" ? 'selected' : '' }} value="blue">{{ __('messages.Blue') }}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3>{{ __('messages.Hair Color : ') }}</h3>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="hair_color" name="hair_color">
                                        <option
                                            {{ $report->hair_color=="black" ? 'selected' : '' }} value="black">{{ __('messages.Black') }}</option>
                                        <option
                                            {{ $report->hair_color=="brown" ? 'selected' : '' }} value="brown">{{ __('messages.Brown') }}</option>
                                        <option
                                            {{ $report->hair_color=="white" ? 'selected' : '' }} value="white">{{ __('messages.White') }}</option>
                                        <option
                                            {{ $report->hair_color=="golden" ? 'selected' : '' }} value="golden">{{ __('messages.Golden') }}</option>
                                    </select>
                                </div>


                            </div>
                            <div class="row ">
                                <button type="submit" class="btn"
                                        id="lostButton">{{ __('messages.Update Report') }}</button>
                            </div>


                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
