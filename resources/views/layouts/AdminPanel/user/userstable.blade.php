@extends('layouts.AdminPanel.page')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<style>

</style>
<div class="section__content section__content--p30">
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12">
        <!-- DATA TABLE-->
        <table id="table" class="table text-center">
          <thead class="thead-dark">

              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">email</th>
              <th scope="col">phone</th>
              <th scope="col">ban</th>
              <th scope="col">action</th>


          </thead>
          <tbody>
            @if($users->count())
            @foreach ($users as $key => $user)
            <tr>
              <th scope="row">{{ ++$key }}</th>
              <td>{{$user->name}}</td>
              <td style="word-break: break-all;">
                <P>{{$user->email}}</P>
              </td>
              <td>{{$user->phone}}</td>

              @if(auth()->user()->id == $user->id)
              <td></td>
              @else
              <td>
                @if($user->isBanned())
                <a href="/userUserRevoke/{{$user->id}}" class="btn btn-danger m-1"> Unban</a>
                @else
                    <a href="/userBan/{{$user->id}}" class="btn btn-danger m-1"> BAN</a>
                @endif
              </td>
              @endif
              <td>
                <a href="/user/{{$user->id}}" class="btn btn-info m-1">show</a>
                <a href="/user/edit/{{$user->id}}" class="btn btn-primary m-1">update</a>
                <form class="d-inline" action="/user/{{$user->id}}" method="POST">
                  {{ csrf_field() }}

                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">delete</button>
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
        {{$users->links()}}



    </div>
  </div>
</div>
<script type="text/javascript">
  $("body").on("click",".ban",function(){
        console.log("click");


      var current_object = $(this);


      bootbox.dialog({
      message: `<form class='form-inline add-to-ban' method='POST'><div class='form-group'>
			<textarea class='form-control reason' rows='4' style='width:500px' placeholder='Add Reason for Ban this user.'>
			</textarea>
		</div>
		</form>`,
      title: "Add To Black List",
      buttons: {
        success: {
          label: "Submit",
          className: "btn-success",
          callback: function() {
                var baninfo = $('.reason').val();
                var token = $("input[name='_token']").val();
                var action = current_object.attr('data-action');
                var id = current_object.attr('data-id');


                if(baninfo == ''){
                    $('.reason').css('border-color','red');
                    return false;
                }else{
                    $('.add-to-ban').attr('action',action);
                    $('.add-to-ban').append('<input name="_token" type="hidden" value="'+ token +'">')
                    $('.add-to-ban').append('<input name="id" type="hidden" value="'+ id +'">')
                    $('.add-to-ban').append('<input name="baninfo" type="hidden" value="'+ baninfo +'">')
                    $('.add-to-ban').submit();
                }


          }
        },
        danger: {
          label: "Cancel",
          className: "btn-danger",
          callback: function() {
            // remove
          }
        },
      }
    });
});
</script>
@endsection
