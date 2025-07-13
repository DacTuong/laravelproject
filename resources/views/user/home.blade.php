@extends('layout')
@section('content')
<div class="content-main">
    <div class="banner-container">

        <div class="slider">
            <div id="carouselExampleIndicators" class="carousel slide pointer-event">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <svg aria-label="Placeholder: First slide" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" height="400" preserveAspectRatio="xMidYMid slice" role="img" width="800" xmlns="http://www.w3.org/2000/svg">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text>
                        </svg>
                    </div>
                    <div class="carousel-item">
                        <svg aria-label="Placeholder: Second slide" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" height="400" preserveAspectRatio="xMidYMid slice" role="img" width="800" xmlns="http://www.w3.org/2000/svg">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text>
                        </svg>
                    </div>
                    <div class="carousel-item">
                        <svg aria-label="Placeholder: Third slide" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" height="400" preserveAspectRatio="xMidYMid slice" role="img" width="800" xmlns="http://www.w3.org/2000/svg">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text>
                        </svg>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

    </div>

    <div class="home-product">
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
                @foreach ($products as $key => $product)
                <div class="col-lg-2 col-md-2 col-sm-6 col-6" style="padding-bottom: 12px;">
                    <div class="product-content">
                        <!-- Link đến trang chi tiết sản phẩm -->
                        <div class="thumbnail-product-img">
                            <img class="home-product-img" src="{{ URL::to('uploads/product/' . $product->product_image) }}" alt="" />
                        </div>
                        <h5 class="productinfo__name">
                            <a class="link-product" href="{{ URL::to('/' . $product->category->cate_slug . '/' . $product->product_name_slug) }}">{{ $product->product_name }}
                            </a>
                        </h5>
                        <div class="productinfo__price">
                            <span class="productinfo__price-current">
                                {{ number_format($product->sale_price, 0, ',', '.') }}đ
                            </span>
                            @if ($product->old_price > 0)
                            <div class="productinfo__price-discount">
                                <span class="productinfo__price-old">
                                    {{ number_format($product->old_price, 0, ',', '.') }}đ
                                </span>

                                <small class="product__discount--percent">
                                    @php
                                    $percent_discount =
                                    (($product->old_price - $product->sale_price) /
                                    $product->old_price) *
                                    100;
                                    echo -ceil($percent_discount) . '%';
                                    @endphp
                                </small>
                            </div>
                            @endif
                        </div>
                        <div class=" productinfo__origin">
                            <span class="productinfo__origin-brand">{{ $product->brand->brand_name }}</span>
                        </div>
                        <!-- Nút thêm vào giỏ hàng -->
                        <div class="action-buttons">
                            <form>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                                <!-- Input ẩn để lưu trữ thông tin sản phẩm -->
                                <input type="hidden" value="{{ $product->product_id }}" class="product_id_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_name }}" class="product_name_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->product_image }}" class="product_image_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->sale_price }}" class="product_price_{{ $product->product_id }}">
                                <input type="hidden" value="{{ $product->detail_phone->color ?? '' }}" class="product_color_{{ $product->product_id }}">
                                <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">
                                <button type="button" class="add-to-cart" data-id_product="{{ $product->product_id }}" name="add-to-cart">
                                    <i class="bi bi-cart"></i>
                                </button>

                                <button type="button" class="toggle-favorite" id="toggle-favorite" name="toggle-favorite" data-id_product="{{ $product->product_id }}">
                                    <div class="show-favorite" id="show-favorite">
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                </button>
                            </form>
                        </div>


                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

<div class="pagination">
    {{ $products->links('pagination::bootstrap-4') }}

</div>
@endsection