@php

use Illuminate\Support\Facades\Session;

$name = Session::get('admin_name');
$id = Session::get('admin_id')
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('/admin/css/bootstrap.css')}}" rel="stylesheet" />

    <!-- CUSTOM STYLES-->
    <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/custom_table.css')}}" rel="stylesheet" />


    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link font-awesome -->
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> -->
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img class="logo-shop" src="{{ URL::to('/admin/images/logo/logo.png') }}" alt="">
            </div>

        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <?php
                        if ($name) {
                            echo 'Welcome ' . $name;
                        }
                        ?>
                    </li>
                    <li>
                        <a class="active-menu" href="{{URL::to('/dashboard')}}"><i class="fa fa-dashboard fa-3x"></i>
                            Tổng quan</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Loại Sản phẩm<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL::to('/add-category-product')}}">Thêm Loại Sản Phẩm</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/list-category-product')}}">Danh Sách Loại Sản Phẩm</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Thương Hiệu Sản phẩm<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL::to('/add-brand')}}">Thêm Thương Hiệu Sản Phẩm</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/list-brand')}}">Danh Thương Hiệu Sản Phẩm</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"> </i> Sản phẩm<span class="fa arrow"> </span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL::to('/add-product')}}">Thêm Sản Phẩm</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/list-product')}}">Danh Sách Sản Phẩm</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"> </i> Phiếu giảm giá<span class="fa arrow">
                            </span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL::to('/add-discount-code')}}">Thêm phiếu giảm giá</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/list-coupons')}}">Danh Sách phiếu giảm giá</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"> </i> Slide<span class="fa arrow">
                            </span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL::to('/add-slide')}}">Thêm Slide</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/list-banner')}}">Danh Sách Slide</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{URL::to('/comments-index')}}"> <i class="fa-solid fa-comment"></i> Bình luận</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/list-relation')}}"> <i class="fa-solid fa-comment"></i>Danh mục sản phẩm
                            của từng hãng</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/order-view')}}">
                            <i class="fa fa-qrcode fa-3x"></i> Danh sách đơn hàng
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('/list-user')}}"><i class="fa-solid fa-user"></i> Tài khoản người
                            dùng</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"> </i> Bài viết<span class="fa arrow"> </span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{URL::to('/add-post')}}">Thêm bài viết</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/all-post')}}">Danh Sách bài viết</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div style="color: white; padding: 15px 50px 5px 50px;float: right; font-size: 16px;">

                            <a href="{{URL::to('/logout')}}" class="btn btn-danger square-btn-adjust">Logout</a>
                        </div>
                    </li>

                </ul>

            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        @yield('admin_content')
                    </div>
                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>


    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{asset('admin/js/jquery-1.10.2.js')}}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{asset('admin/js/jquery.metisMenu.js')}}"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="{{asset('admin/js/custom.js')}}"></script>

    <script src="{{asset('admin/js/jquery-3.6.0.min.js')}}"></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>

    <script>
    var editor = new FroalaEditor('#example');
    </script>

    <script>
    $(document).on('click', '.add-select', function(e) {
        e.preventDefault();
        // Tạo thẻ <div class="form-group">
        let $formGroup = $('<div class="form-group"></div>');

        // Tạo <label>
        let $label = $('<label for="brand_id">Chọn Thương Hiệu:</label>');

        // Tạo <select>
        let $select = $('<select name="brand_id[]" class="form-control" id="brand_id"></select>');

        // Thêm option mặc định
        $select.append('<option value="">-- Chọn hãng --</option>');
        $.ajax({
            url: "/get-brands",
            method: "GET",
            dataType: 'json',
            success: function(brands) {
                // kiểm tra có dữ liệu
                console.log(brands);

                let $select = $('<select name="brand_id[]" class="form-control"></select>');
                $select.append('<option value="">-- Chọn hãng --</option>');
                $select.append(brands); // HTML string từ server
                // $('#select-container').append($select);
                $formGroup.append($label);
                $formGroup.append($select);

                // Thêm vào thẻ chứa
                $('#select-container').append($formGroup);
            },
            error: function() {
                alert("Không thể tải danh sách hãng từ server.");
            }
        });
    });
    </script>

    <script>
    function filterOrders() {
        // Lấy giá trị từ các input
        const orderCode = document.getElementById('orderCode').value || ''; // Mặc định là rỗng
        const orderDate = document.getElementById('orderDate').value || ''; // Mặc định là rỗng
        const orderStatus = document.getElementById('orderStatus').value || ''; // Mặc định là 1 (Chờ xử lý)

        // Tạo URL mới với tất cả các tham số
        const params = new URLSearchParams({
            order_code: orderCode,
            order_date: orderDate,
            order_status: orderStatus
        });

        // Reload lại URL với tham số
        const currentUrl = window.location.origin + window.location.pathname;
        window.location.href = `${currentUrl}?${params.toString()}`;
    }
    </script>
    <script>
    $(document).ready(function() {
        $('.update-order').click(function() {
            var orderStatus = $('#order-status').val();
            var orderNote = $('#order-note').val();
            var orderCode = $('#order-code').val();
            var orderItem = document.getElementById('order-item').textContent;
            var _token = $('input[name="_token"]').val();
            var statusText = $("#order-status option:selected").text();

            $.ajax({
                url: "/update-status-order",
                method: 'POST',
                data: {
                    orderstatus: orderStatus,
                    orderreason: orderNote,
                    ordercode: orderCode,
                    orderitem: orderItem,
                    _token: _token
                },
                success: function(response) {
                    alert(response.message);
                    $('#current-order-status').text(statusText);

                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });
    });
    </script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->
    <!-- <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [{
                    year: '2008',
                    value: 20
                },
                {
                    year: '2009',
                    value: 10
                },
                {
                    year: '2010',
                    value: 5
                },
                {
                    year: '2011',
                    value: 5
                },
                {
                    year: '2012',
                    value: 20
                }
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        });
    </script> -->

    <script>
    $(document).ready(function() {
        $('.categories_product_id').change(function() {
            var id = $(this).val();
            $('.details-product').show();

            $('.details-product__item input, .details-product__item selected').removeAttr('required');


            $('.details-product__item').each(function() {
                if ($(this).data('details') == id) {
                    $(this).show();
                    $(`.details-product__item[data-details="${id}"] input, .details-product__item[data-details="${id}"] selected`)
                        .attr('required', true)
                } else {
                    $(this).hide();
                }
            });

            $.ajax({
                url: "{{url('/select-brand')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#brand_product').html(data);
                    // alert("id cate là " + data);
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('[data-slug-source]').on('input', function() {
            const valueSlugSource = $(this).val();
            // console.log(valueSlugSource);
            const slug = sourceVal.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/đ/g, 'd')
                .replace(/Đ/g, 'D')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');

            console.log(slug);
            // const targetKey = $(this).data('slug-source');
            // console.log(targetKey);
            $('[data-slug-target="' + targetKey + '"]').val(slug);
        });
    });
    </script>
</body>


</html>