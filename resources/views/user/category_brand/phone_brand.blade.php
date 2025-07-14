@extends('layout')
@section('content')
<div class="breadcrumbs">
    <a class="breadcrumb-item" href="{{ URL::to('/') }}">Trang chủ</a>
    <span class="breadcrumb-separator"> > </span>
    <a href="{{ URL::to('/' . $cate->cate_slug) }}" class="breadcrumb-item"> {{ $cate->category_name }}</a>
    <span class="breadcrumb-separator"> > </span>
    <a href="{{ URL::to('/' . $cate->cate_slug . '/' . $currentBrand->brand_slug) }}"
        class="breadcrumb-item">{{ $currentBrand->brand_name }} </a>
</div>

<div class="home-product">

    <div class="left-container">
        <div class="brand-relation">
            <div>
                <b>Thương hiệu</b>
            </div>
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
            <b>Bộ nhớ trong</b>
            <br>

            @foreach ($storages as $sto)
            <label>
                <input type="checkbox" name="filter_mobile_storage" value="{{ $sto->storage }}"
                    {{ in_array($sto->storage, explode(',', request()->get('filter_mobile_storage', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_mobile_storage', this)">
                {{ $sto->storage }}GB
            </label><br>
            @endforeach


        </div>

        <div class="filter-item">
            <b>Tần số quét</b>
            <br>

            @foreach ($refresh_rates as $refresh)
            <label>
                <input type="checkbox" name="filter_refresh_rates" value="{{ $refresh->refresh_rate }}"
                    {{ in_array($refresh->refresh_rate, explode(',', request()->get('filter_refresh_rates', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_refresh_rates', this)">
                {{ $refresh->refresh_rate }}Hz
            </label><br>
            @endforeach

        </div>
        <div class="filter-item">
            <b>Ram</b>
            <br>

            @foreach ($rams as $ram)
            <label>
                <input type="checkbox" name="filter_ram" value="{{ $ram->ram }}"
                    {{ in_array($ram->ram, explode(',', request()->get('filter_ram', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('filter_ram', this)">
                {{ $ram->ram }}GB
            </label><br>
            @endforeach

        </div>

        <div class="filter-item">
            <b>Kết nối NFC</b>
            <br>
            @foreach ($connectNFCs as $nfc)
            <label>
                <input type="checkbox" name="ket-noi-nfc" value="{{ $nfc->NFC }}"
                    {{ in_array($nfc->NFC, explode(',', request()->get('ket-noi-nfc', ''))) ? 'checked' : '' }}
                    onchange="updateCheckboxFilter('ket-noi-nfc', this)">
                {{ $nfc->NFC }} <span>[{{ $nfc->total_nfc }}]</span>
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

            @foreach ($phones as $phone)
            <div class="col-lg-3 col-md-3 col-sm-6 col-6" style="padding-bottom: 12px;">
                <div class="product-content">
                    <!-- Link đến trang chi tiết sản phẩm -->
                    <a class="link-product"
                        href="{{ URL::to('/' . $phone->category->cate_slug . '/' . $phone->product_name_slug) }}">
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
                            <span class="productinfo__origin-brand">{{ $phone->brand_name }}</span>
                        </div>
                    </a>

                    @if ($phone->old_price > 0)
                    <div class="product__price--percent">
                        <p class="product__price--percent-detail">
                            @php
                            $percent_discount =
                            (($phone->old_price - $phone->sale_price) / $phone->old_price) * 100;
                            echo ceil($percent_discount) . '%';
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
                        <input type="hidden" value="{{ $phone->color }}"
                            class="product_color_{{ $phone->product_id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $phone->product_id }}">
                        <div class="action-buttons">
                            <button type="button" class="add-to-cart"
                                data-id_product="{{ $phone->product_id }}" name="add-to-cart">
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