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
                <b>Thương hiệu</b>
                <div class="slick-padding">
                    <div class="v5-brand-list">
                        @foreach ($relations as $brand_relate)
                            <div>
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

                @foreach ($tablet_storages as $tablet_storage)
                    <label>
                        <input type="checkbox" name="filter_tablet_storage" value="{{ $tablet_storage->tablet_storage }}"
                            {{ in_array($tablet_storage->tablet_storage, explode(',', request()->get('filter_tablet_storage', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_tablet_storage', this)">
                        {{ $tablet_storage->tablet_storage }}
                    </label><br>
                @endforeach

            </div>

            <div class="filter-item">
                <b>Kích thước màn hình</b>
                <br>

                @foreach ($tablet_screensizes as $tablet_screensize)
                    <label>
                        <input type="checkbox" name="filter_tablet_screen_size"
                            value="{{ $tablet_screensize->tablet_screen_size }}"
                            {{ in_array($tablet_screensize->tablet_screen_size, explode(',', request()->get('filter_tablet_screen_size', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_tablet_screen_size', this)">
                        {{ $tablet_screensize->tablet_screen_size }}
                    </label><br>
                @endforeach
            </div>
            <div class="filter-item">
                <b>Tần số quét</b>
                <br>
                @foreach ($tablet_refreshs as $tablet_refresh)
                    <label>
                        <input type="checkbox" name="filter_tablet_refresh_rates"
                            value="{{ $tablet_refresh->tablet_refresh_rate }}"
                            {{ in_array($tablet_refresh->tablet_refresh_rate, explode(',', request()->get('filter_tablet_refresh_rates', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_tablet_refresh_rates', this)">
                        {{ $tablet_refresh->tablet_refresh_rate }}
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
                @foreach ($tablets as $tablet)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" style="padding-bottom: 12px;">
                        <div class="product-content">


                            <!-- Link đến trang chi tiết sản phẩm -->
                            <a class="link-product"
                                href="{{ URL::to('/' . $tablet->category->cate_slug . '/' . $tablet->product_name_slug) }}">
                                <div class="thumbnail-product-img">
                                    <img class="home-product-img"
                                        src="{{ URL::to('uploads/product/' . $tablet->product_image) }}" alt="" />
                                </div>
                                <h5 class="productinfo__name">{{ $tablet->product_name }}</h5>
                                <div class=" productinfo__price">
                                    @if ($tablet->old_price > 0)
                                        <span class="productinfo__price-old">
                                            {{ number_format($tablet->old_price, 0, ',', '.') }}đ
                                        </span>
                                    @endif

                                    <span class="productinfo__price-current">
                                        {{ number_format($tablet->sale_price, 0, ',', '.') }}đ
                                    </span>

                                </div>
                                <div class=" productinfo__origin">
                                    <span class="productinfo__origin-brand">{{ $tablet->brand_name }}</span>
                                </div>
                            </a>

                            @if ($tablet->old_price > 0)
                                <div class="product__price--percent">
                                    <p class="product__price--percent-detail">
                                        @php
                                            $percent_discount =
                                                (($tablet->old_price - $tablet->sale_price) / $tablet->old_price) * 100;
                                            echo ceil($percent_discount) . '%';
                                        @endphp
                                    </p>
                                </div>
                            @endif
                            <!-- Nút thêm vào giỏ hàng -->
                            <form>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                                <!-- Input ẩn để lưu trữ thông tin sản phẩm -->
                                <input type="hidden" value="{{ $tablet->product_id }}"
                                    class="product_id_{{ $tablet->product_id }}">
                                <input type="hidden" value="{{ $tablet->product_name }}"
                                    class="product_name_{{ $tablet->product_id }}">
                                <input type="hidden" value="{{ $tablet->product_image }}"
                                    class="product_image_{{ $tablet->product_id }}">
                                <input type="hidden" value="{{ $tablet->sale_price }}"
                                    class="product_price_{{ $tablet->product_id }}">
                                <input type="hidden" value="{{ $tablet->color }}"
                                    class="product_color_{{ $tablet->product_id }}">
                                <input type="hidden" value="1" class="cart_product_qty_{{ $tablet->product_id }}">
                                <div class="action-buttons">
                                    <button type="button" class="add-to-cart"
                                        data-id_product="{{ $tablet->product_id }}" name="add-to-cart">
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
