@extends('admin_layout')
@section('admin_content')
<h1>Thống kê</h1>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-red set-icon">
                <i class="fa-regular fa-comment"></i>
            </span>
            <div class="text-box">
                <p class="main-text"> {{$new_comment}} New</p>
                <p class="text-muted">Bình luận</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
                <i class="fa fa-bars"></i>
            </span>
            <div class="text-box">
                <p class="main-text">{{$count_product}}</p>
                <p class="text-muted">Sản phẩm</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-brown set-icon">
                <i class="fa fa-rocket"></i>
            </span>
            <div class="text-box">
                <p class="main-text">{{$order_pedding}} <br>Đơn hàng

                </p>
                <p class="text-muted">Mới</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label for="">Bảng thống kê đơn hàng</label>
        <table>
            <thead>
                <tr>
                    <td>Tổng số đơn hàng</td>
                    <td>Đơn hàng đã xác nhận</td>
                    <td>Đơn hàng chưa xác nhận</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$total_order}}</td>
                    <td>{{$order_success}}</td>
                    <td>{{$order_pedding}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label for="">Bảng thống kê lợi nhuận theo ngày</label>
        <table>
            <thead>
                <tr>
                    <td>Ngày</td>
                    <td>Tổng số tiền thu được</td>
                    <td>Lợi nhuận thu được</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($santisticle as $santistic)
                <tr>
                    <td>{{$santistic->order_date}}</td>
                    <td>{{$santistic->total_price_orders}}</td>
                    <td>{{$santistic->profit}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection