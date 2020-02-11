@extends('layouts.app')
@section('content')
<button id="modalclick" hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" >
    Open modal
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Notification</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Notification will be sent as soon as possible
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="/" type="button" class="btn btn-danger"  >Close</a>
            </div>
        </div>
    </div>
</div>
    <script>
        $( document ).ready(function() {
            $( "#modalclick" ).click();
        });
    </script>
@endsection
