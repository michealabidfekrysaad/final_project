@extends('layouts.AdminPanel.page')

@section('content')

    {{-- @foreach($categories as $category)
    @foreach($category->attributes as $attribute) --}}

    {{-- <form action="/category/updateAdmin/{{$category->id}}" method="POST"> --}}
    {{-- @csrf --}}
    {{-- @METHOD('PUT')

                <input type="text" value="{{$attribute->attribute_name}}" name="attribute_name" placeholder="Attribute"
    id="attribute_name" class="form-control">
    @endforeach
    @endforeach
    <br>
    @foreach($values as $value)
    <input type="text" value="{{$value->value_name}}" name="value_name" placeholder="insert Color Size Model"
        id="value_name" class="form-control">
    @endforeach
    <br>
    <input type="submit" name="submit" value="Update" class="btn btn-lg btn-info btn-block text-white">

    </form> --}}

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" m-b-40">
                        <form action="/category/updateAdmin/{{$category->id}}" method="POST">
                            @csrf
                            @METHOD('PUT')

                            <div class="form-group">
                                <label for="{{$category->id}}">category name:</label>
                                <input type="text" class="form-control w-25" id="{{$category->id}}"
                                       placeholder="enter category" name="category"
                                       value="{{$category->category_name}}">
                                <label for="{{$category->id}}">category name:</label>
                                <input type="text" class="form-control w-25" id="{{$category->id}}"
                                       placeholder="enter category" name="category_ar"
                                       value="{{$category->category_name_ar}}">
                            </div>
                            <div class="ml-4 mt-4">
                                <div class="ml-4 my-3">
                                    @foreach ($attributes as $attribute)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="attribute[]" id="{{$attribute->id}}" value="{{$attribute->id}}"
                                                {{($attributeOfCategory)->contains($attribute) ? 'checked' : ' '}}>
                                            <label class="form-check-label" for="{{$attribute->id}}">
                                                {{$attribute->attribute_name}}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                            <input type="submit" name="submit" value="Update"
                                   class="btn btn-lg btn-info btn-block text-white">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
