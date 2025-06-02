@extends('layout')
@section('content')
<div class="breadcrumbs">
    <a class="breadcrumb-item" href="{{ URL::to('/') }}">Trang chủ </a>
    <a href="">Điện thoại</a>
</div>

<div class="home-product">
    <div class="left-contaner">

        <div class="brand-relation">
            <b>Thương hiệu</b>
            @foreach ($relations as $brand_relate)
            <a href="">{{ $brand_relate->brand->brand_name }}</a>

            <label>
                <input type="checkbox" name="brand" value="{{$brand_relate->id_brand}}"
                    {{ in_array($brand_relate->id_brand, explode(',', request()->get('brand', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('brand', this)">
                {{ $brand_relate->brand->brand_name }}
            </label><br>
            @endforeach
        </div>
        <div class="filter-item">
            <b>Dung lượng ram</b><br>
            <label>
                <input type="checkbox" name="filter_mobile_ram" value="<4"
                    {{ in_array('<4', explode(',', request()->get('filter_mobile_ram', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_ram', this)">
                --Nhỏ hơn 4GB--
            </label><br>
            <label>
                <input type="checkbox" name="filter_mobile_ram" value="4gb_8gb"
                    {{ in_array('4gb_8gb', explode(',', request()->get('filter_mobile_ram', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_ram', this)">
                --4GB-8GB--
            </label>
            <br>
            <label>
                <input type="checkbox" name="filter_mobile_ram" value="8gb_12gb"
                    {{ in_array('8gb_12gb', explode(',', request()->get('filter_mobile_ram', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_ram', this)">
                --8GB-12GB--
            </label><br>
            <label>
                <input type="checkbox" name="filter_mobile_ram" value=">12gb"
                    {{ in_array('>12gb', explode(',', request()->get('filter_mobile_ram', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_ram', this)">
                -- lớn hơn 12GB--
            </label>
        </div>

        <div class="filter-item">
            <b>Bộ nhớ trong</b>
            <br>
            <label>
                <input type="checkbox" name="filter_mobile_stogare" value="128"
                    {{ in_array('128', explode(',', request()->get('filter_mobile_stogare', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_stogare', this)">
                128GB
            </label><br>
            <label>
                <input type="checkbox" name="filter_mobile_stogare" value="256"
                    {{ in_array('256', explode(',', request()->get('filter_mobile_stogare', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_stogare', this)">
                256GB
            </label>
            <br>
            <label>
                <input type="checkbox" name="filter_mobile_stogare" value="512"
                    {{ in_array('512', explode(',', request()->get('filter_mobile_stogare', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_stogare', this)">
                512GB
            </label>
        </div>

        <div class="filter-item">
            <b>Loại điện thoại</b>
            <br>

        </div>

        <div class="filter-item">
            <b>Tần số quét</b>
            <br>

            <label>
                <input type="checkbox" name="filter_refresh_rates" value="60-120hz"
                    {{ in_array('60-120hz', explode(',', request()->get('filter_refresh_rates', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_refresh_rates', this)">
                60-120hz
            </label><br>
            <label>
                <input type="checkbox" name="filter_refresh_rates" value="60hz"
                    {{ in_array('60hz', explode(',', request()->get('filter_refresh_rates', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_refresh_rates', this)">
                60hz
            </label><br>
            <label>
                <input type="checkbox" name="filter_refresh_rates" value="90hz"
                    {{ in_array('90hz', explode(',', request()->get('filter_refresh_rates', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_refresh_rates', this)">
                90hz
            </label><br>
            <label>
                <input type="checkbox" name="filter_refresh_rates" value="120hz"
                    {{ in_array('120hz', explode(',', request()->get('filter_refresh_rates', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_refresh_rates', this)">
                120hz
            </label><br>
            <label>
                <input type="checkbox" name="filter_refresh_rates" value="165hz"
                    {{ in_array('165hz', explode(',', request()->get('filter_refresh_rates', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_refresh_rates', this)">
                165hz
            </label><br>

        </div>


        <div class="filter-item">
            <b>Giá bán</b>
            <br>
            <label>
                <input type="checkbox" name="filter_price" value="1000000-5000000"
                    {{ in_array('1000000-5000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_price', this)">
                1 đến 5 triệu
            </label><br>
            <label>
                <input type="checkbox" name="filter_price" value="5000000-10000000"
                    {{ in_array('5000000-10000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_price', this)">
                5 đến 10 triệu
            </label><br>
            <label>
                <input type="checkbox" name="filter_price" value="10000000-15000000"
                    {{ in_array('10000000-19000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_price', this)">
                10 đến 15 triệu
            </label><br>
            <label>
                <input type="checkbox" name="filter_price" value="15000000-20000000"
                    {{ in_array('15000000-20000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_price', this)">
                15 đến 20 triệu
            </label><br>
            <label>
                <input type="checkbox" name="filter_refresh_rates" value="20000000-25000000"
                    {{ in_array('20000000-25000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_price', this)">
                29 đến 25 triệu
            </label><br>
            <label>
                <input type="checkbox" name="filter_price" value="25000000-30000000"
                    {{ in_array('25000000-30000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_price', this)">
                25 đến 30 triệu
            </label><br>
            <label>
                <input type="checkbox" name="filter_price" value=">30000000"
                    {{ in_array('>30000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_price', this)">
                Trên 30000000 triệu
            </label><br>

        </div>
    </div>
    <div class="body-content">
        <div class="sort">
            <label for="">sắp xếp</label>
            <select name="sort_by" id="sort_by" onchange="updateFilter('sort_by', this.value)">
                <option value="none" {{ request()->get('sort_by') == 'none' ? 'selected' : '' }}>--Sắp xếp--
                </option>
                <option value="tang_dan" {{ request()->get('sort_by') == 'tang_dan' ? 'selected' : '' }}>--
                    Giá tăng
                    dần--</option>
                <option value="giam_dan" {{ request()->get('sort_by') == 'giam_dan' ? 'selected' : '' }}>--
                    Giá giảm
                    dần--</option>
            </select>
        </div>
        <div class="row">

            @foreach ($phones as $phone )
            <div class="col-lg-3 col-md-3 col-sm-12 col-12" style="padding-bottom: 12px;">
                <div class="product-content">


                    <!-- Link đến trang chi tiết sản phẩm -->
                    <a class="link-product" href="{{ URL::to('/detail-product'.'/' . $phone->product_id) }}">
                        <div class="thumbnail-product-img">
                            <img class="home-product-img"
                                src="{{ URL::to('uploads/product/' . $phone->product_image) }}" alt="" />
                        </div>
                        <h5 class="productinfo__name">{{ $phone->product_name }}</h5>
                        <div class=" productinfo__price">
                            @if ($phone->old_price > 0)
                            <span class="productinfo__price-old">
                                {{ number_format($phone->old_price, 0, ',', '.') }}đ
                            </span>
                            @endif

                            <span class="productinfo__price-current">
                                {{ number_format($phone->sale_price, 0, ',', '.') }}đ
                            </span>

                        </div>
                        <div class=" productinfo__origin">
                            <span class="productinfo__origin-brand">{{$phone->brand_name}}</span>
                        </div>
                    </a>

                    @if ($phone->old_price > 0)
                    <div class="product__price--percent">
                        <p class="product__price--percent-detail">
                            @php
                            $percent_discount = (($phone->old_price - $phone->sale_price) / $phone->old_price)
                            *
                            100;
                            echo ceil($percent_discount) . '%'
                            @endphp
                        </p>
                    </div>
                    @endif
                    <!-- Nút thêm vào giỏ hàng -->
                    <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                        <!-- Input ẩn để lưu trữ thông tin sản phẩm -->
                        <input type="hidden" value="{{ $phone->product_id }}"
                            class="product_id_{{ $phone->product_id }}">
                        <input type="hidden" value="{{ $phone->product_name }}"
                            class="product_name_{{ $phone->product_id }}">
                        <input type="hidden" value="{{ $phone->product_image }}"
                            class="product_image_{{ $phone->product_id }}">
                        <input type="hidden" value="{{ $phone->sale_price }}"
                            class="product_price_{{ $phone->product_id }}">
                        <input type="hidden" value="{{ $phone->color }}" class="product_color_{{ $phone->product_id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $phone->product_id }}">
                        <div class="action-buttons">
                            <button type="button" class="add-to-cart" data-id_product="{{ $phone->product_id }}"
                                name="add-to-cart">
                                <img class="btn-cart" src="{{ URL::to('user/image/cart-btn.png' ) }}" alt="">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach



        </div>
    </div>
</div>

@endsection