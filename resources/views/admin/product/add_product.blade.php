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

<form action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
    <div class="col-sm-9">
        {{csrf_field()}}
        <div class="form-group">
            <label for="product_code">Mã Sản Phẩm:</label>
            <input type="text" class="form-control" id="product_code" name="product_code">
        </div>

        <div class="form-group">
            <label for="product_name">Tên Sản Phẩm:</label>
            <input type="text" class="form-control" data-slug-source="product_name" id="product_name"
                name="product_name">
        </div>
        <div class="form-group">
            <label for="model_product">Model Sản Phẩm:</label>
            <input type="text" class="form-control" id="model_product" name="model_product">
        </div>

        <div class="form-group">
            <label for="purchase_price">Giá Nhập Hàng:</label>
            <input type="number" class="form-control" id="purchase_price" name="purchase_price">
        </div>

        <div class="form-group">
            <label for="sale_price">Giá Bán Củ:</label>
            <input type="number" class="form-control" id="old_price" name="old_price">
        </div>
        <div class="form-group">
            <label for="sale_price">Giá Bán:</label>
            <input type="number" class="form-control" id="sale_price" name="sale_price">
        </div>

        <div class="form-group">
            <label for="product_quantity">Số Lượng Sản Phẩm:</label>
            <input type="number" class="form-control" id="product_quantity" name="product_quantity">
        </div>

        <div class="form-group">
            <label for="categories_product_id">Danh Mục Sản Phẩm:</label>
            <select class="form-control categories_product_id" id="categories_product_id" name="categories_product_id">
                <option value="">Chọn Danh Mục</option>
                <!-- Thêm danh sách các danh mục ở đây -->
                @foreach($cate_product as $index => $cate)
                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Thương hiệu</label>
            <select name="brand_product" class="form-control" id="brand_product">

            </select>
        </div>

        <div class="form-group">
            <label for="release_date">Ngày Phát Hành:</label>
            <input type="date" class="form-control" id="release_date" name="release_date">
        </div>

        <div class="form-group">
            <label for="varian_product">Biến thể sản phẩm:</label>
            <input type="text" class="form-control" id="varian_product" name="varian_product">
        </div>


        <div class="form-group">
            <label for="warranty_period">Thời Gian Bảo Hành (tháng):</label>
            <input type="number" class="form-control" id="warranty_period" name="warranty_period" value="12">
        </div>

        <div class="form-group">
            <label for="product_status">Trạng Thái Sản Phẩm:</label>
            <select class="form-control" id="product_status" name="product_status">
                <option value="1">Còn Hàng</option>
                <option value="0">Hết Hàng</option>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" class="form-control" name="product_image">
        </div>
    </div>
    <div class="col-sm-12">
        <button type="submit" name="add" class="btn btn-primary">Thêm Sản Phẩm</button>
    </div>
</form>


@endsection