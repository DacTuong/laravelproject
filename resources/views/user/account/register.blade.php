<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("user/css/register.css")}}">
</head>

<body>
    <div class="wrap">
        <h1 class="title">ĐĂNG KÝ THÀNH VIÊN MỚI</h1>
        <form method="POST" action="{{URL::to('/add-customer')}}" class="form">
            {{csrf_field()}}
            <div class="row-form">
                <label>Tên người dùng</label>
                <br>
                <input class="input-form" placeholder="Nhập tên người dùng" type="text" name="user_name" required>
            </div>
            <div class="row-form">
                <label>Email: </label>
                <br>
                <input class="input-form" placeholder="Nhập email" type="text" name="user_email" required>
                <br>
                <span class="form-mesage"></span>
            </div>
            <div class="row-form">
                <label>Mật khẩu</label>
                <br>
                <input class="input-form" placeholder="Nhập mật khẩu" type="text" name="user_password" required>
            </div>
            <div class="row-form">
                <label>Điện thoại</label>
                <br>
                <input class="input-form" placeholder="Nhập số điện thoại" type="text" name="user_phone" required>
                <br>
                <span class="form-mesage"></span>
            </div>
            <div class="row-form">
                <input type="submit" class="submit-btn" name="dangky" value="Đăng ký">

                <div class="row-link">
                    <a class="link-submit" href="{{ URL::to('/login-index') }}">Đăng nhập nếu có tài khoản</a>
                </div>
            </div>

        </form>

    </div>
</body>

</html>