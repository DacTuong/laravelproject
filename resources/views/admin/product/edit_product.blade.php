@extends('admin_layout')
@section('admin_content')

<form action="{{URL::to('/update-product'.'/'.$products->product_id)}}" method="POST" enctype="multipart/form-data">
    <div class="col-sm-12">
        <button type="submit" name="add" class="btn btn-primary btn-save">Lưu lại</button>
    </div>

    <div class="col-sm-9">
        {{csrf_field()}}
        <div class="product-info">
            <div class="form-group">
                <label for="product_code">Mã Sản Phẩm:</label>
                <input type="text" class="form-control" id="product_code" name="product_code"
                    value="{{ $products->product_code }}">
            </div>

            <div class="form-group">
                <label for="product_name">Tên Sản Phẩm:</label>
                <input type="text" class="form-control" data-slug-source="product_name" id="product_name"
                    value="{{ $products->product_name }}" name="product_name">
            </div>
            <div class="form-group">
                <label for="model_product">Model Sản Phẩm:</label>
                <input type="text" class="form-control" id="model_product" name="model_product"
                    value="{{ $products->model_product }}">
            </div>

            <div class="form-group">
                <label for="purchase_price">Giá Nhập Hàng:</label>
                <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                    value="{{ $products->purchase_price }}">
            </div>

            <div class="form-group">
                <label for="sale_price">Giá Bán Củ:</label>
                <input type="number" class="form-control" id="old_price" name="old_price"
                    value="{{ $products->old_price }}">
            </div>
            <div class="form-group">
                <label for="sale_price">Giá Bán:</label>
                <input type="number" class="form-control" id="sale_price" name="sale_price"
                    value="{{ $products->sale_price }}">
            </div>

            <div class="form-group">
                <label for="product_quantity">Số Lượng Sản Phẩm:</label>
                <input type="number" class="form-control" id="product_quantity" name="product_quantity"
                    value="{{ $products->product_quantity }}">
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
                    value="{{ $products->release_date }}">
            </div>

            <div class="form-group">
                <label for="varian_product">Biến thể sản phẩm:</label>
                <input type="text" class="form-control" id="varian_product" name="varian_product"
                    value="{{ $products->varian_product }}">
            </div>


            <div class="form-group">
                <label for="warranty_period">Thời Gian Bảo Hành (tháng):</label>
                <input type="number" class="form-control" id="warranty_period" name="warranty_period"
                    value="{{ $products->warranty_period }}">
            </div>

        </div>

        @if ($products->categories_product_id == 1)
        <div class="">
            <h4>Điện thoại</h4>
            <div class="form-group">
                <label for="operating_system">Hệ Điều Hành:</label>
                <input type="text" class="form-control" id="operating_system" name="operating_system"
                    value="{{ $details->operating_system  ?? ''}}">
            </div>
            <div class="form-group">
                <label for="screen_type">Loại Màn Hình:</label>
                <input type="text" class="form-control" id="screen_type" name="screen_type"
                    value="{{ $details->screen_type  ?? ''}}">
            </div>
            <div class="form-group">
                <label for="screen_size">Kích Thước Màn Hình:</label>
                <input type="text" class="form-control" id="screen_size" name="screen_size"
                    value="{{ $details->screen_size  ?? ''}}">
            </div>
            <div class="form-group">
                <label for="resolution">Độ Phân Giải:</label>
                <input type="text" class="form-control" id="resolution" name="resolution"
                    value="{{ $details->resolution  ?? ''}}">
            </div>

            <div class="form-group">
                <label for="refresh_rate">Tần Số Quét:</label>
                <input type="number" class="form-control" id="refresh_rate" name="refresh_rate"
                    value="{{ $details->refresh_rate  ?? ''}}">
            </div>

            <div class="form-group">
                <label for="ram">RAM:</label>
                <input type="number" class="form-control" id="ram" name="ram" value="{{ $details->ram  ?? ''}}">
            </div>

            <div class="form-group">
                <label for="storage">Bộ Nhớ Trong:</label>
                <input type="number" class="form-control" id="storage" name="storage"
                    value="{{ $details->storage  ?? ''}}">
            </div>

            <div class="form-group">
                <label for="expandable_storage">Hỗ Trợ Thẻ Nhớ Ngoài:</label>
                <select class="form-control" id="expandable_storage" name="expandable_storage">
                    <option value="0" {{ $details->expandable_storage ==0 ? 'selected' : '' }}>Không</option>
                    <option value="1" {{ $details->expandable_storage ==1 ? 'selected' : '' }}>Có</option>
                </select>
            </div>

            <div class="form-group">
                <label for="battery_capacity">Dung Lượng Pin:</label>
                <input type="number" class="form-control" id="battery_capacity" name="battery_capacity"
                    value="{{ $details->battery_capacity  ?? ''}}">
            </div>

            <div class="form-group">
                <label for="fast_charging">Hỗ Trợ Sạc Nhanh:</label>
                <input type="text" class="form-control" id="fast_charging" name="fast_charging"
                    value="{{ $details->fast_charging  ?? ''}}">
            </div>

            <div class="form-group">
                <label for="wireless_charging">Hỗ Trợ Sạc Không Dây:</label>
                <select class="form-control" id="wireless_charging" name="wireless_charging">
                    <option value="0" {{ $details->wireless_charging == 0 ? 'selected' : '' }}>Không</option>
                    <option value="1" {{ $details->wireless_charging == 1 ? 'selected' : '' }}>Có</option>
                </select>
            </div>

            <div class="form-group">
                <label for="camera_main">Camera Chính:</label>
                <input type="text" class="form-control" id="camera_main" name="camera_main"
                    value="{{ $details->camera_main }}">
            </div>

            <div class="form-group">
                <label for="camera_main_features">Tính Năng Camera Chính:</label>
                <input type="text" class="form-control" id="camera_main_features" name="camera_main_features"
                    value="{{ $details->camera_main_features }}">
            </div>

            <div class="form-group">
                <label for="camera_front">Camera Trước:</label>
                <input type="text" class="form-control" id="camera_front" name="camera_front"
                    value="{{ $details->camera_front }}">
            </div>

            <div class="form-group">
                <label for="camera_front_features">Tính Năng Camera Trước:</label>
                <input type="text" class="form-control" id="camera_front_features" name="camera_front_features"
                    value="{{$details->camera_front_features}}">
            </div>

            <div class="form-group">
                <label for="cpu">Bộ Xử Lý:</label>
                <input type="text" class="form-control" id="cpu" name="cpu" value="{{ $details->cpu }}">
            </div>

            <div class="form-group">
                <label for="gpu">Đồ Họa:</label>
                <input type="text" class="form-control" id="gpu" name="gpu" value="{{ $details->gpu }}">
            </div>

            <div class="form-group">
                <label for="water_resistance">Chống Nước:</label>
                <input type="text" class="form-control" id="water_resistance" name="water_resistance"
                    value="{{ $details->water_resistance }}">
            </div>
            <div class="form-group">
                <label for="weight">Trọng Lượng:</label>
                <input type="number" step="0.01" class="form-control" id="weight" name="weight"
                    value="{{ $details->weight }}">
            </div>

            <div class="form-group">
                <label for="dimensions">Kích Thước:</label>
                <input type="text" class="form-control" id="dimensions" name="dimensions"
                    value="{{ $details->dimensions }}">
            </div>

            <div class="form-group">
                <label for="sim_type">Loại SIM:</label>
                <input type="text" class="form-control" id="sim_type" name="sim_type" value="{{ $details->sim_type }}">
            </div>

            <div class="form-group">
                <label for="connectivity">Kết Nối:</label>
                <input type="text" class="form-control" id="connectivity" name="connectivity"
                    value="{{ $details->connectivity }}">
            </div>

            <div class="form-group">
                <label for="biometrics">Công Nghệ Bảo Mật:</label>
                <input type="text" class="form-control" id="biometrics" name="biometrics"
                    value="{{ $details->biometrics}}">
            </div>
            <div class="form-group">
                <label for="color">Các Tùy Chọn Màu Sắc:</label>
                <input type="text" class="form-control" id="color" name="color" value="{{ $details->color }}">
            </div>

            <div class="form-group">
                <label for="charging_port">Cổng Sạc:</label>
                <input type="text" class="form-control" id="charging_port" name="charging_port"
                    value="{{ $details->charging_port }}">
            </div>

            <div class="form-group">
                <label for="other_connections">Các Kết Nối Khác:</label>
                <input type="text" class="form-control" id="other_connections" name="other_connections"
                    value="{{ $details->other_connections }}">
            </div>

            <div class="form-group">
                <label for="wifi_technology">Công Nghệ WiFi:</label>
                <input type="text" class="form-control" id="wifi_technology" name="wifi_technology"
                    value="{{ $details->wifi_technology }}">
            </div>
        </div>
        @endif


        <!-- Hiển thị thông tin bảng laptop -->
        @if (
        $products->categories_product_id == 2
        )
        <div class="">
            <h4>Laptop</h4>
            <div class="form-group">
                <label>Hệ điều hành :</label>
                <input type="text" class="form-control" name="laptop_operating_system"
                    value="{{ $details->laptop_operating_system }}">
            </div>
            <div class="form-group">
                <label>Kích thước màn hình:</label>
                <input type="text" class="form-control" name="laptop_screen_size"
                    value="{{ $details->laptop_screen_size }}">
            </div>
            <div class="form-group">
                <label>Loại màn hình:</label>
                <input type="text" class="form-control" name="laptop_screen_type"
                    value="{{ $details->laptop_screen_type }}">
            </div>
            <div class="form-group">
                <label>Độ phân giải:</label>
                <input type="text" class="form-control" name="laptop_resolution"
                    value="{{ $details->laptop_resolution }}">
            </div>
            <div class="form-group">
                <label>Tần số quét:</label>
                <input type="text" class="form-control" name="laptop_refresh_rate"
                    value="{{ $details->laptop_refresh_rate }}">
            </div>
            <div class="form-group">
                <label>CPU:</label>
                <input type="text" class="form-control" name="laptop_cpu" value="{{ $details->laptop_cpu }}">
            </div>
            <div class="form-group">
                <label>Ram:</label>
                <input type="text" class="form-control" name="laptop_ram" value="{{ $details->laptop_ram }}">
            </div>
            <div class="form-group">
                <label>Ổ cứng:</label>
                <input type="text" class="form-control" name="laptop_storage" value="{{ $details->laptop_storage }}">
            </div>
            <div class="form-group">
                <label>Loại ổ cứng:</label>
                <input type="text" class="form-control" name="laptop_storage_type"
                    value="{{ $details-> laptop_storage_type}}">
            </div>
            <div class="form-group">
                <label>Hỗ trợ mở rộng:</label>

                <select class="form-control" name="laptop_expandable_storage">
                    <option value="0" {{ $details->laptop_expandable_storage ==0 ? 'selected' : '' }}>Không</option>
                    <option value="1" {{ $details->laptop_expandable_storage ==1 ? 'selected' : '' }}>Có</option>
                </select>
            </div>
            <div class="form-group">
                <label>GPU:</label>
                <input type="text" class="form-control" name="laptop_gpu" value="{{ $details->laptop_gpu }}">
            </div>
            <div class="form-group">
                <label>Pin:</label>
                <input type="text" class="form-control" name="laptop_battery_capacity"
                    value="{{ $details->laptop_battery_capacity }}">
            </div>
            <div class="form-group">
                <label>Trọng lượng (kg):</label>
                <input type="text" class="form-control" name="laptop_weight" value="{{ $details-> laptop_weight}}">
            </div>
            <div class="form-group">
                <label>Kết nối:</label>
                <input type="text" class="form-control" name="laptop_connectivity"
                    value="{{ $details-> laptop_connectivity}}">
            </div>
            <div class="form-group">
                <label>Cổng kết nối:</label>
                <input type="text" class="form-control" name="laptop_port_type"
                    value="{{ $details->laptop_port_type }}">
            </div>
            <div class="form-group">
                <label>Sinh trắc học:</label>
                <input type="text" class="form-control" name="laptop_biometrics"
                    value="{{ $details->laptop_biometrics }}">
            </div>
        </div>

        @endif
        @if ($products->categories_product_id == 3)
        <div class="">
            <h4>Đồng hồ thông minh</h4>
            <div class="form-group">
                <label>Hệ điều hành:</label>
                <input type="text" class="form-control" name="watch_operating_system"
                    value="{{ $details->watch_operating_system }}">
            </div>

            <div class="form-group">
                <label>Kích thước màn hình:</label>
                <input type="text" class="form-control" name="watch_screen_size"
                    value="{{ $details->watch_screen_size }}">
            </div>
            <div class="form-group">
                <label>Loại màn hình:</label>
                <input type="text" class="form-control" name="watch_screen_type"
                    value="{{ $details->watch_screen_type }}">
            </div>
            <div class="form-group">
                <label>Độ phân giải:</label>
                <input type="text" class="form-control" name="watch_resolution" value="{{ 
                $details->watch_resolution }}">
            </div>
            <div class="form-group">
                <label>Thời lượng pin:</label>
                <input type="text" class="form-control" name="watch_battery_life"
                    value="{{ $details->watch_battery_life}}">
            </div>
            <div class="form-group">
                <label>Thời gian sạc:</label>
                <input type="text" class="form-control" name="watch_charging_time"
                    value="{{ $details->watch_charging_time }}">
            </div>
            <div class="form-group">
                <label>Cảm biến sức khỏe:</label>
                <input type="text" class="form-control" name="watch_health_sensors"
                    value="{{ $details->watch_health_sensors }}">
            </div>
            <div class="form-group">
                <label>Hỗ trợ GPS:</label>
                <input type="text" class="form-control" name="watch_gps" value="{{ $details->watch_gps }}">
            </div>
            <div class="form-group">
                <label> Chuẩn chống nước:</label>
                <input type="text" class="form-control" name="watch_waterproof_rating"
                    value="{{ $details->watch_waterproof_rating }}">
            </div>
            <div class="form-group">
                <label>Kết nối:</label>
                <input type="text" class="form-control" name="watch_connectivity"
                    value="{{ $details->watch_connectivity }}">
            </div>
            <div class="form-group">
                <label>Tương thích hệ điều hành:</label>
                <input type="text" class="form-control" name="watch_compatibility"
                    value="{{ $details-> watch_compatibility}}">
            </div>
            <div class="form-group">
                <label>Trọng lượng:</label>
                <input type="text" class="form-control" name="watch_weight" value="{{ $details->watch_weight }}">
            </div>
            <div class="form-group">
                <label>Chất liệu dây đeo:</label>
                <input type="text" class="form-control" name="watch_strap_material"
                    value="{{ $details->watch_strap_material }}">
            </div>

            <div class="form-group">
                <label>Mở khóa sinh trắc học:</label>
                <input type="text" class="form-control" name="watch_biometric_unlock"
                    value="{{ $details->watch_biometric_unlock }}">
            </div>
        </div>
        @endif
        @if ($products->categories_product_id == 4)


        <div class="">
            <h4>Tablet</h4>
            <div class="form-group">
                <label>Hệ điều hành :</label>
                <input type="text" class="form-control" name="tablet_operating_system"
                    value="{{ $details->tablet_operating_system }}">
            </div>
            <div class="form-group">
                <label>Kích thước màn hình:</label>
                <input type="text" class="form-control" name="tablet_screen_size"
                    value="{{ $details->tablet_screen_size }}">
            </div>
            <div class="form-group">
                <label>Loại màn hình:</label>
                <input type="text" class="form-control" name="tablet_screen_type"
                    value="{{ $details->tablet_screen_type }}">
            </div>
            <div class="form-group">
                <label>Độ phân giải:</label>
                <input type="text" class="form-control" name="tablet_resolution"
                    value="{{ $details->tablet_resolution }}">
            </div>
            <div class="form-group">
                <label>Tần số quét:</label>
                <input type="text" class="form-control" name="tablet_refresh_rate"
                    value="{{ $details->tablet_refresh_rate }}">
            </div>
            <div class="form-group">
                <label>CPU:</label>
                <input type="text" class="form-control" name="tablet_cpu" value="{{ $details->tablet_cpu }}">
            </div>
            <div class="form-group">
                <label>Ram:</label>
                <input type="text" class="form-control" name="tablet_ram" value="{{ $details->tablet_ram }}">
            </div>
            <div class="form-group">
                <label>Bộ nhớ trong:</label>
                <input type="text" class="form-control" name="tablet_storage" value="{{ $details->tablet_storage }}">
            </div>
            <div class="form-group">
                <label>Hỗ trợ thẻ nhớ:</label>
                <input type="text" class="form-control" name="tablet_expandable_storage"
                    value="{{  $details->tablet_expandable_storage}}">
            </div>
            <div class="form-group">
                <label>Dung lượng pin:</label>
                <input type="text" class="form-control" name="tablet_battery_capacity"
                    value="{{ $details->tablet_battery_capacity }}">
            </div>
            <div class="form-group">
                <label>Sạc nhanh:</label>
                <input type="text" class="form-control" name="tablet_fast_charging"
                    value="{{ $details->tablet_fast_charging }}">
            </div>
            <div class="form-group">
                <label>Camera sau:</label>
                <input type="text" class="form-control" name="tablet_camera_rear"
                    value="{{ $details->tablet_camera_rear }}">
            </div>
            <div class="form-group">
                <label>Camera trước:</label>
                <input type="text" class="form-control" name="tablet_camera_front"
                    value="{{ $details->tablet_camera_front }}">
            </div>
            <div class="form-group">
                <label>Loa:</label>
                <input type="text" class="form-control" name="tablet_speakers" value="{{ $details->tablet_speakers }}">
            </div>
            <div class="form-group">
                <label>Cổng sạc:</label>
                <input type="text" class="form-control" name="tablet_charging_port"
                    value="{{ $details->tablet_charging_port }}">
            </div>
            <div class="form-group">
                <label>Kết nối:</label>
                <input type="text" class="form-control" name="tablet_connectivity"
                    value="{{ $details->tablet_connectivity }}">
            </div>
            <div class="form-group">
                <label>Kích thước:</label>
                <input type="text" class="form-control" name="tablet_dimensions"
                    value="{{ $details->tablet_dimensions }}">
            </div>

            <div class="form-group">
                <label>Trọng lượng (kg):</label>
                <input type="text" class="form-control" name="tablet_weight" value="{{ $details->tablet_weight }}">
            </div>
            <div class="form-group">
                <label>Kháng nước:</label>
                <input type="text" class="form-control" name="tablet_water_resistance"
                    value="{{ $details->tablet_water_resistance }}">
            </div>
            <div class="form-group">
                <label>Hỗ trợ bút cảm ứng:</label>
                <input type="text" class="form-control" name="tablet_stylus_support"
                    value="{{ $details->tablet_stylus_support }}">
            </div>
            <div class="form-group">
                <label>Phụ kiện đi kèm:</label>
                <input type="text" class="form-control" name="tablet_accessories"
                    value="{{ $details->tablet_accessories }}">
            </div>
        </div>

    </div>
    @endif
    <div class="col-sm-3">
        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" class="form-control" name="product_image">
        </div>
    </div>



</form>


@endsection