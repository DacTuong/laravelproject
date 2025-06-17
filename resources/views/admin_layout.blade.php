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




    <!-- DataTables core -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <!-- DataTables Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

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

            let $btn_close = $(' <button class="remove-group" title="Xóa mục này"> X </button>')

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
                    // console.log(brands);

                    let $select = $('<select name="brand_id[]" class="form-control"></select>');
                    $select.append('<option value="">-- Chọn hãng --</option>');
                    $select.append(brands);

                    $formGroup.append($label);
                    $formGroup.append($btn_close);
                    $formGroup.append($select);

                    // Thêm vào thẻ chứa
                    $('#select-container').append($formGroup);
                },
                error: function() {
                    alert("Không thể tải danh sách hãng từ server.");
                }
            });
        });

        // $(document).on('click', '.add-select', function(e) {
        //     e.preventDefault();

        //     // Tạo thẻ <div class="form-group">
        //     let $formGroup = $('<div class="form-group"></div>');

        //     // Nút xóa
        //     let $btn_close = $('<button class="remove-group" title="Xóa mục này"> X </button>');

        //     // Label
        //     let $label = $('<label for="brand_input">Chọn Thương Hiệu:</label>');

        //     // Tạo input và datalist rỗng ban đầu
        //     let $input = $('<input type="text" name="brand_name[]" class="form-control" list="brand_datalist">');
        //     let $datalist = $('<datalist id="brand_datalist"></datalist>');

        //     // Ajax lấy dữ liệu
        //     $.ajax({
        //         url: "/get-brands",
        //         method: "GET",
        //         dataType: 'json',
        //         success: function(brands) {
        //             // brands nên là mảng [{id:..., name:...}, ...] hoặc chỉ tên
        //             console.log(brands);
        //             $datalist.append(brands);
        //             $formGroup.append($label);
        //             $formGroup.append($btn_close);
        //             $formGroup.append($input);
        //             $formGroup.append($datalist);

        //             // Thêm form-group vào vùng chứa
        //             $('#select-container').append($formGroup);
        //         },
        //         error: function() {
        //             alert("Không thể tải danh sách hãng từ server.");
        //         }
        //     });
        // });


        // Bắt sự kiện xóa form-group
        $(document).on('click', '.remove-group', function(e) {
            e.preventDefault();
            $(this).closest('.form-group').remove();
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
        const slug = valueSlugSource.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd')
            .replace(/Đ/g, 'D')
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-');

        const targetKey = $(this).data('slug-source');
        $('[data-slug-target="' + targetKey + '"]').val(slug);
    });
});
    </script>
    {{-- Jquery data DataTable


    <!-- ✅ jQuery (bắt buộc phải có trước khi gọi DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- ✅ DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- ✅ Các Plugin mở rộng của DataTables -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <!-- ✅ Thư viện hỗ trợ xuất Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- ✅ Thư viện hỗ trợ xuất PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- ✅ Plugin hỗ trợ giao diện Responsive -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    --}}
    <script>
        // $(function() {
        //     $("#example1").DataTable({
        //         "responsive": true,
        //         "lengthChange": false,
        //         "autoWidth": false,
        //         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        //     "columnDefs": [{
        //             "orderable": false,
        //             "targets": [2, 9]
        //         }, // Hình ảnh & Quản lý không sắp xếp
        //     ]
        // });
        // });
    </script>


</body>


</html>