<div>
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