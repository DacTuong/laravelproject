@extends('admin_layout')
@section('admin_content')
<table>
    <thead>
        <tr>
            <td>Số thứ tự</td>
            <td>Tên người dùng</td>
            <td>Bình luận</td>
            <td>Trả lời</td>

        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{$comment->cmt_name->name_user}}
            </td>
            <td>
                {{$comment->comment_text}}
            </td>

            <td>
                <form action="{{URL::to('/rep-comment'."/".$comment->id_comment)}}" method="POST">
                    @csrf
                    <textarea name="rep_comment" id="" class="rep_comment">
                    {{$comment->rep_comment}}
                    </textarea>
                    <br>
                    <button name="save_comment">Trả lời bình luận</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection