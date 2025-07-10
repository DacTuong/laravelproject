@extends('layout')
@section('content')
    <div class="breadcrumbs">
        <a class="breadcrumb-item" href="{{ URL::to('/') }}">Trang chủ</a>
        <span class="breadcrumb-separator"> > </span>
        <a href="{{ URL::to('/' . $cate->cate_slug) }}" class="breadcrumb-item"> {{ $cate->category_name }}</a>
        <span class="breadcrumb-separator"> > </span>
        <a href="{{ URL::to('/' . $cate->cate_slug . '/' . $currentBrand->brand_slug) }}"
            class="breadcrumb-item">{{ $currentBrand->brand_name }} </a>
    </div>

    <div class="home-product">
        <div class="left-container">
            <div class="brand-relation">
                <div>
                    <b>Thương hiệu</b>
                </div>
                <div class="slick-padding">

                    <div class="v5-brand-list">
                        @foreach ($relations as $brand_relate)
                            <div>
                                <a
                                    href="{{ URL::to('/' . $brand_relate->cate->cate_slug . '/' . $brand_relate->brand->brand_slug) }}">
                                    {{ $brand_relate->brand->brand_name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="filter-item">
                <b>Cart đồ họa</b>
                @foreach ($GPUs as $gpu)
                    <label>
                        <input type="checkbox" name="filter_laptop_gpu" value="{{ $gpu->laptop_gpu_integrated }}"
                            {{ in_array($gpu->laptop_gpu_integrated, explode(',', request()->get('filter_laptop_gpu', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_laptop_gpu', this)">
                        {{ $gpu->laptop_gpu_integrated }}
                    </label><br>
                @endforeach
            </div>

            <div class="filter-item">
                <b>Dung lượng ram</b><br>
                @foreach ($laptop_rams as $laptop_ram)
                    <label>
                        <input type="checkbox" name="filter_laptop_ram" value="{{ $laptop_ram->laptop_ram }}"
                            {{ in_array($laptop_ram->laptop_ram, explode(',', request()->get('filter_laptop_ram', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_laptop_ram', this)">
                        {{ $laptop_ram->laptop_ram }}
                    </label><br>
                @endforeach
            </div>

            <div class="filter-item">
                <b>Bộ nhớ trong</b>
                <br>
                @foreach ($laptop_storages as $laptop_storage)
                    <label>
                        <input type="checkbox" name="filter_laptop_storage" value="{{ $laptop_storage->laptop_storage }}"
                            {{ in_array($laptop_storage->laptop_storage, explode(',', request()->get('filter_laptop_storage', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_laptop_storage', this)">
                        {{ $laptop_storage->laptop_storage }}
                    </label><br>
                @endforeach
            </div>

            <div class="filter-item">
                <b>Công nghệ cpu</b>
                <br>
                @foreach ($CPUs as $cpu)
                    <label>
                        <input type="checkbox" name="filter_laptop_cpu" value="{{ $cpu->laptop_cpu }}"
                            {{ in_array($cpu->laptop_cpu, explode(',', request()->get('filter_laptop_cpu', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_laptop_cpu', this)">
                        {{ $cpu->laptop_cpu }}
                    </label>
                @endforeach
            </div>

            <div class="filter-item">
                <b>Tần số quét</b>
                <br>
                @foreach ($laptop_refreshs as $laptop_refresh)
                    <label>
                        <input type="checkbox" name="filter_laptop_refresh_rates"
                            value="{{ $laptop_refresh->laptop_display_refresh_rate }}"
                            {{ in_array($laptop_refresh->laptop_display_refresh_rate, explode(',', request()->get('filter_laptop_refresh_rates', ''))) ? 'checked' : '' }}
                            onchange="updateCheckboxFilter('filter_laptop_refresh_rates', this)">
                        {{ $laptop_refresh->laptop_display_refresh_rate }}
                    </label><br>
                @endforeach

            </div>

            <div class="filter-item">
                <b>Giá bán</b>
                <br>
                <label>
                    <input type="checkbox" name="filter_price" value="1000000-5000000"
                        {{ in_array('1000000-5000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_price', this)">
                    1 đến 5 triệu
                </label><br>
                <label>
                    <input type="checkbox" name="filter_price" value="5000000-10000000"
                        {{ in_array('5000000-10000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_price', this)">
                    5 đến 10 triệu
                </label><br>
                <label>
                    <input type="checkbox" name="filter_price" value="10000000-15000000"
                        {{ in_array('10000000-19000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_price', this)">
                    10 đến 15 triệu
                </label><br>
                <label>
                    <input type="checkbox" name="filter_price" value="15000000-20000000"
                        {{ in_array('15000000-20000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_price', this)">
                    15 đến 20 triệu
                </label><br>
                <label>
                    <input type="checkbox" name="filter_refresh_rates" value="20000000-25000000"
                        {{ in_array('20000000-25000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_price', this)">
                    29 đến 25 triệu
                </label><br>
                <label>
                    <input type="checkbox" name="filter_price" value="25000000-30000000"
                        {{ in_array('25000000-30000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_price', this)">
                    25 đến 30 triệu
                </label><br>
                <label>
                    <input type="checkbox" name="filter_price" value=">30000000"
                        {{ in_array('>30000000', explode(',', request()->get('filter_price', ''))) ? 'checked' : '' }}
                        onchange="updateCheckboxFilter('filter_price', this)">
                    Trên 30000000 triệu
                </label><br>

            </div>
        </div>
        <div class="body-content">
            <div class="filter-tool">
                <div class="btn-filter d-lg-none">
                    <button class="filter-toggle">
                        <i class="bi bi-filter-right"></i> Lọc
                    </button>
                </div>
                <div>
                    <label for="">sắp xếp</label>
                    <select name="sort_by" id="sort_by" onchange="updateFilter('sort_by', this.value)">
                        <option value="none" {{ request()->get('sort_by') == 'none' ? 'selected' : '' }}>--Sắp xếp--
                        </option>
                        <option value="tang_dan" {{ request()->get('sort_by') == 'tang_dan' ? 'selected' : '' }}>--
                            Giá tăng
                            dần--</option>
                        <option value="giam_dan" {{ request()->get('sort_by') == 'giam_dan' ? 'selected' : '' }}>--
                            Giá giảm
                            dần--</option>
                    </select>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </div>
@endsection
