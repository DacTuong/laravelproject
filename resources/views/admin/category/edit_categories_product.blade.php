@extends('admin_layout')
@section('admin_content')


<form action="{{URL::to('/update-category-product'.'/'.$edit_category->category_id)}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label></label>
        <input type="text" class="form-control" name="categories_product_name"
            value="{{$edit_category->category_name}}">
    </div>
    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
</form>

@endsection