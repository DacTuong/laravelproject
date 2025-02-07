@extends('admin_layout')
@section('admin_content')
<table>
    <thead>
        <tr>
            <td>Hình ảnh</td>
            <td>Tên banner</td>
            <td>Tên sản phẩm</td>
            <td>Trạng thái</td>
            <td>Tác vụ</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($banners as $banner)
        <tr>
            <th>
                <img src="{{ URL::to('uploads/slide/' . $banner->banner_image) }}" alt="" style="height: 100px;">
            </th>
            <th>
                {{$banner->name_banner}}
            </th>
            <th>
                {{$banner->product_banner->product_name}}
            </th>
            <th>
                {{$banner->status_banner}}
            </th>
            <th>
                <?php
                if ($banner->status_banner == 2) {
                ?>
                <a href="{{URL::to('/inactive-banner'.'/'.$banner->id_banner )}}">Ẩn</a>
                <?php
                } else { ?>
                <a href="{{URL::to('/active-banner'.'/'.$banner->id_banner )}}">Hiện</a>
                <?php  } ?>
            </th>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection