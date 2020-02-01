@extends('layouts.AdminPanel.page')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
<div class="row">

<div class="col-lg-7">
    <div class="card">
        <div class="card-header">Reports</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Report Info</h3>
            </div>
            <hr>
            <form method="POST" action="" novalidate="novalidate">
                @csrf
                @method('PUT')
                <div class="form-group ">
                    <label for="name" class="control-label mb-1">Name:</label>
                    <input id="name" name="name" type="text" class="form-control" value="100.00">
                </div>
                <div class="form-group ">
                    <label for="type" class="control-label mb-1">type:</label>
                    <input id="type" name="type" type="text" class="form-control" value="100.00">
                </div>
                <div class="form-group ">
                    <label for="lost_since" class="control-label mb-1">lost_since:</label>
                    <input id="lost_since" name="lost_since" type="text" class="form-control" value="100.00">
                </div>
               
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="cc-exp" class="control-label mb-1">Age</label>
                            <input id="cc-exp" name="cc-exp" type="number" class="form-control cc-exp" value="25" >
                            <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="x_card_code" class="control-label mb-1">Gender</label>
                        <div class="input-group">
                            <input id="x_card_code" name="x_card_code" type="text" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                        </div>
                    </div>
                </div>
                <div>
                    <button id="btn_submit" type="submit" class="btn btn-lg btn-info btn-block text-white">
                        <i class="fa fa-lock fa-lg"></i>&nbsp;
                        <span id="payment-button-amount">Update</span>
                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection