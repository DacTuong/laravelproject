@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="border-white">
            <div class="image-customer">

            </div>
            <div class="infomation-customer">
                <div class="flex-inline"><strong>Tên khách hàng:</strong><span>{{$inforcustomer->name_user}}</span>
                </div>
                <div class="flex-inline"><strong>Email:</strong><span>{{$inforcustomer->email_user}}</span></div>
                <div class="flex-inline"><strong>Số điện thoại:</strong><span>{{$inforcustomer->phone_user}}</span>
                </div>
                <div class="flex-inline"><strong>Địa chỉ:</strong>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="border-white">
            <label class="title-top">
                THỐNG KÊ
            </label>
            <div class="order-statistics">
                <div class="col-stantistics">
                    <span class="title-stantistics">
                        Tổng đơn hàng
                    </span>
                    <br>
                    <b>{{$ordercount}}</b>
                    <br>
                    <span class="sub-title">
                        Đã đặt hàng
                    </span>
                </div>
                <div class="col-stantistics">
                    <span class="title-stantistics">
                        Tổng chi tiêu
                    </span>
                    <br>
                    <b>
                        {{ number_format($totalamount, 0, ',', '.') }}đ
                    </b>
                    <br>
                    <span class="sub-title">
                        Cho mỗi đơn hàng được giao
                    </span>
                </div>
                <div class="col-stantistics">
                    <span class="title-stantistics">
                        Trung bình mỗi đơn hàng
                    </span>
                    <br>
                    <b>
                        {{ number_format($avgamount, 0, ',', '.') }}đ
                    </b>
                    <br>
                    <span class="sub-title">
                        Trong tổng số {{$ordercount}} đơn hàng đã đặt
                    </span>
                </div>
            </div>
        </div>

        <div class="border-white">
            <label class="title-top">
                ĐƠN HÀNG ĐÃ ĐẶT
            </label>
            <br>
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tình trạng</th>
                        <th>Tổng số tiền</th>
                        <th>Thời gian mua hàng</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historys as $history )
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{$history->order_code}}
                        </td>
                        <td>
                            Đang chờ
                        </td>
                        <td>
                            {{ number_format($history->order_total, 0, ',', '.') }}đ

                        </td>
                        <td>
                            {{$history->created_at}}
                        </td>
                        <td>
                            <a class="view-order-history"
                                href="{{URL::to('/view-history-order'.'/'.$history->order_code)}}">Xem</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @endsection