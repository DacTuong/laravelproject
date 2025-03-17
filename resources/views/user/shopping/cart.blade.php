@extends('layout')
@section('content')
<?php

use Illuminate\Support\Facades\Session;

$cart = Session::get('cart');
$total_price = Session::get('total_price');
$coupon_session = Session::get('coupon');
?>
<h1>Giỏ hàng của bạn</h1>

<div class="shopping-cart">
    @if ($cart && count($cart) > 0)
    <table class="table-cart">
        <thead>
            <tr>
                <th class="px-3">Sản phẩm đã mua</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>
                    <a class="btn-delete" href="{{URL::to('/delete-all')}}"
                        onclick="return confirm('Bạn có chắc là muốn xoá tất cả sản phẩm ra khỏi giỏ hàng?')">Xoá
                        tất cả
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr>
                <td class="px-3">
                    <div style="display: flex; align-items: center;">
                        <img src="{{ URL::to('uploads/product/' .$item['image'] ) }}" alt="Tên sản phẩm"
                            style="width: 50px; height: 50px; margin-right: 10px;">
                        <div>
                            <span> {{ $item['tensp'] }}</span><br>
                            <span>Color: {{$item['color']}}</span>
                        </div>
                    </div>


                </td>

                <td><span>{{ number_format($item['gia'], 0, ',', '.') }} đ</span></td>
                <td>
                    <form action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                        <input type="text" name="" class="quantity" id="" value="{{ $item['soluong'] }}">
                        <input type="hidden" name="" class="masp" id="" value="{{ $item['masp'] }}">
                        <button type="button" style="display:none;">update</button>
                    </form>
                </td>
                <td>{{ number_format($item['total'], 0, ',', '.') }} đ</td>
                <th><a href="{{ URL::to('/delete') . '/' . $item['session_id'] }}" title="Xoá sản phẩm ra khỏi giỏ">
                        <i class="bi bi-trash"></i>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>

    <div>
        <h4>Tổng tiền:</h4>
        <span>
            {{ number_format($total_price, 0, ',', '.') }} VNĐ
        </span>
    </div>

    @else
    <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>
<div class="row">


    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
        <div class="summary-cart">
            <div>
                <span>Tổng cộng :</span>
                <span>
                    {{ number_format($total_price, 0, ',', '.') }} VNĐ
                </span>
            </div>

            @if ($coupon_session)

            @foreach ($coupon_session as $coupon )

            @if ($coupon['coupon_type'] == 'percent')
            <div>

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
                    {{ number_format($price_cart, 0, ',', '.') }} VNĐ
                </span>
            </div>
            @elseif($coupon['coupon_type'] == 'fixed')
            <div>
                <span>
                    Giảm giá :
                </span>
                <span> {{ number_format($coupon['discount'], 0, ',', '.') }} VNĐ</span>
            </div>
            @php
            $price_discount = $coupon['discount'];
            $price_cart = $total_price - $price_discount;
            @endphp
            <div>
                <span>
                    Thành tiền:
                </span>
                <span> {{ number_format($price_cart, 0, ',', '.') }} VNĐ</span>
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
                </span>
                <span> {{ number_format($total_price, 0, ',', '.') }} VNĐ</span>
            </div>
            @endif
            <hr>
            @if ($coupon_session)
            <div>
                <span>Đã áp dụng mã giảm giá</span>
                <span> <a class="btn-delete-coupon" href="{{URL::to('/delete-coupon')}}">Xóa mã giảm giá</a></span>
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
                            <input class="coupon-check disable" type="submit" name="use_code" value="Dùng mã" disabled>
                        </div>
                        @endif

                    </form>
                </div>

            </div>
            <hr>

            <div>

                @if (Session::get('id_customer'))
                <a class="checkout-link" href="{{ URL::to('/checkout') }}">Thanh toán</a>
                @else
                <a class="checkout-link" href="" onclick="return confirm('Vui lòng đăng nhập tài khoản hoặc đăng ký?')">
                    Thanh toán</a>
                @endif

            </div>
        </div>

    </div>


</div>

@endsection