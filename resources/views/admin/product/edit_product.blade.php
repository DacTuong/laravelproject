@extends('admin_layout')
@section('admin_content')

<form action="{{URL::to('/update-product'.'/'.$products->product_id)}}" method="POST" enctype="multipart/form-data">
    <div class="col-sm-9">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="product_code">Mã Sản Phẩm:</label>
            <input type="text" class="form-control" id="product_code" name="product_code"
                value="{{$products->product_code}}">
        </div>

        <div class="form-group">
            <label for="product_name">Tên Sản Phẩm:</label>
            <input type="text" class="form-control" id="product_name" name="product_name"
                value="{{$products->product_name}}">
        </div>

        <div class="form-group">
            <label for="varian_product">Dòng sản phẩm:</label>
            <input type="text" class="form-control" id="varian_product" name="varian_product"
                value="{{$products->varian_product}}">
        </div>

        <div class="form-group">
            <label for="purchase_price">Giá Nhập Hàng:</label>
            <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                value="{{$products->purchase_price}}">
        </div>
        <div class="form-group">
            <label for="sale_price">Giá Bán Củ:</label>
            <input type="number" class="form-control" id="old_price" name="old_price" value="{{$products->old_price}}">
        </div>
        <div class="form-group">
            <label for="sale_price">Giá Bán:</label>
            <input type="number" class="form-control" id="sale_price" name="sale_price"
                value="{{$products->sale_price}}">
        </div>

        <div class="form-group">
            <label for="product_quantity">Số Lượng Sản Phẩm:</label>
            <input type="number" class="form-control" id="product_quantity" name="product_quantity"
                value="{{$products->product_quantity}}">
        </div>

        <div class="form-group">
            <label>Loại sản phẩm</label>
            <select name="categories_product_id" class="form-control">
                @foreach ($cate_products as $cate)
                <option value="{{ $cate->category_id }}"
                    {{ $cate->category_id == $products->categories_product_id ? 'selected' : '' }}>
                    {{ $cate->category_name }}
                </option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Thương hiệu</label>

            <select class="form-control" name="brand_product">
                @foreach ($brand_products as $key => $brand)
                <option value="{{$brand->brand_id}}"
                    {{ $brand->brand_id == $products->brand_product_id  ? 'selected' : '' }}>
                    {{$brand->brand_name}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="release_date">Ngày Phát Hành:</label>
            <input type="date" class="form-control" id="release_date" name="release_date"
                value="{{$products->release_date}}">

        </div>

        <div class="form-group">
            <label for="operating_system">Hệ Điều Hành:</label>
            <input type="text" class="form-control" id="operating_system" name="operating_system"
                value="{{$products->operating_system}}">

        </div>

        <div class="form-group">
            <label for="screen_type">Loại Màn Hình:</label>
            <input type="text" class="form-control" id="screen_type" name="screen_type"
                value="{{$products->screen_type}}">
        </div>

        <div class="form-group">
            <label for="screen_size">Kích Thước Màn Hình:</label>
            <input type="number" step="0.01" class="form-control" id="screen_size" name="screen_size"
                value="{{$products->screen_size}}">
        </div>

        <div class="form-group">
            <label for="resolution">Độ Phân Giải:</label>
            <input type="text" class="form-control" id="resolution" name="resolution" value="{{$products->resolution}}">
        </div>

        <div class="form-group">
            <label for="refresh_rate">Tần Số Quét:</label>
            <input type="number" class="form-control" id="refresh_rate" name="refresh_rate"
                value="{{$products->refresh_rate}}">
        </div>

        <div class="form-group">
            <label for="ram">RAM:</label>
            <input type="number" class="form-control" id="ram" name="ram" value="{{$products->ram}}">
        </div>

        <div class="form-group">
            <label for="storage">Bộ Nhớ Trong:</label>
            <input type="number" class="form-control" id="storage" name="storage" value="{{$products->storage}}">
        </div>

        <div class="form-group">
            <label for="expandable_storage">Hỗ Trợ Thẻ Nhớ Ngoài:</label>
            <select class="form-control" id="expandable_storage" name="expandable_storage">
                <option value="0" {{ $products->expandable_storage == 0 ? 'selected' : '' }}>Không hỗ trợ</option>
                <option value="1" {{  $products->expandable_storage == 1 ? 'selected' : '' }}>Có hỗ trợ</option>

            </select>
        </div>

        <div class="form-group">
            <label for="battery_capacity">Dung Lượng Pin:</label>
            <input type="number" class="form-control" id="battery_capacity" name="battery_capacity"
                value="{{$products->battery_capacity}}">
        </div>

        <div class="form-group">
            <label for="fast_charging">Hỗ Trợ Sạc Nhanh:</label>
            <input type="text" class="form-control" id="fast_charging" name="fast_charging"
                value="{{$products->fast_charging}}">
        </div>

        <div class="form-group">
            <label for="wireless_charging">Hỗ Trợ Sạc Không Dây:</label>
            <select class="form-control" id="wireless_charging" name="wireless_charging">
                <option value="0" {{ $products->wireless_charging == 0 ? 'selected' : '' }}>Không hỗ trợ</option>
                <option value="1" {{  $products->wireless_charging == 1 ? 'selected' : '' }}>Có hỗ trợ</option>
            </select>
        </div>

        <div class="form-group">
            <label for="camera_main">Camera Chính:</label>
            <input type="text" class="form-control" id="camera_main" name="camera_main"
                value="{{$products->camera_main}}">
        </div>

        <div class="form-group">
            <label for="camera_main_features">Tính Năng Camera Chính:</label>
            <input type="text" class="form-control" id="camera_main_features" name="camera_main_features"
                value="{{$products->camera_main_features}}">
        </div>

        <div class="form-group">
            <label for="camera_front">Camera Trước:</label>
            <input type="text" class="form-control" id="camera_front" name="camera_front"
                value="{{$products->camera_front}}">
        </div>

        <div class="form-group">
            <label for="camera_front_features">Tính Năng Camera Trước:</label>
            <input type="text" class="form-control" id="camera_front_features" name="camera_front_features"
                value="{{$products->camera_front_features}}">
        </div>

        <div class="form-group">
            <label for="cpu">Bộ Xử Lý:</label>
            <input type="text" class="form-control" id="cpu" name="cpu" value="{{$products->cpu}}">
        </div>

        <div class="form-group">
            <label for="gpu">Đồ Họa:</label>
            <input type="text" class="form-control" id="gpu" name="gpu" value="{{$products->gpu}}">
        </div>

        <div class="form-group">
            <label for="water_resistance">Chống Nước:</label>
            <input type="text" class="form-control" id="water_resistance" name="water_resistance"
                value="{{$products->water_resistance}}">
        </div>

        <div class="form-group">
            <label for="weight">Trọng Lượng:</label>
            <input type="number" step="0.01" class="form-control" id="weight" name="weight"
                value="{{$products->weight}}">
        </div>

        <div class="form-group">
            <label for="dimensions">Kích Thước:</label>
            <input type="text" class="form-control" id="dimensions" name="dimensions" value="{{$products->dimensions}}">
        </div>

        <div class="form-group">
            <label for="sim_type">Loại SIM:</label>
            <input type="text" class="form-control" id="sim_type" name="sim_type" value="{{$products->sim_type}}">
        </div>

        <div class="form-group">
            <label for="connectivity">Kết Nối:</label>
            <input type="text" class="form-control" id="connectivity" name="connectivity"
                value="{{$products->connectivity}}">
        </div>

        <div class="form-group">
            <label for="biometrics">Công Nghệ Bảo Mật:</label>
            <input type="text" class="form-control" id="biometrics" name="biometrics" value="{{$products->biometrics}}">
        </div>

        <div class="form-group">
            <label for="color">Các Tùy Chọn Màu Sắc:</label>
            <input type="text" class="form-control" id="color" name="color" value="{{$products->color}}">
        </div>

        <div class="form-group">
            <label for="charging_port">Cổng Sạc:</label>
            <input type="text" class="form-control" id="charging_port" name="charging_port"
                value="{{$products->charging_port}}">
        </div>

        <div class="form-group">
            <label for="other_connections">Các Kết Nối Khác:</label>
            <input type="text" class="form-control" id="other_connections" name="other_connections"
                value="{{$products->other_connections}}">
        </div>

        <div class="form-group">
            <label for="wifi_technology">Công Nghệ WiFi:</label>
            <input type="text" class="form-control" id="wifi_technology" name="wifi_technology"
                value="{{$products->wifi_technology}}">
        </div>

        <div class="form-group">
            <label for="warranty_period">Thời Gian Bảo Hành (tháng):</label>
            <input type="number" class="form-control" id="warranty_period" name="warranty_period" value="12"
                value="{{$products->warranty_period}}">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <h4>Hình ảnh</h4>
            <img src="{{ URL::to('uploads/product/' . $products->product_image) }}"
                style="height: 100px; width: 150px;">
            <input type="file" class="form-control" name="product_image">
        </div>

    </div>
    <div class="col-sm-12">
        <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
    </div>

</form>


@endsection