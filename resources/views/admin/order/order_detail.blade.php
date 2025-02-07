@extends('admin_layout')
@section('admin_content')
@php
$totalCart = 0; // Khởi tạo biến tổng tiền
@endphp
<!-- Tiêu đề trang -->
<div class="order-details-header">
    <div class="order-details-label">
        <a href="{{URL::to('/order-view')}}">Quay lại danh sách đơn hàng</a>
    </div>
    <!-- Hành động-->
    <div class="order-details-action">

        <a href="{{URL::to('/print-order'.'/'.$order_historys->order_code)}}">In đơn hàng</a>
    </div>
</div>
<!-- Danh sách sản phẩm -->

<div class="col-sm-8">
    <div class="order-table">
        <h3>Sản phẩm trong đơn hàng</h3>
        <table>
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_infomations as $order)
                <tr>
                    <td>{{$order->phone->product_name}}</td>
                    <td>{{$order->product_sale_quantity}}</td>
                    <td>{{ number_format($order->product_price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        @php
                        $order_price_product= $order->product_price;
                        $order_quantity_sale = $order->product_sale_quantity;
                        $summary_product = $order_price_product* $order_quantity_sale;
                        $totalCart +=$summary_product;
                        @endphp
                        {{ number_format($summary_product, 0, ',', '.') }} VNĐ
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="order-summary">
        <h3>Tổng kết đơn hàng</h3>
        <strong>Tổng số lượng sản phẩm:</strong>
        <span id="order-item"> {{$orderCount}}
        </span>
        <p><strong>Tổng tiền sản phẩm:</strong>{{ number_format($totalCart, 0, ',', '.') }} VNĐ</p>
        <p><strong>Giảm giá:</strong> {{$discount_price}}</p>
        <p><strong>Mã giảm giá:</strong> {{$code_coupon->coupon_code ?? ""}} </p>
        <p><strong>Phí vận chuyển:</strong> {{ number_format($order_historys->feeship, 0, ',', '.') }}VNĐ</p>
        <p><strong>Tổng cộng:</strong> {{ number_format($order_historys->order_total, 0, ',', '.') }} VNĐ</p>
    </div>
</div>

<!-- Tổng kết đơn hàng -->

<div class="col-sm-4">
    <!-- Thông tin đơn hàng -->
    <div class="order-info">
        <h3>Thông tin đơn hàng</h3>
        <p><strong>Mã đơn hàng:</strong> #{{$order_historys->order_code}}</p>
        <p><strong>Ngày đặt hàng:</strong> {{$order_historys->created_at}}</p>
        <p><strong>Tình trạng đơn hàng:</strong> <span id="current-order-status">{{$orderStatus}}</span></p>
        <p><strong>Ghi chú:</strong> {{$order_historys->order_note}}</p>
    </div>
    <div>
        <h3>Chỉnh sửa đơn hàng</h3>
        <form>
            @csrf
            <input type="hidden" id="order-code" value="{{$order_historys->order_code}}">
            <label for="order-status">Cập nhật tình trạng đơn hàng:</label>
            <br>
            <select name="order-status" id="order-status">
                <option value="2" {{ $order_historys->order_status == 2 ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="3" {{ $order_historys->order_status == 3 ? 'selected' : '' }}>Hủy đơn hàng</option>
            </select>
            <br>
            <label for="order-note">Thêm ghi chú:</label>
            <textarea name="order-note" id="order-note" class="order-note"></textarea>
            <br>
            <button type="button" id="update-order" class="update-order">Cập nhật</button>
        </form>
    </div>

    <!-- Thông tin khách hàng -->
    <div class="customer-info">
        <h3>Thông tin khách hàng</h3>
        <p><strong>Tên khách hàng:</strong> {{$order_historys->shippingAddress->fullname}}</p>
        <p><strong>Email:</strong> {{$order_historys->order_email}}</p>
        <p><strong>Số điện thoại:</strong> {{$order_historys->shippingAddress->order_phone}}</p>
    </div>
    <div class="shipping-address">
        <h3>Địa chỉ giao hàng</h3>
        <p><strong>Tỉnh/thành:</strong> {{$order_historys->shippingAddress->province->name}}</p>
        <p><strong>Quận Huyện:</strong> {{$order_historys->shippingAddress->districts->name}}</p>
        <p><strong>Xã/phường:</strong> {{$order_historys->shippingAddress->wards->name}}</p>
        <p><strong>Địa chỉ :</strong> {{$order_historys->shippingAddress->diachi}}</p>
    </div>
</div>

@endsection