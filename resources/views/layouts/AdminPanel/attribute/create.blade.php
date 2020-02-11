@extends('layouts.AdminPanel.page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                        <form action="/addvalueadmin/store" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="category">attribute name:</label>
                                        <input type="text" class="form-control" id="attribute" placeholder="enter category"
                                               name="attribute" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">ادخل القيمة:</label>
                                    <input type="text" class="form-control" id="attribute-ar" placeholder="ادخل قيم"
                                           name="attribute_ar" value="">
                                </div>
                            </div>
                            <div class="col-md-12 text-center mt-3">
                                <h6>
                                    enter number of values you want to create
                                </h6>
                                <input type="number" class="form-control w-50 mx-auto mt-1" id="numberinput" placeholder="enter number of values"
                                       name="numberinput" value="0" min="1">
                            </div>
                                <div id="enValue" class="col-md-6">

                                </div>
                                <div id="arValue" class="col-md-6 ">

                                </div>
                            <div id="insertvalue" class="col-md-6 mx-auto justify-content-center">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script>
        function insertToHtml(val) {
            let enValue=document.getElementById('enValue');
            let arValue=document.getElementById('arValue');
            let insertValue=document.getElementById('insertvalue');
            enValue.innerHTML="";
            arValue.innerHTML="";
            insertValue.innerHTML="";
            for (let i=1;i<=val;i++){
                enValue.insertAdjacentHTML('beforeend',`<label>Value ${i}</label><input type="text" name="valueEn[]" class="form-control">`)
                arValue.insertAdjacentHTML('beforeend',`<label>Value Ar ${i}</label><input type="text" name="valueAr[]" class="form-control">`)
            }
            insertValue.insertAdjacentHTML('beforeend','<button type="submit" class="btn btn-dark mx-auto  mt-1" value="Store">Store</button>')
        }
        $( "#numberinput" ).change(function(event) {
            insertToHtml(event.target.value)
        });



    </script>
@endsection
