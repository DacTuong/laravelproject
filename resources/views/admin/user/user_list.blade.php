@extends('admin_layout')
@section('admin_content')
<h3>Danh sách người dùng</h3>
<table id="" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <td>Tên người dùng</td>
            <td>email người dùng</td>
            <td>Số điện thoại người dùng</td>
        </tr>
    </thead>
    <tbody>

        @foreach ( $users as $user)
        <tr>
            <th>
                {{$user->name_user}}
            </th>
            <th>
                {{$user->email_user}}
            </th>
            <th>
                {{$user->phone_user}}
            </th>
        </tr>
        @endforeach
    </tbody>
</table>






@endsection