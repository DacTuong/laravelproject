@extends('admin_layout')
@section('admin_content')
<form action="" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}


    <div class="form-group">
        <label for="">Loại sản phẩm</label>
        <select name="" id="">
            <option value="">Vui lòng lựa chọn hãng</option>
            @foreach ($categories as $category )
            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>
    <br>
    <button class="add-select">Thêm lựa chọn</button>
    <div id="select-container"></div>
    <br>

    <input type="submit" name="" id="">
</form>
@endsection