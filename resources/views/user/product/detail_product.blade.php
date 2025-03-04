@extends('layout')
@section('content')

<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ /</a>
    <a href="">{{$product_detail->brand->brand_name}} /</a>
    <a href="">{{ $product_detail->product_name}}</a>
</div>

<div class="product-detail row" style="margin: 0px; padding: 0px;">
    <!-- Product Item -->
    <div class="border-white">
        <h1>{{ $product_detail->product_name}}</h1>
    </div>
    <input type="hidden" value="{{ $product_detail->product_id }}" class="product_id">
    <div class="col-lg-7 col-md-6 col-sm-12">
        <div class="feature-img">
            <div class="box-thumbnail">
                <img id="image-target" src="{{ URL::to('uploads/product/' . $product_detail->product_image) }}"
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
                    <p>Sản phẩm sẽ được bảo hành và đổi mới trong vòng {{$product_detail->warranty_period}} tháng <a
                            href="">Xem chi tiết</a></p>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-5 col-md-6 col-sm-12">
        <div class="box-right">


            <div class="box-product-variants">
                <p class="product-code">Mã sản phẩm: {{$product_detail->product_code}}</p>
                <div class="storage">
                    @foreach ($varians as $varian )
                    <span class="option-version 
                    @if ($varian->varian_product == $product_detail->varian_product)
                    atc
                    @endif
                    " data-value="{{ $varian->varian_product }}">{{ $varian->varian_product }}</span>
                    @endforeach
                </div>
                <div class="color">
                    @foreach ($colors as $color )
                    <div class="color-item 
                    @if ($color->color == $product_detail->color)
                    atc
                    @endif
                    " data-id="{{ $color->product_id }}">
                        <span class="code-color"></span>
                        {{ $color->color }}
                    </div>
                    @endforeach
                </div>
                <strong>Giá bán:</strong>
                <span class="product-price">{{ number_format($product_detail->sale_price, 0, ',', '.') }}đ</span>
                <p>Loại điện thoại: {{$product_detail->category->category_name}}</p>
                <p>Thương hiệu: {{$product_detail->brand->brand_name}}</p>


            </div>


            <div class="block-button allowbuy">
                <form>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                    <input type="hidden" value="{{ $product_detail->product_id }}"
                        class="product_id_{{ $product_detail->product_id }}">
                    <input type="hidden" value="{{ $product_detail->product_name }}"
                        class="product_name_{{ $product_detail->product_id }}">
                    <input type="hidden" value="{{ $product_detail->product_image }}"
                        class="product_image_{{ $product_detail->product_id }}">
                    <input type="hidden" value="{{ $product_detail->sale_price }}"
                        class="product_price_{{ $product_detail->product_id }}">
                    <input type="hidden" value="{{ $product_detail->color }}"
                        class="product_color_{{ $product_detail->product_id }}">
                    <input type="hidden" value="1" class="cart_product_qty_{{ $product_detail->product_id }}">
                    <button type="button" class="add-to-cart" data-id_product="{{ $product_detail->product_id }}"
                        name="add-to-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Thêm giỏ hàng
                    </button>


                    <button type="button" class="toggle-favorite" id="toggle-favorite" name="toggle-favorite"
                        data-id_product="{{ $product_detail->product_id }}">
                        <div class="show-favorite" id="show-favorite">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                    </button>

                    <button type="button" class="buy-now" data-id_product="{{ $product_detail->product_id }}" name="">
                        Mua ngay
                    </button>
                </form>
            </div>

        </div>
    </div>
    <div class="similar-products row" style="margin-top: 10px; margin-bottom: 10px;">
        @foreach ($similars as $similar )
        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="product-content">
                <div class="thumbnail-product-img">
                    <img class="home-product-img" src="{{ URL::to('uploads/product/' . $similar->product_image) }}"
                        alt="" />
                </div>
                <h5> <a class="link-product"
                        href="{{ URL::to('/detail-product'.'/' . $similar->product_id) }}">{{$similar->product_name}}
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
                        <input type="hidden" value="{{ $similar->color }}"
                            class="product_color_{{ $similar->product_id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $similar->product_id }}">
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
        <div class="col-sm-8">
            <div class="block-review">
                <h2>Đánh giá và nhận xét sản phẩm</h2>
                <div class="boxReview-review">
                    <div class="boxReview-score">
                        <span class="point"></span>
                        <div class="list-star">
                        </div>
                        <br>
                        <a href="{{URL::to('/review-product'.'/'.$product_detail->product_id)}}"
                            class="boxReview-score__count">

                        </a>
                    </div>
                    <div class="boxReview-star">
                        <div class="rating-level" data-rating_level="5">
                            <div class="star-count">
                                5 <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- <progress class="progress" role="progressbar" max="100" value="20"></progress> -->
                            <span class="rating-count"> </span>
                        </div>
                        <div class="rating-level" data-rating_level="4">
                            <div class="star-count">
                                4 <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- <progress class="progress" role="progressbar" max="100" value="20"></progress> -->
                            <span class="rating-count"> </span>
                        </div>
                        <div class="rating-level" data-rating_level="3">
                            <div class="star-count">
                                3 <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- <progress class="progress" role="progressbar" max="100" value="20"></progress> -->
                            <span class="rating-count"> </span>
                        </div>
                        <div class="rating-level" data-rating_level="2">
                            <div class="star-count">
                                2 <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- <progress class="progress" role="progressbar" max="100" value="20"></progress> -->
                            <span class="rating-count"></span>
                        </div>
                        <div class="rating-level" data-rating_level="1">
                            <div class="star-count">
                                1 <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="  background-color: #f59e0b;"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <!-- <progress class="progress" role="progressbar" max="100" value="20"></progress> -->
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
                                <img src="{{ URL::to('uploads/product/' . $product_detail->product_image) }}"
                                    class="thumbnail-img-review">
                            </div>
                            <h6 class="infor-name">{{ $product_detail->product_name}}</h6>
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
                                <label for="review" data-check-value="review" style="display: none; color: red;">Vui
                                    lòng nhập cảm nhận!</label>
                                <textarea placeholder="Mời nhập cảm nhận về sản phẩm"
                                    class="custom-textarea form-control" data-input-value="review" id="review"
                                    style="height: 120px;"></textarea>
                            </div>

                            <div class="dcap"><button type="button" class="send-review"
                                    data-id_product="{{ $product_detail->product_id }}">Gửi đánh giá</button></div>
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
                    href="{{URL::to('/review-product'.'/'.$product_detail->product_id)}}">
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
                            <textarea name="comment-text" placeholder="Xin mời để lại bình luận" class="comment-text"
                                id="comment-text"></textarea>
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

        <div class="col-sm-4 custom-class">
            <h2 class="tab-title">Thông số kỹ thuật</h2>
            <div class="specifications">
                <div class="specification-item">
                    <div class="box-specifi">
                        <h6>Màn hình & Camera</h6>
                        <ul class="text-specifi active">
                            <li>
                                <aside><strong>Công nghệ màn hình</strong></aside>
                                <aside>
                                    <span>{{$product_detail->screen_type}}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Độ phân giải</strong></aside>
                                <aside>
                                    <span>{{$product_detail->resolution}}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Màn hình rộng</strong></aside>
                                <aside>
                                    <span>{{$product_detail->screen_size}}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Tần số quét</strong></aside>
                                <aside>
                                    <span>{{$product_detail->refresh_rate}} hz</span>
                                </aside>
                            </li>

                            <li>
                                <aside><strong>Độ phân giải camera sau</strong></aside>
                                <aside>
                                    <span>{{$product_detail->camera_main}}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Tính năng camera sau</strong></aside>
                                <aside>
                                    <span>{{$product_detail->camera_main_features}}</span>
                                </aside>
                            </li>

                            <li>
                                <aside><strong>Độ phân giải camera trước</strong></aside>
                                <aside>
                                    <span>{{$product_detail->camera_front}}</span>
                                </aside>
                            </li>
                            <li>
                                <aside><strong>Tính năng camera trước</strong></aside>
                                <aside>
                                    <span>{{$product_detail->camera_front_features}}</span>
                                </aside>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="specifications-container">
                    <button class="specifications-btn" onclick="openSpecifications()"> Xem thêm</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="specifications-popup" id="specifications-popup">
    <div class="specifications-popup-header">
        <h6 class="tab-title">Thông số kỹ thuật</h6>
        <button class="close-specifications" onclick="closeSpecifications()">X</button>
    </div>
    <div class="specifications-popup-content">
        <div class="box-specifi">
            <h6>Màn hình & Camera</h6>
            <ul class="text-specifi active">
                <li>
                    <aside><strong>Công nghệ màn hình</strong></aside>
                    <aside>
                        <span>{{$product_detail->screen_type}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Độ phân giải</strong></aside>
                    <aside>
                        <span>{{$product_detail->resolution}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Màn hình rộng</strong></aside>
                    <aside>
                        <span>{{$product_detail->screen_size}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Tần số quét</strong></aside>
                    <aside>
                        <span>{{$product_detail->refresh_rate}} hz</span>
                    </aside>
                </li>

                <li>
                    <aside><strong>Độ phân giải camera sau</strong></aside>
                    <aside>
                        <span>{{$product_detail->camera_main}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Tính năng camera sau</strong></aside>
                    <aside>
                        <span>{{$product_detail->camera_main_features}}</span>
                    </aside>
                </li>

                <li>
                    <aside><strong>Độ phân giải camera trước</strong></aside>
                    <aside>
                        <span>{{$product_detail->camera_front}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Tính năng camera trước</strong></aside>
                    <aside>
                        <span>{{$product_detail->camera_front_features}}</span>
                    </aside>
                </li>
            </ul>
        </div>

        <div class="box-specifi">
            <a href="#" class="toggle-btn">Cấu hình & bộ nhớ</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Hệ điều hành</strong></aside>
                    <aside>
                        <span>{{$product_detail->operating_system}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Chip xữ lý (CPU)</strong></aside>
                    <aside>
                        <span>{{$product_detail->cpu}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Chip đồ họa (GPU)</strong></aside>
                    <aside>
                        <span>{{$product_detail->gpu}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>ram</strong></aside>
                    <aside>
                        <span>{{$product_detail->ram}} GB</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Bộ nhớ trong</strong></aside>
                    <aside>
                        <span>{{$product_detail->storage}} GB</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Hỗ trợ thể nhớ</strong></aside>
                    <aside>
                        <span>
                            @if ($product_detail->expandable_storage == false)
                            Không hổ trợ thẻ nhớ
                            @else
                            Có hổ trợ thẻ nhớ
                            @endif
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
                        <span>{{$product_detail->battery_capacity}} mAh</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Hỗ trợ sạc nhanh</strong></aside>
                    <aside>
                        <span>
                            @if ($product_detail->fast_charging == true)
                            Có hỗ trợ sạc nhanh
                            @else
                            Không hỗ trợ sạc nhanh
                            @endif
                        </span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Sạc không dây</strong></aside>
                    <aside>
                        <span>
                            @if ($product_detail->wireless_charging == true)
                            Có hỗ trợ sạc không dây
                            @else
                            Không hỗ trợ sạc không dây
                            @endif
                        </span>
                    </aside>
                </li>
            </ul>
        </div>

        <div class="box-specifi">
            <a href="#" class="toggle-btn">Tính năng</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Chống nước</strong></aside>
                    <aside>
                        <span>{{$product_detail->water_resistance}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Bảo mật</strong></aside>
                    <aside>
                        <span>{{$product_detail->biometrics}}</span>
                    </aside>
                </li>
            </ul>
        </div>

        <div class="box-specifi">
            <a href="#" class="toggle-btn">Kết nối</a>
            <ul class="text-specifi">
                <li>
                    <aside><strong>Loại sim</strong></aside>
                    <aside>
                        <span>{{$product_detail->sim_type}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Kết nối</strong></aside>
                    <aside>
                        <span>{{$product_detail->connectivity}}</span>
                    </aside>
                </li>
                <li>
                    <aside><strong>Wifi</strong></aside>
                    <aside>
                        <span>{{$product_detail->wifi_technology}}</span>
                    </aside>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection