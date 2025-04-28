@extends('admin_layout')
@section('admin_content')
<form action="{{URL::to('/update-brand'.'/'. $edit_brand->brand_id)}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label>Thương hiệu</label>
        <input type="text" class="form-control" data-slug-source="brand-edit" name="brand_name"
            value="{{ $edit_brand->brand_name}}">
    </div>

    <div class="form-group">
        <label>Thương hiệu</label>
        <select name="category_pro_id" class="form-control">
            @foreach ($category as $cate)
            <option value="{{ $cate->category_id }}"
                {{ $cate->category_id == $edit_brand->categories_pro_id ? 'selected' : '' }}>
                {{ $cate->category_name }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
</form>

@endsection