@extends('layouts.AdminPanel.page')

@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 ">
                <div class="" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('img/speakers/1.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-text mb-2">Name: </h5>
                      <h5 class="card-text mb-2">Age: </h5>
                      <h5 class="card-text mb-2">Gender: </h5>
                      <h5 class="card-text mb-2">Type of report: </h5>
                      <h5 class="card-text mb-2">Lost_since: </h5>


                    </div>
                    <a href="/admin/panel/table" class="btn btn-outline-info  mt-2">Go Back To Table</a>

                  </div>
                  
                
              </div>

            </div>
            
              </div>
            </div>
        </div>
    </div>
</div>

@endsection