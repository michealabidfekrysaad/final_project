@extends('layouts.app')

@section('content')
    <div class="pt-5 container-fluid">
        <div class="row mt-2 pt-5 section-header">
            <h2 class="mx-auto">{{ __('messages.Search By Image') }}</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-10 text-center">
                <h4>{{ __('messages.Upload Image For Lost Person To Search If There Is Match Or Not') }}</h4>
                <img id="blah" src="http://placehold.it/300" alt="your image" width="300px" height="300px"/>
                <form method="post" action="{{url('/uploadfile')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="file" name="select_file" onchange="readURL(this);" class="btn " require/>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                Upload Validation Error<br><br>
                                <ul style="list-style-type: none;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <span
                            class="text-muted mt-2 d-block">{{ __('messages.Plz Make Sure Image is jpg, jpeg, png') }}</span>
                        <input type="submit" name="upload" class="btn btn-primary mt-3"
                               value="{{ __('messages.Search By Image') }}">

                    </div>
                </form>


                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    <img src="/images/{{ Session::get('path') }}" width="300"/>
                @endif

            </div>


        </div>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
