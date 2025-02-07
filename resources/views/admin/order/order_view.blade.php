@extends('admin_layout')
@section('admin_content')

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
            <a href="{{URL::to('/order-view')}}" class="btn btn-secondary w-100">Tải lại</a>
        </div>
    </div>

</div>
<table>
    <thead>
        <tr>
            <th colspan="10">
                <h3>Danh sách đơn hàng</h3>
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Số tiền đơn hàng</th>
            <th>Ngày mua</th>
            <th>Tình trạng đơn</th>
            <th>Chi tiết</th>

        </tr>
    </thead>
    <tbody>
        @foreach($lsOrder as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ $order->order_code }}
            </td>
            <td>{{ $order->shippingAddress->fullname ?? 'N/A' }}</td>
            <td>{{ number_format($order->order_total, 0, ',', '.') }} đ</td>
            <td>{{ $order->created_at }}</td>
            <td>
                @if ( $order->order_status == 1)
                Đang xữ lý
                @elseif($order->order_status == 3)
                Không xữ lý
                @elseif($order->order_status == 2)
                Đã xác nhận đơn
                @endif
            </td>
            <td><a href="{{URL::to('/view-detail'.'/'.$order->order_code)}}">xem</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection