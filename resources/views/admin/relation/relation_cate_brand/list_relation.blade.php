@extends('admin_layout')

@section('admin_content')
<h1>Danh sách loại sản phẩm theo hãng</h1>


<div>
    <a href="{{ URL::to('/add-relation') }}">Thêm liên kết</a>
</div>
@endsection