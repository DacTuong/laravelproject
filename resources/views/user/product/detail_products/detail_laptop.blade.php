@extends('layout')
@section('content')
<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ /</a>
    <a href="">{{ $product->brand->brand_name }} /</a>
    <a href="">{{ $product->product_name }}</a>
</div>

<div class="product-detail row" style="margin: 0px; padding: 0px;">
    <!-- Product Item -->
    <div class="border-white">
        <h1>{{ $product->product_name }}</h1>
    </div>
    <input type="hidden" value="{{ $product->product_id }}" class="product_id">
    <div class="col-lg-7 col-md-6 col-sm-12">
        <div class="feature-img">
            <div class="box-thumbnail">
                <img id="image-target" src="{{ URL::to('uploads/product/' . $product->product_image) }}"
                    class="box-thumbnail-img">
                <div class="mirror"></div>
            </div>

        </div>


        <div class="policy">
            <b>Chính sách của shop</b>
            <ul class="policy__list">
                <li>
                    <div class="icon1">
                        <i class="icondetail-doimoi"></i>
                    </div>
                    <p>Sản phẩm sẽ được bảo hành và đổi mới trong vòng {{ $product->warranty_period }} tháng <a
                            href="">Xem chi tiết</a></p>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-5 col-md-6 col-sm-12">
        <div class="box-right">
            <div class="box-product-variants">
                <p class="product-code">Mã sản phẩm: {{ $product->product_code }}</p>
                @if ($varians->isNotEmpty())
                <div class="box-product-option version">
                    <strong class="label">Lựa chọn phiên bản</strong>
                    <div class="list-option" id="option-version">
                        @foreach ($varians as $varian)
                        @php
                        $isActVarian =
                        $varian->varian_product == $product->varian_product ? 'selected' : '';
                        @endphp
                        <div class="item-option {{ $isActVarian }}">
                            <a
                                href="{{ URL::to('/' . $varian->category->cate_slug . '/' . $varian->product_name_slug) }}">
                                <span>{{ $varian->varian_product }}</span>
                                <p>{{ number_format($varian->sale_price, 0, ',', '.') }} ₫</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="box-product-option color">
                    <strong>Lựa chọn màu sắc</strong>
                    <div class="list-option" id="option-color">
                        @foreach ($colors as $color)
                        @php
                        $isActColor =
                        $color->detail_laptop->laptop_color == $product->detail_laptop->laptop_color
                        ? 'selected'
                        : '';
                        @endphp
                        <div class="item-option btn-active {{ $isActColor }}"
                            data-id="{{ $color->product_id }}">
                            <span class="code-color"></span>
                            {{ $color->detail_laptop->laptop_color }}
                        </div>
                        @endforeach
                    </div>
                </div>
                <strong>Giá bán:</strong>
                <span class="product-price">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
                <p>Loại điện thoại: {{ $product->category->category_name }}</p>
                <p>Thương hiệu: {{ $product->brand->brand_name }}</p>
            </div>


            <div class="block-button allowbuy">
                <form>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                    <input type="hidden" value="{{ $product->product_id }}"
                        class="product_id_{{ $product->product_id }}">
                    <input type="hidden" value="{{ $product->product_name }}"
                        class="product_name_{{ $product->product_id }}">
                    <input type="hidden" value="{{ $product->product_image }}"
                        class="product_image_{{ $product->product_id }}">
                    <input type="hidden" value="{{ $product->sale_price }}"
                        class="product_price_{{ $product->product_id }}">
                    <input type="hidden" value="{{ $product->detail_laptop->color }}"
                        class="product_color_{{ $product->product_id }}">
                    <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">
                    <button type="button" class="add-to-cart" data-id_product="{{ $product->product_id }}"
                        name="add-to-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Thêm giỏ hàng
                    </button>
                    <button type="button" class="buy-now" data-id_product="{{ $product->product_id }}" name="">
                        Mua ngay
                    </button>
                    <button type="button" class="toggle-favorite" id="toggle-favorite" name="toggle-favorite"
                        data-id_product="{{ $product->product_id }}">
                        <div class="show-favorite" id="show-favorite">
                            <i class="bi bi-heart"></i>
                        </div>
                    </button>
                </form>
            </div>

        </div>
    </div>
    <div class="similar-products row" style="margin-top: 10px; margin-bottom: 10px;">
        @foreach ($similars as $similar)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="product-content">
                <div class="thumbnail-product-img">
                    <img class="home-product-img" src="{{ URL::to('uploads/product/' . $similar->product_image) }}"
                        alt="" />
                </div>
                <h5> <a class="link-product"
                        href="{{ URL::to('/detail-product' . '/' . $similar->product_id) }}">{{ $similar->product_name }}
                    </a></h5>
                @if ($similar->old_price > 0)
                <span class="productinfo__price-old">
                    {{ number_format($similar->old_price, 0, ',', '.') }}đ
                </span>
                @endif
                <span class="productinfo__price-current">
                    {{ number_format($similar->sale_price, 0, ',', '.') }}đ
                </span>
                <div class="action-buttons">
                    <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                        <!-- Input ẩn để lưu trữ thông tin sản phẩm -->
                        <input type="hidden" value="{{ $similar->product_id }}"
                            class="product_id_{{ $similar->product_id }}">
                        <input type="hidden" value="{{ $similar->product_name }}"
                            class="product_name_{{ $similar->product_id }}">
                        <input type="hidden" value="{{ $similar->product_image }}"
                            class="product_image_{{ $similar->product_id }}">
                        <input type="hidden" value="{{ $similar->sale_price }}"
                            class="product_price_{{ $similar->product_id }}">
                        <input type="hidden" value="{{ $similar->detail_laptop->color }}"
                            class="product_color_{{ $similar->product_id }}">
                        <input type="hidden" value="1"
                            class="cart_product_qty_{{ $similar->product_id }}">
                        <button type="button" class="add-to-cart" data-id_product="{{ $similar->product_id }}"
                            name="add-to-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>

                    </form>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    <div class="block-content-product row">
        <div class="col-sm-7">
            <div class="block-review">
                <h2>Đánh giá và nhận xét sản phẩm</h2>
                <div class="boxReview-review">
                    <div class="boxReview-score">
                        <span class="point"></span>
                        <div class="list-star">
                        </div>
                        <br>
                        <a href="{{ URL::to('/review-product' . '/' . $product->product_id) }}"
                            class="boxReview-score__count">

                        </a>
                    </div>
                    <div class="boxReview-star">
                        <div class="rating-level" data-rating_level="5">
                            <div class="star-count">
                                5 <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <span class="rating-count"> </span>
                        </div>
                        <div class="rating-level" data-rating_level="4">
                            <div class="star-count">
                                4 <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <span class="rating-count"> </span>
                        </div>
                        <div class="rating-level" data-rating_level="3">
                            <div class="star-count">
                                3 <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <span class="rating-count"> </span>
                        </div>
                        <div class="rating-level" data-rating_level="2">
                            <div class="star-count">
                                2 <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <span class="rating-count"></span>
                        </div>
                        <div class="rating-level" data-rating_level="1">
                            <div class="star-count">
                                1 <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>

                            <span class="rating-count"> </span>
                        </div>
                    </div> <!-- kết thúc thẻ div đánh giá sao và hiện sao sản phẩm -->
                    <div class="review-form-popup" id="review-form-popup">
                        <div class="header_popup">
                            <p>Đánh giá sản phẩm</p>
                            <button type="button" class="close-popup" onclick="closeReviewPopup()">X</button>
                        </div>
                        <div class="review-infor">
                            <div class="img">
                                <img src="{{ URL::to('uploads/product/' . $product->product_image) }}"
                                    class="thumbnail-img-review">
                            </div>
                            <h6 class="infor-name">{{ $product->product_name }}</h6>
                        </div>
                        <span for="" class="check-star-point" style="display: none; color: red;">
                            Vui lòng đánh giá!
                        </span>
                        <ul class="rating-topzonecr-star">
                            <li data-rating="1">
                                <i class="fa-regular fa-star"></i>
                            </li>
                            <li data-rating="2">
                                <i class="fa-regular fa-star"></i>
                            </li>
                            <li data-rating="3">
                                <i class="fa-regular fa-star"></i>
                            </li>
                            <li data-rating="4">
                                <i class="fa-regular fa-star"></i>
                            </li>
                            <li data-rating="5">
                                <i class="fa-regular fa-star"></i>
                            </li>
                        </ul>

                        <form class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>

                            <div class="text-review">
                                <label for="review" data-check-value="review"
                                    style="display: none; color: red;">
                                    Vui lòng nhập cảm nhận!
                                </label>
                                <textarea placeholder="Mời nhập cảm nhận về sản phẩm" class="custom-textarea form-control" data-input-value="review"
                                    id="review" style="height: 120px;"></textarea>
                            </div>

                            <div class="dcap"><button type="button" class="send-review"
                                    data-id_product="{{ $product->product_id }}">Gửi đánh giá</button></div>
                        </form>
                    </div>
                </div>
                <div class="add-review-button">
                    <button class="btn-add-review" onclick="openReviewPopup()">Thêm đánh giá</button>
                </div>
                <div class="box-review-filter">
                    <div class="title-filter">Lọc theo</div>
                    <div class="filter-star-container">
                        <div class="filter-star-item active" data-rating_filter_review="0">
                            Tất cả
                        </div>
                        <div class="filter-star-item" data-rating_filter_review="5">
                            <span class="">5</span>
                            <span class="star-icon-filter"><i class="fa-solid fa-star"></i></span>
                        </div>
                        <div class="filter-star-item " data-rating_filter_review="4">
                            <span class="">4</span>
                            <span class="star-icon-filter"><i class="fa-solid fa-star"></i></span>
                        </div>
                        <div class="filter-star-item " data-rating_filter_review="3">
                            <span class="">3</span>
                            <span class="star-icon-filter"><i class="fa-solid fa-star"></i></span>
                        </div>
                        <div class="filter-star-item " data-rating_filter_review="2">
                            <span class="">2</span>
                            <span class="star-icon-filter"><i class="fa-solid fa-star"></i></span>
                        </div>
                        <div class="filter-star-item" data-rating_filter_review="1">
                            <span class="">1</span>
                            <span class="star-icon-filter"><i class="fa-solid fa-star"></i></span>
                        </div>
                    </div>

                </div>

                <div class="boxReview-comment">
                </div>
                <a class="button__view-more-review"
                    href="{{ URL::to('/review-product' . '/' . $product->product_id) }}">
                    Xem thêm
                </a>
            </div>


            <div class="box-comments">
                <h2 class="boxcomment__title">
                    Bình luận
                </h2>
                <div class="comment-box">
                    <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                        <div class="textarea-cmt">
                            <textarea name="comment-text" placeholder="Xin mời để lại bình luận" class="comment-text" id="comment-text"></textarea>
                            <button type="button" class="add-comment-btn"><i class="fa-solid fa-paper-plane"></i>
                                Gửi</button>
                        </div>
                    </form>
                </div>

                <div class="box-comments-item" id="box-comments-item">
                    <!-- Comment content will be dynamically inserted here -->
                </div>
            </div>
        </div>

        <div class="col-sm-5 custom-class">
            <h2 class="tab-title">Thông số kỹ thuật</h2>
            <div class="specifications">
                <div class="specification-item">
                    <div class="box-specifi">
                        <ul class="text-specifi active">
                            <li>
                                <aside><strong>Công nghệ màn hình</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_display_technology }}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Độ phân giải</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_display_resolution }}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Kích thước màn hình</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_display_size }}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Tần số quét</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_display_refresh_rate }}</span>
                                </aside>
                            </li>

                            <li>
                                <aside><strong>Loại ổ cứng</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_storage_type }}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Hệ điều hành</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_operating_system }}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Ổ cứng mặc định</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_storage }}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Cart on-board</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_gpu_integrated }}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Cart đồ họa rời</strong></aside>
                                <aside>
                                    <span>{{ $product->detail_laptop->laptop_gpu_dedicated }}</span>
                                </aside>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="specifications-container">
                    <button class="specifications-btn">Xem thêm</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="specifications-popup" id="specifications-popup">
    <div class="specifications-popup-header">
        <h6 class="tab-title">Thông số kỹ thuật</h6>
        <button class="close-specifications">X</button>
    </div>
    <div class="specifications-popup-content">

        <div class="box-specifi">
            <a href="#" class="toggle-btn">Bộ vi xữ lý</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Công nghệ cpu</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_cpu }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Số hiệu cpu</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_cpu_model }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Số nhân</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_cpu_core }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Số luồng</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_cpu_threads }}
                        </span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Bộ nhớ đệm</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_cpu_cache }}
                        </span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Xung nhịp cơ bản</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_cpu_base_clock }}GHz
                        </span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Xung nhịp tối đa</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_cpu_max_clock }} GHz
                        </span>
                    </aside>
                </li>
            </ul>
        </div>


        <div class="box-specifi">
            <a href="#" class="toggle-btn">Đồ họa & âm thanh</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Card On-board</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_gpu_integrated }} mAh</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Card đồ họa rời</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_gpu_dedicated }}
                        </span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Công nghệ âm thanh</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_audio_technology }}
                        </span>
                    </aside>
                </li>
            </ul>
        </div>
        <div class="box-specifi">
            <h6>Màn hình</h6>
            <ul class="text-specifi active">
                <li>
                    <aside><strong>Số lượng màn hình</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_quantity }}</span>
                    </aside>
                </li>

                <li>
                    <aside><strong>Chuẩn màn hình</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_panel_type }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Độ phân giải</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_resolution }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Kích thước màn hình</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_size }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Tần số quét</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_refresh_rate }}</span>
                    </aside>
                </li>

                <li>
                    <aside><strong>Kiểu hiển thị màn hình</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_type }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Loại tấm nền</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_panel_type }}</span>
                    </aside>
                </li>

                <li>
                    <aside><strong>Công nghệ màn hình</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_display_technology }}</span>
                    </aside>
                </li>


            </ul>
        </div>

        <div class="box-specifi">
            <a href="#" class="toggle-btn">Bộ nhớ ram, Ổ cứng</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>RAM</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_ram }} GB</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Loại RAM</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_ram_type }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Tốc độ bus</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_ram_speed }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Khả năng nâng cấp ram</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_ram_upgrade_slots }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Ổ cứng mặc định</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_storage }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Khả năng nâng cấp ổ cứng</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_expandable_storage }}</span>
                    </aside>
                </li>

            </ul>
        </div>
        <div class="box-specifi">
            <a href="#" class="toggle-btn">Bàn phím & Touchpad</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>bàn phím</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_keyboard_type }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Đèn nền bàn phím</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_keyboard_backlight }}
                        </span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Chuột/Touctpad</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_touchpad_type }}
                        </span>
                    </aside>
                </li>
            </ul>
        </div>

        <div class="box-specifi">
            <a href="#" class="toggle-btn">Cổng kết nối & tính năng mở rộng</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Cổng kết nối</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_port_type }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Kết nối không dây</strong></aside>
                    <aside>
                        <span>
                            {{ $product->detail_laptop->laptop_connectivity }}
                        </span>
                    </aside>
                </li>

            </ul>
        </div>



        <div class="box-specifi">
            <a href="#" class="toggle-btn">Pin & sạc</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Dung lượng pin</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_battery_capacity }} mAh</span>
                    </aside>
                </li>

            </ul>
        </div>

        <div class="box-specifi">
            <a href="#" class="toggle-btn">Kích thước & trọng lượng</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Kích thước</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_dimensions }}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Trọng lượng</strong></aside>
                    <aside>
                        <span>{{ $product->detail_laptop->laptop_weight }}</span>
                    </aside>
                </li>

            </ul>
        </div>



    </div>
</div>
@endsection