<?php

use Illuminate\Support\Facades\Session;

$message = Session::get('message');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login user</title>
    <link rel="stylesheet" href="{{asset('/admin/css/formlogin.css')}}">
    <script src="https://kit.fontawesome.com/83caae6a84.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="wrap">
        <div class="title"><span>Admin login</span></div>
        <?php
        if ($message) {
            echo '<p class="text-arlert">', $message, '</p>';
            Session::put('message', null);
        }
        ?>
        <form action="{{URL::to('/login')}}" autocomplete="off" method="POST" class="login-form">
            {{csrf_field()}}
            <div class="row-formlogin">
                <label>Tên người dùng</label>
                <i class="fa-solid fa-user"></i>
                <br>
                <input class="input-row" type="text" name="admin_email" required placeholder="Nhập email">
            </div>
            <div class="row-formlogin">
                <label>Mật khẩu</label>
                <i class="fa-solid fa-lock"></i>
                <br>

                <input class="input-row" type="password" name="admin_password" required placeholder="Nhập mật khẩu">
            </div>
            <div class="row-formlogin">
                <input class="input-submit" type="submit" name="dangnhap" value="Login">
            </div>
        </form>
    </div>
</body>

</html>