@extends('layout')
@section('content')
<div class="row">
    <!-- Product Item -->
    <?php $search_count = $search_product->count();
    if ($search_count > 0) { ?>

        @foreach ($search_product as $key => $product )
        <div class="col-lg-3 col-md-3 col-sm-12 col-12" style="padding-bottom: 12px;">
            <div class="product-content">
                <!-- Link đến trang chi tiết sản phẩm -->
                <div class="thumbnail-product-img">
                    <img class="home-product-img" src="{{ URL::to('uploads/product/' . $product->product_image) }}"
                        alt="" />
                </div>
                <h5 class="productinfo__name">
                    <a class="link-product"
                        href="{{ URL::to('/detail-product'.'/' . $product->product_id) }}">{{ $product->product_name }}
                    </a>
                </h5>
                <div class="productinfo__price">
                    @if ($product->old_price > 0)
                    <span class="productinfo__price-old">
                        {{ number_format($product->old_price, 0, ',', '.') }}đ
                    </span>
                    @endif
                    @if ($product->old_price > 0)
                    <div class="product__price--percent">
                        <p class="product__price--percent-detail">
                            @php
                            $percent_discount = (($product->old_price - $product->sale_price) /
                            $product->old_price)
                            *
                            100;
                            echo ceil($percent_discount) . '%'
                            @endphp
                        </p>
                    </div>
                    @endif
                    <span class="productinfo__price-current">
                        {{ number_format($product->sale_price, 0, ',', '.') }}đ
                    </span>

                </div>
                <div class=" productinfo__origin">
                    <span class="productinfo__origin-brand">{{$product->brand->brand_name}}</span>
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
                        <input type="hidden" value="{{ $product->color }}" class="product_color_{{ $product->product_id }}">
                        <input type="hidden" value="1" class="cart_product_qty_{{ $product->product_id }}">
                        <button type="button" class="add-to-cart" data-id_product="{{ $product->product_id }}"
                            name="add-to-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
                </div>


            </div>
        </div>
        @endforeach
    <?php } else { ?>
        <div class="col-sm-12">
            <h1>
                Không có sản phẩm
            </h1>
            <img class="no-product" src="{{ URL::to('public/users/images/no-product.png') }}" alt="">
        </div>
    <?php } ?>
</div>
@endsection