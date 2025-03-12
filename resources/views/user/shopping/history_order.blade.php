@extends('layout')
@section('content')

<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ </a>/
    <a href="{{ URL::to('/history-order') }}">Lịch sử mua hàng</a>
</div>
<div class="history-order-content">
    <div class="history-order-title mb-3">
        <h4 class="title-history">
            LỊCH SỬ MUA HÀNG CỦA BẠN
        </h4>

    </div>
    <div class="filler-order">

        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                <input type="text" id="orderCode" placeholder="Mã đơn hàng" class="form-control">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                <input type="date" id="orderDate" placeholder="Ngày mua hàng" class="form-control">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                <select id="orderStatus" class="form-control">
                    <option value="">Tìm trạng thái</option>
                    <option value="1">Chờ xữ lý</option>
                    <option value="2">Đã xữ lý</option>
                    <option value="3">Đã hủy</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                <button type="button" class="btn btn-primary w-100 filter-order" onclick="filterOrders()">Lọc</button>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                <a href="" class="btn btn-secondary w-100">Tải lại</a>
            </div>
        </div>

    </div>

    <div class="list-history-order">

        <table class="table-list-order">
            <thead>
                <tr>
                    <th>
                        STT
                    </th>
                    <th>
                        Mã đơn hàng
                    </th>
                    <th>
                        Tên người mua
                    </th>
                    <th>
                        Số lượng
                    </th>
                    <th>
                        Chi phí
                    </th>
                    <th>
                        Thời gian mua
                    </th>
                    <th>
                        Trạng thái
                    </th>
                    <th>
                        Tác vụ
                    </th>
                </tr>
            </thead>
            <tbody class="scroll">
                @if ($historys->count() > 0)
                @foreach ($historys as $history )
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{$history->order_code }}
                    </td>
                    <td>
                        {{$history->shippingAddress->fullname}}
                    </td>
                    <td>
                        {{$history->orderDetail->sum('product_sale_quantity')}}
                    </td>
                    <td>
                        {{ number_format($history->order_total, 0, ',', '.') }} đ
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($history->created_at)->format('H:i:s, d-m-Y') }}
                    </td>
                    <td>
                        @if ($history->order_status == 1)
                        <span class="order-status-waitting">Đang chờ xử lý...</span>
                        @elseif($history->order_status == 2)
                        <span class="order-status-delivered">Đã giao hàng</span>
                        @else
                        <span class="order-status-cancle">Đã huỷ</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{URL::to('/view-history-order'.'/'.$history->order_code)}}">Xem</a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8">
                        <h3>Không có đơn hàng nào được tìm thấy</h3>
                    </td>
                </tr>
                @endif


            </tbody>
        </table>



    </div>
</div>
@endsection