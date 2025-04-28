@extends('admin_layout')
@section('admin_content')
@php

use Illuminate\Support\Facades\Session;

$message_success = Session::get('message_success');
if ($message_success) {
echo '<p class="text-success">', $message_success, '</p>';
Session::put('message_success', null);
}

@endphp

<form action="{{URL::to('/save-brand')}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label>Thương hiệu</label>
        <input type="text" class="form-control" name="brand_name" data-slug-source="brand"
            placeholder="Nhập tên thương hiệu">
    </div>
    <div class="form-group">
        <label>Tình Trạng</label>
        <select name="category_pro_id" class="form-control">
            <option value="0">Vui lòng chọn loại</option>
            @foreach ($category as $cate )
            <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Tình Trạng</label>
        <select name="brand_status" class="form-control">
            <option value="1">Hiện</option>
            <option value="0">Ẩn</option>
        </select>
    </div>
    <button type="submit" name="add" class="btn btn-primary">Submit</button>
</form>
@endsection