@extends('admin_layout')
@section('admin_content')
@php
use Illuminate\Support\Facades\Session;

$message_success = Session::get('message_success');
if ($message_success) {
echo '<p class="text-success">', $message_success, '</p>';
Session::put('message_success', null);
}
@endphp

<form action="{{URL::to('/save-category-product')}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label>Tên loại sản phẩm</label>
        <input type="text" class="form-control" name="categories_name" data-slug-source="category"
            placeholder="Nhập tên loại">
    </div>
    <div class="form-group">
        <label>Tên loại sản phẩm slug</label>
        <input type="text" class="form-control" name="cate_slug" data-slug-target="category"
            placeholder="Tên loại sản phẩm slug">
    </div>

    <div class="form-group">
        <label>Tình Trạng</label>
        <select name="categories_product_status" class="form-control">
            <option value="1">Hiện</option>
            <option value="0">Ẩn</option>
        </select>
    </div>
    <button type="submit" name="add" class="btn btn-primary">Thêm loại sản phẩm</button>
</form>
@endsection