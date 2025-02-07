<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    @page {
        margin: 0px;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 14px;
        margin: 0;
        display: inline-block;
    }

    .hedder-page {
        background-color: blue;
        height: 100px;
    }



    .navbar-page-logo {
        text-align: center;
    }

    .navbar-page-logo img {
        width: 150px;
    }


    .navbar-page-info p {
        color: white;
        margin: 0;
        padding: 0;
    }

    .page-body {
        margin: 0 50px;
    }

    .order-title {
        text-align: center;
        margin: 0px;
        padding: 0px;
    }

    .info-order {
        padding: 0px;
        margin-bottom: 5px;
    }

    .info-order h3 {
        margin: 0px;
        padding: 0px;
    }

    .info-order p {
        margin: 0px;
        padding: 0px;
    }

    .info-shop {
        padding: 0px;
        margin-bottom: 5px;
    }

    .info-shop h3 {
        margin: 0px;
        padding: 0px;
    }

    .info-shop p {
        margin: 0px;
        padding: 0px;
    }

    .info-customer {
        padding: 0px;
        margin-bottom: 5px;
    }

    .info-customer h3 {
        margin: 0px;
        padding: 0px;
    }

    .info-customer p {
        margin: 0px;
        padding: 0px;
    }

    .info-product {
        width: 100%;
    }

    tr,
    td {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="hedder-page">
        <div class="navbar-page-logo">
            <img src="{{public_path('/admin/images/logo/logo.png')}}">
        </div>
    </div>
    <div class="page-body">
        <h2 class="order-title">Phiếu giao hàng</h2>
        <hr>
        <div class="info-order">
            <h3>Thông tin đơn hàng</h3>
            <p>Mã đơn hàng: {{$orderShip->order_code }}</p>
            <p>Ngày đặt hàng: {{ $orderShip->created_at }}</p>
            <p>Tổng số lượng sản phẩm: {{ $orderCount }}</p>
            <p>Ghi chú của khách hàng: {{$orderShip->order_note}}</p>
        </div>

        <div class="info-shop">
            <h3>Thông tin của shop</h3>
            <p>Thành phố Cần Thơ, Quận Tân Bình, Phường Trường Lạc</p>
            <p>Email: dactuong13@gmail.com</p>
            <p>Số đvện thoại: 0356459122</p>
        </div>
        <div class="info-customer">
            <h3>Thông tin khách hàng</h3>
            <p>Tên khách hàng: {{$orderShip->shippingAddress->fullname}}</p>
            <p>Email: {{$orderShip->order_email}}</p>
            <p>Số điện thoại: {{$orderShip->shippingAddress->order_phone}}</p>
            <p>Địa chỉ giao hàng:
                {{$orderShip->shippingAddress->province->name}}, {{$orderShip->shippingAddress->districts->name}}
                , {{$orderShip->shippingAddress->wards->name}}, {{$orderShip->shippingAddress->diachi}}
            </p>

        </div>
        <h2>Chi tiết đơn hàng</h2>
        <table class="info-product">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailOrder as $order)
                <tr>
                    <td>{{$order->phone->product_name}}</td>
                    <td>{{$order->product_sale_quantity}}</td>
                    <td>{{ number_format($order->product_price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($summaryProduct, 0, ',', '.') }} VNĐ</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">Tổng cộng</td>
                    <td>{{ number_format($summaryOrder, 0, ',', '.') }} VNĐ</td>
                </tr>
                <tr>
                    <td colspan="3">Giảm giá</td>
                    <td>{{ $discountAmount }}</td>
                </tr>
                <tr>
                    <td colspan="3">Phí vân chuyển</td>
                    <td> {{ number_format($orderShip->feeship, 0, ',', '.') }} VNĐ</td>
                </tr>
                <tr>
                    <td colspan="3">Tổng thanh toán</td>
                    <td>{{ number_format($orderShip->order_total, 0, ',', '.') }} VNĐ</td>
                </tr>
            </tbody>
        </table>

        <p>Tình trạng đơn hàng: {{$orderStatus}}</p>
    </div>

</body>

</html>