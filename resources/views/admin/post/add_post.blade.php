@extends('admin_layout')
@section('admin_content')
<form action="{{URL::to('/save-post')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
        <label for="">Tên bài viết</label>
        <input type="text" class="form-control" name="post_name" id="">
    </div>
    <br>
    <div class="form-group">
        <label>Ảnh đại diện</label>
        <input type="file" class="form-control" name="post_image">
    </div>
    <div>
        <div class="form-group">
            <label for="">Nội dung bài viết</label>
            <textarea name="content_post" id="example"></textarea>
        </div>
    </div>
    <input type="submit" name="save_post" id="">
</form>
@endsection