@extends('layout')
@section('content')

<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ /</a>
    <a href="">{{$product_infor->brand->brand_name}} /</a>
    <a href="">{{ $product_infor->product_name}}</a>
</div>


<div class="boxReview ">
    <input type="hidden" value="{{ $product_infor->product_id }}" class="product_id">

    <div class="border-white">
        <div class="inforReview">
            <div class="inforReview-thumbnail">
                <img class="inforReview-thumbnail_img"
                    src="{{ URL::to('uploads/product/' . $product_infor->product_image) }}" alt="">
            </div>

            <div class="inforReview-boxReview row">
                <div class="boxReview-score col-lg-5 col-md-5 col-sm-12 col-12 ">
                    <span class="point"></span>
                    <div class="list-star">
                    </div>
                    <br>
                    <a href="" class="boxReview-score__count"></a>
                </div>
                <div class="boxReview-star col-lg-5 col-md-5 col-sm-12 col-12">
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
            </div>
        </div>
    </div>

    <div class="add-review-button">
        <button class="btn-add-review" onclick="openReviewPopup2()">Thêm đánh giá</button>
    </div>

    <div class="reviewAll" id="reviewAll">
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

        <div class="reviewAll-comment">

        </div>
    </div>
</div>


<div class="boxReview-popup" id="boxReview-popup">
    <div class="header_popup">
        <p>Đánh giá sản phẩm</p>
        <button class="close-popup" onclick="closeReviewPopup2()">X</button>
    </div>
    <div class="review-infor">
        <div class="img">
            <img src="{{ URL::to('uploads/product/' . $product_infor->product_image) }}" class="thumbnail-img-review">
        </div>
        <h6 class="infor-name">{{ $product_infor->product_name}}</h6>
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
            <textarea placeholder="Mời nhập cảm nhận về sản phẩm" class="custom-textarea form-control"
                data-input-value="review" id="review" style="height: 120px;"></textarea>
        </div>
        <div class="dcap"><button type="button" class="send-review"
                data-id_product="{{ $product_infor->product_id }}">Gửi đánh giá</button></div>
    </form>
</div>
</div>

@endsection