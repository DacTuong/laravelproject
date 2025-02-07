@extends('layout')
@section('content')


<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ /</a>
    <a href="{{ URL::to('/history-order') }}">Lịch sử mua hàng /</a>
    <a href="{{URL::to('/view-history-order'.'/'.$order_historys->order_code)}}">{{$order_historys->order_code}}</a>
</div>
<div>
    Đơn hàng <span id="order_code"> {{$order_historys->order_code}}</span>

</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="border-white">
            <div class="d-flex">
                <span class="me-3">{{$order_historys->created_at}}</span>
                <span class="me-3"> {{$order_historys->order_code}}</span>
                <span class="me-3" id="order_status"></span>
            </div>
            <table class="table-cart">
                <tbody>
                    @foreach ($order_infomations as $info)
                    <tr style="font-size: 18px;">
                        <td>
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0">
                                    <img src="{{ URL::to('uploads/product/'.$info->phone->product_image ) }}" alt=""
                                        width="35" class="img-fluid">
                                </div>
                                <div class="flex-lg-grow-1 ms-3">
                                    <h6 class="small mb-0">
                                        <a href="#" class="text-reset">{{$info->phone->product_name}}</a>
                                    </h6>
                                    <span class="small">Color: Black</span>
                                </div>
                            </div>
                        </td>
                        <td>{{$info->product_sale_quantity}}</td>
                        <td class="text-end"> {{ number_format($info->product_price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            Tổng đơn hàng
                        </td>
                        <td class="text-end">{{number_format($grandTotal, 0, ',', '.') . ' VNĐ';}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Phí vận chuyển
                        </td>
                        <td class="text-end"> {{ number_format($order_historys->feeship, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Giảm giá
                        </td>
                        <td class="text-end">
                            {{$discount_price}}
                        </td>
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
            <p><strong>Tên khách hàng:</strong> {{$order_historys->shippingAddress->fullname}}</p>
            <p><strong>Email:</strong> {{$order_historys->order_email}}</p>
            <p><strong>Số điện thoại:</strong> {{$order_historys->shippingAddress->order_phone}}</p>
        </div>
        <div class="border-white">
            <b>Lý do hủy đơn hàng:</b>
            <p id="cancel_reason" class="cancel_reason">

            </p>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="border-white">
            <h6>Ghi chú khách hàng</h6>
            <p>{{$order_historys->order_note}}</p>
        </div>
        <div class="border-white">
            <h6>Địa chỉ giao hàng</h6>
            <p><strong>Tỉnh/thành:</strong> {{$order_historys->shippingAddress->province->name}}</p>
            <p><strong>Quận Huyện:</strong> {{$order_historys->shippingAddress->districts->name}}</p>
            <p><strong>Xã/phường:</strong> {{$order_historys->shippingAddress->wards->name}}</p>
            <p><strong>Địa chỉ :</strong> {{$order_historys->shippingAddress->diachi}}</p>
        </div>
        <div class="border-white">
            <div>
                <form action="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                    <label for="" class="reason-label" style="display: none; color: red;">Vui lòng điền
                        thông tin!</label>
                    <textarea name="cancel-reason" id="cancel-reason" class="cancel-reason"></textarea>
                    <br>
                    <button type="button" class="cancel-order" id="cancel-order"
                        data-order_code="{{$order_historys->order_code}}">
                        Hủy đơn hàng
                    </button>

            </div>
        </div>
    </div>
</div>


@endsection