@extends('admin_layout')
@section('admin_content')
<form action="{{URL::to('/save-slide')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
        <label for="">Tên slide</label>
        <input type="text" class="form-control" name="banner_name" id="">
    </div>
    <div class="form-group">
        <label for="">Tên sản phẩm</label>
        <select name="product_id" id="">
            @foreach ($products as $product )
            <option value="{{$product->product_id}}">{{$product->product_name}}</option>
            @endforeach
        </select>
    </div>
    <br>
    <div class="form-group">
        <label for="">slide image</label>
        <input type="file" name="banner_image" id="">
    </div>
    <input type="submit" name="add_to_slide" id="">
</form>
@endsection