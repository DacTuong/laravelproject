@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="border-white">
            <div class="image-customer">
                <img class="avatar-customer" src="" alt="">
            </div>
            <div class="infomation-customer">
                <div class="flex-inline"><strong>Tên khách hàng:</strong><span>{{$informations->name_user}}</span>
                </div>
                <div class="flex-inline"><strong>Email:</strong><span>{{$informations->email_user}}</span></div>
                <div class="flex-inline"><strong>Số điện thoại:</strong><span>{{$informations->phone_user}}</span>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="border-white">
            <div class="change-password">
                <form action="" class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete>
                    <div>
                        <label for="">Mật khẩu củ:</label>
                        <br>
                        <input class="form-control" type="text" name="" id="old-password">
                    </div>
                    <div>
                        <label for="">Mật khẩu mới:</label>
                        <br>
                        <input class="form-control" type="text" name="" id="new-password">
                    </div>
                    <div>
                        <button type="button" class="change-pass">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <form action="{{URL::to('/change-avatar')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <input type="file" class="form-control" name="avatar_user">
                </div>
                <button type="submit" name="change_avatar" class="btn btn-primary">Đổi ảnh</button>
            </form>
        </div>
    </div>
</div>
@endsection