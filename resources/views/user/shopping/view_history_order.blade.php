@extends('layout')
@section('content')
<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ /</a>
    <a href="{{ URL::to('/history-order') }}">Lịch sử mua hàng /</a>
    <a href="{{ URL::to('/view-history-order' . '/' . $order_historys->order_code) }}">
        {{ $order_historys->order_code }}
    </a>
</div>
<div>
    Đơn hàng <span class="order_code">{{ $order_historys->order_code }}</span>
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="border-white">
            <div class="row">
                <div class="col-sm-4">
                    <h6>
                        Mã đơn hàng
                    </h6>
                    <a href="{{ URL::to('/view-history-order' . '/' . $order_historys->order_code) }}">
                        {{ $order_historys->order_code }}
                    </a>
                </div>
                <div class="col-sm-4">
                    <h6>Tên khách hàng</h6>
                    <span>
                        {{ $order_historys->shippingAddress->fullname }}
                    </span>
                </div>
                <div class="col-sm-4">
                    <h6>Mua hàng vào lúc:</h6>
                    <span>{{ \Carbon\Carbon::parse($order_historys->created_at)->format('H:i:s, d-m-Y') }}</span>
                </div>
            </div>
        </div>
        <div class="border-white">
            <h6>Sản phẩm đã mua</h6>
            <table class="table-cart">
                <tbody>
                    @foreach ($order_infomations as $info)
                    <tr style="font-size: 18px;">
                        <td>
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0">
                                    <img src="{{ URL::to('uploads/product/' . $info->phone->product_image) }}" alt=""
                                        class="img-order">
                                </div>
                                <div class="flex-lg-grow-1 ms-3">
                                    <h6 class="small mb-0">
                                        <a href="#" class="text-reset">{{ $info->phone->product_name }}</a>
                                    </h6>
                                    <span class="small">Color: {{ $info->phone->color }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $info->product_sale_quantity }}</td>
                        <td class="text-end"> {{ number_format($info->product_price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            Tổng đơn hàng
                        </td>
                        <td class="text-end">{{ number_format($grandTotal, 0, ',', '.') . ' VNĐ' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Phí vận chuyển
                        </td>
                        <td class="text-end"> {{ number_format($order_historys->feeship, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Tổng cộng
                        </td>
                        <td class="text-end">
                            {{ number_format($order_historys->order_total, 0, ',', '.') }}
                        </td>
                    </tr>


                </tfoot>
            </table>
        </div>
        <div class="border-white">
            <h2>Thông tin khách hàng</h2>
            <p><strong>Tên khách hàng:</strong> {{ $order_historys->shippingAddress->fullname }}</p>
            <p><strong>Email:</strong> {{ $order_historys->order_email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order_historys->shippingAddress->order_phone }}</p>
            <p><strong>Ghi chú:</strong> Ghi chú</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="border-white">
            <h6>Tình trạng đơn hàng</h6>
            @if ($order_historys->order_status == 1)
            <label class="mb-3 fw-bold fs-6 status-label"><i class="fa-solid fa-circle color-loading"></i>
                Trạng thái</label>
            <span class="status-loading"><i class="fa-solid fa-hourglass-half"></i> Đang chờ xử
                lý...</span>
            @elseif($order_historys->order_status == 2)
            <label class="mb-3 fw-bold fs-6 status-label"><i class="fa-solid fa-circle color-success"></i>
                Trạng thái</label>
            <span class="status-success"><i class="fa-solid fa-check-circle"></i> Đã giao hàng</span>
            @elseif($order_historys->order_status == 3)
            <label class="mb-3 fw-bold fs-6 status-label"><i class="fa-solid fa-circle color-destroy"></i>
                Trạng thái</label>
            <span class="status-destroy"><i class="fa-solid fa-times-circle"></i> Đã bị huỷ</span>
            @endif
        </div>
        <div class="border-white">
            <h6>
                Mã giảm giá:
            </h6>
            @if ($code_coupon)
            <span>Mã giảm giá</span>
            <span>{{ $code_coupon->coupon_code }}</span>
            @else
            <span>Không có mã giảm giá</span>
            @endif
            <br>
            <span>
                Số tiền giảm: {{ $discount_price }}
            </span>

        </div>
        <div class="border-white">
            <h6>Địa chỉ giao hàng</h6>
            <p><strong>Tỉnh/thành:</strong> {{ $order_historys->shippingAddress->province->name }}</p>
            <p><strong>Quận Huyện:</strong> {{ $order_historys->shippingAddress->districts->name }}</p>
            <p><strong>Xã/phường:</strong> {{ $order_historys->shippingAddress->wards->name }}</p>
            <p><strong>Địa chỉ :</strong> {{ $order_historys->shippingAddress->diachi }}</p>
        </div>
        <div class="border-white">
            @if ($order_historys->order_status == 3)
            <label for="">Lý do hủy đơn</label>
            <p>{{ $order_historys->order_cancellation_reason }}</p>
            @else
            <button class="cancel-order">Hủy đơn hàng</button>
            @endif

        </div>
    </div>
</div>



<div class="model-cancel-order">
    <div>
        <h1>Hủy đơn hàng</h1>
    </div>
    <form>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
        <label for="">Có thể cho chúng tôi biết lý do hủy đơn hàng</label>
        <div class="mb3">
            <div>
                <input type="radio" name="reason" class="reason1" id="reason1" value="Thay đổi quyết định" checked>
                <label for="reason1">Thay đổi quyết định</label>
            </div>
            <div>
                <input type="radio" name="reason" class="reason2" id="reason2" value="Tìm được giá tốt hơn">
                <label for="reason2">Tìm được giá tốt hơn</label>
            </div>
            <div>
                <input type="radio" name="reason" class="reason3" id="reason3" value="Đơn hàng bị trể">
                <label for="reason3">Đơn hàng bị trể</label>
            </div>
            <div>
                <input type="radio" name="reason" class="reason4" id="reason4" value="Khác">
                <label for="reason4">Khác</label>
            </div>
            <textarea name="" id="" class="reason_cancellation form-control" style="height: 90px;"
                placeholder="Vui lòng nhập lý do"></textarea>
        </div>
        <div class="model-footer">
            <button class="close-model">
                Đóng
            </button>
            <button data-id_order="{{ $order_historys->order_code }}" class="send-cancel-resson">Xác
                nhận</button>
        </div>
    </form>

</div>
@endsection