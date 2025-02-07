@extends('admin_layout')
@section('admin_content')
<h2>Tất cả bài viết</h2>
<table>
    <thead>
        <tr>
            <td>
                #
            </td>
            <td>
                Hình ảnh bài viết
            </td>
            <td>
                Tên bài viết
            </td>
            <td>Tác vụ</td>
        </tr>
    </thead>
    <tbody>

        @foreach ($all_post as $post)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <img src="{{ URL::to('uploads/post/' . $post->image_article) }}" alt="" style="height: 100px;">
            </td>
            <td>
                {{$post->name_article}}
            </td>
            <td>
                <?php
                if ($post->status_article == 2) {
                ?>
                <a href="{{URL::to('/inactive-post'.'/'.$post->id_article )}}">Ẩn</a>
                <?php
                } else { ?>
                <a href="{{URL::to('/active-post'.'/'.$post->id_article )}}">Hiện</a>
                <?php  } ?>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>
@endsection