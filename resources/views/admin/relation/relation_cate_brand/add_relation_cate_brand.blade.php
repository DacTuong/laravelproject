@extends('admin_layout')
@section('admin_content')
<form action="{{ URL::to('/save-relation') }}" method="POST">
    {{csrf_field()}}

    <div class="form-group">
        <label for="">Loại sản phẩm</label>
        <select name="cate_relation" id="" class="form-control">
            <option value="">Vui lòng lựa chọn hãng</option>
            @foreach ($categories as $category )
            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>
    <br>
    <button class="add-select">Thêm lựa chọn</button>
    <div id="select-container">
        <label>Thương hiệu</label>
    </div>
    <br>

    <input type="submit" name="save_relation" id="">
</form>
@endsection