@extends('layout')
@section('content')
<div class="breadcrumbs">
    <a class="breadcrumb-item" href="{{ URL::to('/') }}">Trang chủ </a>
    <span class="breadcrumb-separator"> > </span>
    <a href="{{ URL::to('/' . $currentPath->cate_slug) }}" class="breadcrumb-item"> {{ $currentPath->category_name }}</a>
</div>

<div class="home-product">
    <div class="left-container">
        <div class="brand-relation">
            <b>Thương hiệu</b>
            <div class="slick-padding">

                <div class="v5-brand-list">
                    @foreach ($relations as $brand_relate)
                    <div title="{{ $brand_relate->brand->brand_name }}">
                        <a
                            href="{{ URL::to('/' . $brand_relate->cate->cate_slug . '/' . $brand_relate->brand->brand_slug) }}">
                            {{ $brand_relate->brand->brand_name }}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="filter-item">
            <b>Công nghệ màn hình</b>
            <br>
            @foreach ($screen_types as $screen_type)
            <label>
                <input type="checkbox" name="filter_watch_screen_type" value="{{ $screen_type->watch_screen_type }}"
                    {{ in_array($screen_type->watch_screen_type, explode(',', request()->get('filter_watch_screen_type', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_watch_screen_type', this)">
                {{ $screen_type->watch_screen_type }}
            </label><br>
            @endforeach

        </div>

        <div class="filter-item">
            <b>Thiết kế mặt đồng hồ</b>
            <br>
            @foreach ($face_designs as $face_design)
            <label>
                <input type="checkbox" name="filter_watch_face_design" value="{{ $face_design->watch_face_design }}"
                    {{ in_array($face_design->watch_face_design, explode(',', request()->get('filter_watch_face_design', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_watch_face_design', this)">
                {{ $face_design->watch_face_design }}
            </label><br>
            @endforeach
            <div class="filter-item">
                <b>Kích thước cổ tay</b>
                <br>
                @foreach ($wrist_sizes as $wrist_size)
                <label>
                    <input type="checkbox" name="filter_wrist_size_range"
                        value="{{ $wrist_size->wrist_size_range }}"
                        {{ in_array($wrist_size->wrist_size_range, explode(',', request()->get('filter_wrist_size_range', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_wrist_size_range', this)">
                    {{ $wrist_size->wrist_size_range }}
                </label><br>
                @endforeach
            </div>

            <div class="filter-item">
                <b>Chất liệu dây đeo</b>
                <br>

                @foreach ($strap_materials as $strap_material)
                <label>
                    <input type="checkbox" name="filter_watch_strap_material"
                        value="{{ $strap_material->watch_strap_material }}"
                        {{ in_array($strap_material->watch_strap_material, explode(',', request()->get('filter_watch_strap_material', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_watch_strap_material', this)">
                    {{ $strap_material->watch_strap_material }}
                </label><br>
                @endforeach
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
    </div>
    <!-- end left content -->

    <!-- start body content -->
    <div class="body-content">
        <div class="filter-tool">
            <div class="btn-filter d-lg-none">
                <button class="filter-toggle">
                    <i class="bi bi-filter-right"></i> Lọc
                </button>
            </div>
            <div>
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
        </div>
        <div class="row">


            @foreach ($watches as $watch)
            <div class="col-lg-3 col-md-3 col-sm-6 col-6" style="padding-bottom: 12px;">
                <div class="product-content">

                    <!-- Link đến trang chi tiết sản phẩm -->
                    <a class="link-product"
                        href="{{ URL::to('/' . $watch->category->cate_slug . '/' . $watch->product_name_slug) }}">
                        <div class="thumbnail-product-img">
                            <img class="home-product-img"
                                src="{{ URL::to('uploads/product/' . $watch->product_image) }}" alt="" />
                        </div>
                        <h5 class="productinfo__name">{{ $watch->product_name }}</h5>
                        <div class=" productinfo__price">
                            @if ($watch->old_price > 0)
                            <span class="productinfo__price-old">
                                {{ number_format($watch->old_price, 0, ',', '.') }}đ
                            </span>
                            @endif

                            <span class="productinfo__price-current">
                                {{ number_format($watch->sale_price, 0, ',', '.') }}đ
                            </span>

                        </div>
                        <div class=" productinfo__origin">
                            <span class="productinfo__origin-brand">{{ $watch->brand_name }}</span>
                        </div>
                    </a>

                    @if ($watch->old_price > 0)
                    <div class="product__price--percent">
                        <p class="product__price--percent-detail">
                            @php
                            $percent_discount =
                            (($watch->old_price - $watch->sale_price) / $watch->old_price) * 100;
                            echo ceil($percent_discount) . '%';
                            @endphp
                        </p>
                    </div>
                    @endif
                    <!-- Nút thêm vào giỏ hàng -->
                    <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                        <!-- Input ẩn để lưu trữ thông tin sản phẩm -->
                        <input type="hidden" value="{{ $watch->product_id }}"
                            class="product_id_{{ $watch->product_id }}">
                        <input type="hidden" value="{{ $watch->product_name }}"
                            class="product_name_{{ $watch->product_id }}">
                        <input type="hidden" value="{{ $watch->product_image }}"
                            class="product_image_{{ $watch->product_id }}">
                        <input type="hidden" value="{{ $watch->sale_price }}"
                            class="product_price_{{ $watch->product_id }}">
                        <input type="hidden" value="{{ $watch->color }}"
                            class="product_color_{{ $watch->product_id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $watch->product_id }}">
                        <div class="action-buttons">
                            <button type="button" class="add-to-cart"
                                data-id_product="{{ $watch->product_id }}" name="add-to-cart">
                                <img class="btn-cart" src="{{ URL::to('user/image/cart-btn.png') }}"
                                    alt="">
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