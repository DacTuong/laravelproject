@extends('layout')
@section('content')
    <div class="content-main">
        <div class="banner-container">
            <div class="slider">
                @foreach ($banners as $banner)
                    <img src="{{ URL::to('uploads/slide/' . $banner->banner_image) }}" alt="">
                @endforeach

                <div class="btns-slider">
                    <button class="slide-pre">Trước</button>
                    <button class="slide-next">Sau</button>
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
                                    <img class="home-product-img"
                                        src="{{ URL::to('uploads/product/' . $product->product_image) }}" alt="" />
                                </div>
                                <h5 class="productinfo__name">
                                    <a class="link-product"
                                        href="{{ URL::to('/' . $product->category->cate_slug . '/' . $product->product_name_slug) }}">{{ $product->product_name }}
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
                                        <input type="hidden" value="{{ $product->product_id }}"
                                            class="product_id_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ $product->product_name }}"
                                            class="product_name_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ $product->product_image }}"
                                            class="product_image_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ $product->sale_price }}"
                                            class="product_price_{{ $product->product_id }}">
                                        <input type="hidden" value="{{ $product->detail_phone->color ?? '' }}"
                                            class="product_color_{{ $product->product_id }}">
                                        <input type="hidden" value="1"
                                            class="cart_product_qty_{{ $product->product_id }}">
                                        <button type="button" class="add-to-cart"
                                            data-id_product="{{ $product->product_id }}" name="add-to-cart">
                                            <i class="bi bi-cart"></i>
                                        </button>

                                        <button type="button" class="toggle-favorite" id="toggle-favorite"
                                            name="toggle-favorite" data-id_product="{{ $product->product_id }}">
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
