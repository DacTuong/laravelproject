@extends('layout')
@section('content')
<?php

use Illuminate\Support\Facades\Session;

$cart = Session::get('cart');
$total_price = Session::get('total_price');
$coupon_session = Session::get('coupon');

?>

<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ /</a>
    <a href="{{URL::to('/cart')}}">Giỏ hàng /</a>
    <a href="{{ URL::to('/checkout') }}">Thanh toán</a>
</div>


<div class="row">
    <div class="col-sm-7">
        <div class="check-out">
            <form class="form-group">
                @csrf
                <div class="mb-3 row">
                    <div class="col-md-6 mb-3">
                        <input class="form-control" type="text" data-input-value="fullname" name="fullname"
                            id="fullname" placeholder="Họ và tên">
                        <label for="" data-check-value="fullname" style="display: none; color: red;">Vui lòng điền thông
                            tin!</label>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input class="form-control" type="text" data-input-value="phonenumber" name="phonenumber"
                            id="phonenumber" placeholder="Số điện thoại">
                        <label for="" data-check-value="phonenumber" style="display: none; color: red;">Vui lòng điền
                            thông tin!</label>
                    </div>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="text" data-input-value="email_order" name="email_order"
                        id="email_order" placeholder="Email người nhận">
                    <label for="" data-check-value="email_order" style="display: none; color: red;">Vui lòng điền thông
                        tin!</label>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-4">
                        <select id="city" name="city" data-input-value="city" class="form-control">
                            <option value="">Chọn tỉnh thành phố</option>
                            @foreach($provinces as $province)
                            <option value=" {{ $province->matp }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        <label for="" data-check-value="city" style="display: none; color: red;">Vui lòng điền thông
                            tin!</label>
                    </div>

                    <div class="col-md-4">
                        <select id="district" data-input-value="district" name="district" class="form-control">
                            <option value="">Chọn Quận/Huyện</option>
                        </select>
                        <label for="" data-check-value="district" style="display: none; color: red;">Vui lòng điền thông
                            tin!</label>
                    </div>
                    <div class="col-md-4">
                        <select id="wards" name="wards" data-input-value="wards" class="form-control">
                            <option value="">Chọn Xã/Phường</option>
                        </select>
                        <label for="" data-check-value="wards" style="display: none; color: red;">Vui lòng điền thông
                            tin!</label>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" name="address" data-input-value="address" id="address" class="form-control">
                    <label for="" data-check-value="address" style="display: none; color: red;">Vui lòng điền thông
                        tin!</label>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="note_order" id="note_order" placeholder="Ghi chú"></textarea>
                </div>

                <div class="mb-3">
                    <button class="send-order mb-2" type="button" id="" name="add_shipping_address" id="">Hoàn thành
                        thanh
                        toán</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="cart-info">
            <h3>Thông tin đơn hàng</h3>
            @if($cart && count($cart) > 0)
            <table class="table-cart">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Mô tả sản phẩm</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <th scope="row">
                            <img class="avatar-lg" src="{{ URL::to('uploads/product/' .$item['image'] ) }}" alt="">
                        </th>
                        <td>
                            <strong>{{ $item['tensp'] }}</strong>
                            <p class="star_review">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                            </p>
                            <p class="text-muted mb-0 mt-1">
                                {{ number_format($item['gia'], 0, ',', '.') }} x
                                {{ $item['soluong'] }}
                            </p>
                            <p class="text-muted mb-0 mt-1">
                                Color: {{$item['color']}}
                            </p>
                        </td>
                        <td>{{ number_format($item['total'], 0, ',', '.') }} đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Giỏ hàng của bạn đang trống.</p>
            @endif
            <hr>
            <div class="flex-center-between row-summary">

                @if ($coupon_session)
                <div>
                    <span>Đã áp dụng mã giảm giá</span>
                    <span> <a class="btn-delete-coupon" href="{{URL::to('/delete-coupon-checkout')}}">Xóa mã giảm
                            giá</a></span>
                </div>
                @endif
                <div>

                    <div class="coupon-container">
                        <form action="{{ URL::to('/check-coupon') }}" method="POST" class="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                            <label>Dùng code giảm giá nếu có</label>
                            <br>
                            @if (Session::get('id_customer'))
                            <div class="discount-code-area">
                                <input class="coupon-input" type="text" name="code_coupon"
                                    placeholder="Dùng mã giảm giá (nếu có)" required>
                                <input class="coupon-check" type="submit" name="use_code" value="Dùng mã">
                            </div>
                            @else
                            <div class="discount-code-area">
                                <input class="coupon-input" type="text" name="code_coupon"
                                    placeholder="Dùng mã giảm giá (nếu có)" required>
                                <input class="coupon-check disable" type="submit" name="use_code" value="Dùng mã"
                                    disabled>
                            </div>
                            @endif

                        </form>
                    </div>

                </div>
                <div>
                    <span>Tạm tính :</span>
                    <span>
                        {{ number_format($total_price, 0, ',', '.') }} đ
                    </span>
                </div>

                @if ($coupon_session)

                @foreach ($coupon_session as $coupon )

                @if ($coupon['coupon_type'] == 'percent')
                <div>
                    <span>Mã giảm giá: {{$coupon['coupon_code']}}</span>
                    <br>
                    <span>
                        Áp dụng giảm:
                    </span>
                    <span>
                        -{{$coupon['discount']}}%
                    </span>
                </div>
                @php
                $price_discount = ($total_price * $coupon['discount'])/100;
                $price_cart = $total_price - $price_discount;
                @endphp
                <div>
                    <span>
                        Số tiền sau khi giảm:
                    </span>
                    <span>
                        {{ number_format($price_cart, 0, ',', '.') }} đ
                    </span>
                </div>
                @elseif($coupon['coupon_type'] == 'fixed')
                <div>
                    <span>Mã giảm giá: {{$coupon['coupon_code']}}</span>
                    <br>
                    <span>
                        Giảm giá :
                    </span>
                    <span> {{ number_format($coupon['discount'], 0, ',', '.') }} đ</span>
                </div>
                @php
                $price_discount = $coupon['discount'];
                $price_cart = $total_price - $price_discount;
                @endphp
                <div>
                    <span>
                        Số tiền sau khi giảm:
                        <span id="price_cart"> {{ number_format($price_cart, 0, ',', '.') }}</span>đ
                    </span>

                </div>
                @endif
                @endforeach
                @else
                <div>
                    <span>Số tiền giảm:</span>
                    <span>
                        0đ
                    </span>
                </div>

                <div>
                    <span>
                        Thành tiền:
                        <span id="price_cart"> {{ number_format($total_price, 0, ',', '.') }}</span> đ
                    </span>

                </div>
                @endif

                <input type="hidden" id="id_coupon" value="">
                <span> Phí vận chuyển: <strong id="feeship">0</strong> đ</span>
                <hr>
                <p>Tổng giá trị: <strong id="displayTotal">
                        @if ($total_price)
                        {{ number_format($total_price, 0, ',', '.') }} đ
                        @else
                        0 đ
                        @endif
                    </strong> </p>
            </div>
        </div>
    </div>
</div>



@endsection