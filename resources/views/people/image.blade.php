@extends('layouts.app')

@section('content')
<div class="pt-5 container-fluid">
 <div class="row pt-5 justify-content-center">
     <div class="col-md-6 col-sm-10 mt-5 text-center">

    <form method="post" action="{{url('/uploadfile')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="file" name="select_file" />
            <input type="submit" name="upload" class="btn btn-primary" value="Search By Image">
            <span class="text-muted mt-2 d-block">jpg, jpeg, png</span>
           </div>
        </form>

        @if (count($errors) > 0)
        <div class="alert alert-danger">
         Upload Validation Error<br><br>
         <ul  style="list-style-type: none;">
          @foreach ($errors->all() as $error)
           <li >{{ $error }}</li>
          @endforeach
         </ul>
        </div>
       @endif

       @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            <img src="/images/{{ Session::get('path') }}" width="300" />
       @endif

    </div>


</div>
</div>
@endsection
