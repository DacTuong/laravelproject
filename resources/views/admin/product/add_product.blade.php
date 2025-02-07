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
            <select class="form-control" id="categories_product_id" name="categories_product_id">
                <option value="">Chọn Danh Mục</option>
                <!-- Thêm danh sách các danh mục ở đây -->
                @foreach($cate_product as $index => $cate)
                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Thương hiệu</label>
            <select name="brand_product" class="form-control">
                <option value="">
                    -- Chọn thương hiệu --
                </option>
                @foreach($brand_product as $index => $brand)
                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="release_date">Ngày Phát Hành:</label>
            <input type="date" class="form-control" id="release_date" name="release_date">
        </div>

        <div class="form-group">
            <label for="operating_system">Hệ Điều Hành:</label>
            <input type="text" class="form-control" id="operating_system" name="operating_system">
        </div>

        <div class="form-group">
            <label for="screen_type">Loại Màn Hình:</label>
            <input type="text" class="form-control" id="screen_type" name="screen_type">
        </div>

        <div class="form-group">
            <label for="screen_size">Kích Thước Màn Hình:</label>
            <input type="number" step="0.01" class="form-control" id="screen_size" name="screen_size">
        </div>

        <div class="form-group">
            <label for="resolution">Độ Phân Giải:</label>
            <input type="text" class="form-control" id="resolution" name="resolution">
        </div>

        <div class="form-group">
            <label for="refresh_rate">Tần Số Quét:</label>
            <input type="number" class="form-control" id="refresh_rate" name="refresh_rate">
        </div>

        <div class="form-group">
            <label for="ram">RAM:</label>
            <input type="number" class="form-control" id="ram" name="ram">
        </div>

        <div class="form-group">
            <label for="storage">Bộ Nhớ Trong:</label>
            <input type="number" class="form-control" id="storage" name="storage">
        </div>

        <div class="form-group">
            <label for="expandable_storage">Hỗ Trợ Thẻ Nhớ Ngoài:</label>
            <select class="form-control" id="expandable_storage" name="expandable_storage">
                <option value="0">Không</option>
                <option value="1">Có</option>
            </select>
        </div>

        <div class="form-group">
            <label for="battery_capacity">Dung Lượng Pin:</label>
            <input type="number" class="form-control" id="battery_capacity" name="battery_capacity">
        </div>

        <div class="form-group">
            <label for="fast_charging">Hỗ Trợ Sạc Nhanh:</label>
            <input type="text" class="form-control" id="fast_charging" name="fast_charging">
        </div>

        <div class="form-group">
            <label for="wireless_charging">Hỗ Trợ Sạc Không Dây:</label>
            <select class="form-control" id="wireless_charging" name="wireless_charging">
                <option value="0">Không</option>
                <option value="1">Có</option>
            </select>
        </div>

        <div class="form-group">
            <label for="camera_main">Camera Chính:</label>
            <input type="text" class="form-control" id="camera_main" name="camera_main">
        </div>

        <div class="form-group">
            <label for="camera_main_features">Tính Năng Camera Chính:</label>
            <input type="text" class="form-control" id="camera_main_features" name="camera_main_features">
        </div>

        <div class="form-group">
            <label for="camera_front">Camera Trước:</label>
            <input type="text" class="form-control" id="camera_front" name="camera_front">
        </div>

        <div class="form-group">
            <label for="camera_front_features">Tính Năng Camera Trước:</label>
            <input type="text" class="form-control" id="camera_front_features" name="camera_front_features">
        </div>

        <div class="form-group">
            <label for="cpu">Bộ Xử Lý:</label>
            <input type="text" class="form-control" id="cpu" name="cpu">
        </div>

        <div class="form-group">
            <label for="gpu">Đồ Họa:</label>
            <input type="text" class="form-control" id="gpu" name="gpu">
        </div>

        <div class="form-group">
            <label for="water_resistance">Chống Nước:</label>
            <input type="text" class="form-control" id="water_resistance" name="water_resistance">
        </div>

        <div class="form-group">
            <label for="weight">Trọng Lượng:</label>
            <input type="number" step="0.01" class="form-control" id="weight" name="weight">
        </div>

        <div class="form-group">
            <label for="dimensions">Kích Thước:</label>
            <input type="text" class="form-control" id="dimensions" name="dimensions">
        </div>

        <div class="form-group">
            <label for="sim_type">Loại SIM:</label>
            <input type="text" class="form-control" id="sim_type" name="sim_type">
        </div>

        <div class="form-group">
            <label for="connectivity">Kết Nối:</label>
            <input type="text" class="form-control" id="connectivity" name="connectivity">
        </div>

        <div class="form-group">
            <label for="biometrics">Công Nghệ Bảo Mật:</label>
            <input type="text" class="form-control" id="biometrics" name="biometrics">
        </div>

        <div class="form-group">
            <label for="color">Các Tùy Chọn Màu Sắc:</label>
            <input type="text" class="form-control" id="color" name="color">
        </div>

        <div class="form-group">
            <label for="charging_port">Cổng Sạc:</label>
            <input type="text" class="form-control" id="charging_port" name="charging_port">
        </div>

        <div class="form-group">
            <label for="other_connections">Các Kết Nối Khác:</label>
            <input type="text" class="form-control" id="other_connections" name="other_connections">
        </div>

        <div class="form-group">
            <label for="wifi_technology">Công Nghệ WiFi:</label>
            <input type="text" class="form-control" id="wifi_technology" name="wifi_technology">
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