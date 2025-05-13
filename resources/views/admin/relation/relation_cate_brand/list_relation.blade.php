@extends('admin_layout')

@section('admin_content')
<h1>Danh sách loại sản phẩm theo hãng</h1>
@php
use Illuminate\Support\Facades\Session;

$message_success = Session::get('message_success');
if ($message_success) {
echo '<p class="text-success">', $message_success, '</p>';
Session::put('message_success', null);
}
@endphp

<div>
    <a href="{{ URL::to('/add-relation') }}">Thêm liên kết</a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Tên thương hiệu</th>
        <th>Tên loại sản phẩm</th>
    </tr>
    @foreach ($brands as $relation)
    <tr>
        <td>{{ $relation->id }}</td>
        <td>{{ $relation->brand ? $relation->brand->brand_name : 'Không có' }}</td>
        <td>{{ $relation->cate ? $relation->cate->category_name : 'Không có' }}</td>
    </tr>
    @endforeach
</table>


@endsection