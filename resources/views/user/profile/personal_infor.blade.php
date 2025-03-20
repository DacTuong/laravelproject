@extends('layout')
@section('content')

<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ > </a>
    @if (isset($showSetting) && $showSetting)
    <a href="{{ URL::to('/thong-tin-ca-nhan/setting') }}">Đổi mật khẩu</a>
    @else
    <a class="" href="{{ URL::to('/thong-tin-ca-nhan') }}">Trang khách hàng</a>
    @endif
</div>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="border-white">
            <h4 class="title-account">TRANG TÀI KHOẢN</h4>
            <p>Xin chào <span style="color:#01567f;"> {{ $inforcustomer->name_user}}</span> !</p>
            <ul class="block-action">

                @php $currentUrl = request()->path(); @endphp
                <li>
                    <a class="title-info {{ $currentUrl == 'thong-tin-ca-nhan' ? 'act' : '' }}"
                        href="{{ URL::to('/thong-tin-ca-nhan') }}">Thông tin tài khoản</a>
                </li>
                <li>
                    <a class="title-info" href="{{ URL::to('/history-order') }}">Đơn hàng của bạn</a>
                </li>
                <li>
                    <a class="title-info {{ $currentUrl == 'thong-tin-ca-nhan/setting' ? 'act' : '' }}"
                        href="{{ URL::to('/thong-tin-ca-nhan/setting') }}">Đổi mật khẩu</a>
                </li>
                <li>
                    <a class="title-info" href="{{ URL::to('/wishlist') }}">Danh sách yêu thích</a>
                </li>
                <li>
                    <a class="title-info" href="{{ URL::to('/logout') }}">Đăng xuất</a>
                </li>
            </ul>

        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        @if(isset($showSetting) && $showSetting)
        @include('user.profile.setting')
        <!-- Hiển thị file setting.blade.php -->
        @else
        {{ $inforcustomer->name_user}}
        @endif
    </div>

</div>

@endsection