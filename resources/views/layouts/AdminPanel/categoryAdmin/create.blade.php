@extends('layouts.AdminPanel.page')

@section('content')

{{-- <form action="/category/admin" method="POST">
   @csrf
    
            
            <input type="text" name="category_name" placeholder="Category" id="category_name" class="form-control">
            <br>
            <input type="text" name="attribute_name" placeholder="Attribute" id="attribute_name" class="form-control">
            <br>
            <input type="text" name="value_name" placeholder="insert Color Size Model" id="value_name" class="form-control">
            <br>
            <input type="submit" name="submit" value="Create" class="btn btn-lg btn-info btn-block text-white">
     
    </form> --}}
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class=" m-b-40">
                    <form action="/create/category/admin" method="POST">
                        @csrf
                        {{-- @METHOD('PUT') --}}

                        <div class="form-group">
                            <label for="category">category name:</label>
                            <input type="text" class="form-control w-25" id="category" placeholder="enter category"
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
                        <input type="submit" name="submit" value="add"
                            class="btn btn-lg btn-info btn-block text-white">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection