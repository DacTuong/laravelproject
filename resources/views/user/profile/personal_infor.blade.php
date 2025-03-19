@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="border-white">

            <a href="{{ URL::to('/thong-tin-ca-nhan/setting') }}">Đổi mật khẩu</a>
            <div class="image-customer">

            </div>

        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        @if(isset($showSetting) && $showSetting)
        @include('user.profile.setting')
        <!-- Hiển thị file setting.blade.php -->
        @endif
    </div>

</div>



@endsection