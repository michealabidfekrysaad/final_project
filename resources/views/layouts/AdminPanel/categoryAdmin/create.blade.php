@extends('layouts.AdminPanel.page')

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                        <form action="/create/category/admin" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">category name:</label>
                                        <input type="text" class="form-control w-50" id="category"
                                               placeholder="enter category"
                                               name="category" value="">
                                    </div>
                                    <div class="ml-4 mt-4">
                                        <div class="ml-4 my-3">
                                            @foreach ($attributes as $attribute)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="attribute[]"
                                                           id="{{$attribute->id}}" value="{{$attribute->id}}"
                                                        {{($attributeOfCategory)->contains($attribute) ? 'checked' : ' '}}>
                                                    <label class="form-check-label" for="{{$attribute->id}}">
                                                        {{$attribute->attribute_name}}
                                                    </label>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">: اسم الفئة</label>
                                        <input type="text" class="form-control w-50" placeholder="enter category"
                                               name="category_ar" value="">
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <input type="submit" name="submit" value="add"
                                           class="btn btn-lg btn-info btn-block text-white">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
