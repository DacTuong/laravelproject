@php
    use Illuminate\Support\Facades\Session;

    $id = Session::get('id_customer');
    $name = Session::get('name_customer');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('user/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap Icons -->

    <!-- Link font-awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- Link font-awesome -->

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
</head>

<body>
    <div class="app">
        @include('user.header.header')
        <!-- Overlay -->
        <div id="overlay" class="overlay" onclick="closeAllOverlay()"></div>

        <!-- sidebar -->
        <div id="sidebar">
            <!-- Nội dung sidebar -->

            <!-- <div class="sidebar-header">
                <a href="" class="user-customer-sidebar" onclick="openSidebar()">
                    <img src="{{ URL::to('user/image/avatar-user.png') }}" alt="">
                    {{ Session::get('name_customer') }}
                </a>
                <button class="close-sidebar" onclick="closeSidebar()">X</button>
            </div>

            <div class="sidebar-body">
                <ul class="sidebar-content">
                    <li> <a href="{{ URL::to('/thong-tin-ca-nhan') }}">Thông tin khách hàng</a></li>
                    <li> <a href="{{ URL::to('/cart') }}">Giỏ hàng</a></li>
                    <li> <a href="{{ URL::to('/checkout') }}">Thanh toán</a></li>
                    <li> <a href="{{ URL::to('/wishlist') }}">Danh sách yêu thích</a></li>
                    <li> <a href="{{ URL::to('/history-order') }}">Lịch sử mua hàng</a></li>
                    <li> <a href="{{ URL::to('/setting') }}">Cài đặt</a></li>
                    <li> <a href="{{ URL::to('/logout') }}">Đăng xuất</a></li>
                </ul>
            </div>  -->

        </div>
        <!-- sidebar -->

        <div class="app_container">
            <div class="container-xl">
                @yield('content')

            </div>
        </div>

        <footer class="footer">
            <div class="container-xl">
                <div class="row">
                    <div class="col-sm-3">
                        <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">Trung tâm trợ giúp</a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">TickId Mail</a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">Hướng dẫn mua hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h3 class="footer__heading">Giới thiệu</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">Giới thiệu về tickID</a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">Tuyển dụng</a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">Điều khoản</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-3">
                        <h3 class="footer__heading">Theo dõi</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">
                                    <i class="footer-item__link-icon fa-brands fa-facebook"></i>
                                    <span>Facebook</span>
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">
                                    <i class="footer-item__link-icon fa-brands fa-instagram-square"></i>
                                    <span>Instargram</span>
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item__link">
                                    <i class="footer-item__link-icon fa-brands fa-linkedin"></i>
                                    <span>Linkedin</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('user/js/toastr.js') }}"></script>

    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Xử lý dropdown trên mobile (toggle khi nhấn)
            const productDropdown = document.getElementById("productDropdown");
            const productDropdownMenu = document.getElementById("productDropdownMenu");

            productDropdown.addEventListener("click", function(e) {
                if (window.innerWidth <= 991) { // Chỉ hoạt động trên mobile
                    e.preventDefault();
                    productDropdownMenu.classList.toggle("show");
                }
            });

            // Ẩn dropdown menu khi nhấn bên ngoài (trên mobile)
            document.addEventListener("click", function(event) {
                if (!productDropdown.contains(event.target)) {
                    productDropdownMenu.classList.remove("show");
                }
            });
        });
    </script>

    <script>
        function updateCheckboxFilter(filterName, element) {
            // Lấy giá trị checkbox được thay đổi
            const value = element.value;

            // Lấy URL hiện tại
            const currentUrl = new URL(window.location.href);

            // Lấy danh sách giá trị hiện có trong URL
            let filterValues = currentUrl.searchParams.get(filterName) ?
                currentUrl.searchParams.get(filterName).split(',') : [];

            if (element.checked) {
                // Nếu checkbox được chọn, thêm giá trị nếu chưa có
                if (!filterValues.includes(value)) {
                    filterValues.push(value);
                }
            } else {
                // Nếu checkbox bị bỏ chọn, xóa giá trị khỏi danh sách
                filterValues = filterValues.filter(val => val !== value);
            }

            // Cập nhật giá trị cho tham số URL hoặc xóa nếu rỗng
            if (filterValues.length > 0) {
                currentUrl.searchParams.set(filterName, filterValues.join(','));
            } else {
                currentUrl.searchParams.delete(filterName);
            }

            // Reload trang với URL mới
            window.location.href = currentUrl.toString();
        }

        function updateFilter(param, value) {
            let url = new URL(window.location.href);
            if (value === "none") {
                url.searchParams.delete(param);
            } else {
                url.searchParams.set(param, value);
            }
            window.location.href = url.toString();
        }

        function openSpecifications() {
            // Hiển thị overlay bằng cách thay đổi display thành block
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('specifications-popup').style.display = 'block';
        }

        function closeSpecifications() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('specifications-popup').style.display = 'none';
        }

        // mở overlay và  review popup
        function openReviewPopup() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('review-form-popup').style.display = 'block';
        }
        // đóng overlay và  review popup
        function closeReviewPopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('review-form-popup').style.display = 'none';

        }

        function openReviewPopup2() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('boxReview-popup').style.display = 'block';
        }

        function closeReviewPopup2() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('boxReview-popup').style.display = 'none';
        }


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
        };
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->



    <script src="{{ asset('user/js/select_shipping.js') }}"></script>


    <script src="{{ asset('user/js/ajax.js') }}"></script>


    <script>
        $(document).ready(function() {
            function checkReason() {
                var reason4 = $('.reason4');
                var reasonTextarea = $('.reason_cancellation');
                var sendButton = $('.send-cancel-resson');

                var isOtherChecked = reason4.length && reason4.prop('checked');
                var isTextareaEmpty = reasonTextarea.length && reasonTextarea.val().trim() === '';

                if (isOtherChecked && isTextareaEmpty) {
                    sendButton.addClass('dab').prop('disabled', true);
                } else {
                    sendButton.removeClass('dab').prop('disabled', false);
                }
            }

            $('input[name="reason"]').on('change', checkReason);
            $('.reason_cancellation').on('input', checkReason);
            checkReason();
        });


        $(document).ready(function() {
            // Ẩn textarea khi trang được tải
            $(".reason_cancellation").hide();
            $("input[name='reason']").change(function() {
                if ($(".reason4").is(":checked")) {
                    $(".reason_cancellation").show();
                } else {
                    $(".reason_cancellation").hide();
                }
            });



        });




        $(document).on('click', '.send-cancel-resson', function(e) {
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            let selectedReason = document.querySelector('input[name="reason"]:checked').value;
            let otherReason = document.querySelector('.reason_cancellation').value.trim();
            let order_code = document.querySelector('.order_code').textContent.trim();
            var message = selectedReason === "Khác" ? `${otherReason}` : `${selectedReason}`
            $.ajax({
                url: '/cancel-order',
                method: 'POST',
                data: {
                    order_code: order_code,
                    cancel_reason: message,
                    _token: _token,
                },
                success: function() {
                    // alert('Gửi lý do thành công')
                    location.reload();

                },
                error: function(err) {
                    console.error("Đã có lỗi xảy ra", err);
                },
            });
        });

        $(document).on("click", ".cancel-order", function(e) {
            e.preventDefault();
            // alert('Bạn đã ấn nút hủy đơn hàng');
            $(".model-cancel-order").addClass("show");
            $(".overlay").addClass("show");
        })



        $(document).on('click', '.close-model', function(e) {
            e.preventDefault();
            $(".model-cancel-order").removeClass("show");
            $(".overlay").removeClass("show");
            $(".reason1").prop("checked", true);
            $(".reason_cancellation").val("");
            $(".reason_cancellation").hide();
        })




        document.querySelectorAll('.option-version').forEach(item => {
            item.addEventListener('click', function() {
                let storageValue = this.getAttribute('data-value');
                // alert(storageValue);
                let url = new URL(window.location);
                url.searchParams.delete('sku')
                url.searchParams.set('storage', storageValue);
                window.location.href = url.toString();
                // Chuyển hướng trang với URL mới
            });
        });

        document.querySelectorAll('.brand').forEach(item => {
            item.addEventListener('click', function() {
                let brandValue = this.getAttribute('data-brand');

                let baseURL = window.location.origin + window.location.pathname;
                let newURL = new URL(baseURL);
                // alert(newURL);
                newURL.searchParams.set('brand', brandValue)
                window.location.href = newURL.toString();
                // let url = new URL(window.location);
                // url.searchParams.set('brand', brandValue);
                // window.location.href = url;
            });
        });

        document.querySelectorAll('.color-item').forEach(color => {
            color.addEventListener('click', function() {
                let colorValue = this.getAttribute('data-id');
                let url = new URL(window.location);
                url.searchParams.set('sku', colorValue);
                window.location.href = url;
            })
        });




        $(document).ready(function() {
            // Mặc định
            let min = 0;
            // alert(min);
            let max = 200000000;

            const urlParams = new URLSearchParams(window.location.search);
            const minPrice = urlParams.get('min_Price');
            const maxPrice = urlParams.get('max_Price');



            // Nếu có giá trị từ URL, gán lại
            if (minPrice !== null && maxPrice !== null) {
                min = parseInt(minPrice);
                max = parseInt(maxPrice);
                let formatMin = min.toLocaleString('vi-VN')
                let formatMax = max.toLocaleString('vi-VN')
                $("#min_price").val(formatMin);
                $("#max_price").val(formatMax);
            }

            $(document).on("input", "#min_price, #max_price", function() {
                let min = $("#min_price").val();
                let max = $("#max_price").val();
                min = min.replace(/\D/g, '');
                const formattedMin = Number(min).toLocaleString("vi-VN");

                max = max.replace(/\D/g, '');
                const formattedMax = Number(max).toLocaleString("vi-VN");
                // console.log("Giá vừa nhập:", min, max);
                $("#min_price").val(formattedMin);
                $("#max_price").val(formattedMax);

                $("#slider-range").slider("values", [Number(min), Number(max)]);

            })

            // Khởi tạo slider
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 200000000,
                values: [min, max],
                step: 100000,
                slide: function(event, ui) {
                    let formattedMin = ui.values[0].toLocaleString('vi-VN');
                    let formattedMax = ui.values[1].toLocaleString('vi-VN');
                    $("#min_price").val(formattedMin);
                    $("#max_price").val(formattedMax);
                }
            });

            // Hiển thị giá trị ban đầu (trường hợp không có URL)
            const defaultMin = $("#slider-range").slider("values", 0);
            const defaultMax = $("#slider-range").slider("values", 1);
            const formatNumMin = defaultMin.toLocaleString('vi-VN');
            const formatNumMax = defaultMax.toLocaleString('vi-VN');
            $("#min_price").val(formatNumMin);
            $("#max_price").val(formatNumMax);



            $(document).on("click", ".price-submit", function(evn) {
                evn.preventDefault();
                const minPrice = $("#min_price").val();
                const maxPrice = $("#max_price").val();
                const noDotminPrice = minPrice.replaceAll(".", "");
                const noDotmaxPrice = maxPrice.replaceAll(".", "");

                const params = new URLSearchParams({
                    min_Price: noDotminPrice,
                    max_Price: noDotmaxPrice
                })
                const currentUrl = window.location.origin + window.location.pathname;
                window.location.href = `${currentUrl}?${params.toString()}`;
            });

        });
    </script>

    <!-- xữ lý tắt mở search & nav-menu -->
    <script>
        $(document).ready(function() {


            $(document).on('click', '.menu-toggle', function() {
                // $("#navbarNav").toggleClass("show");
                $(".nav-menu").toggleClass("show");
                $(".overlay").toggleClass("show");
            });

            $(document).on('click', '.search-toggle', function() {
                // alert("Bạn đã ấn nút toggle search")
                $(".responsiveSearch").toggleClass('show');
            });

            $(document).on("click", ".filter-toggle", function() {
                // alert('bạn đã click filter-toggle');
                $(".left-contaner").toggleClass('show');
                $(".overlay").toggleClass("show");
            });

            $(document).on("click", ".overlay", function() {
                if ($(this).hasClass("show")) {
                    $(".left-contaner").removeClass('show');
                    $(".nav-menu").removeClass('show');
                    $(this).removeClass("show");
                }

            });

        })
    </script>

    <script>
        $(document).ready(function() {
            const slider = $(".slider");
            const images = $(".slider img");
            const totalImage = images.length;
            const widthImage = images.width();
            let index = 0;

            function nextSlide() {
                index++;

                if (index >= totalImage) {
                    index = 0;
                }
                images.css("transform", `translateX(-${index * widthImage}px)`);

                // const test = index * widthImage;
                // console.log(test);
            }

            function previousSlide() {
                index--;
                if (index < 0) {
                    index = totalImage - 1; // Chỉ số ảnh cuối cùng
                }
                images.css("transform", `translateX(-${index * widthImage}px)`);

                // const test = index * widthImage;
                // console.log(test);
            }

            let startX = 0,
                endX = 0;



            $(".slide-pre").on("click", function() {
                previousSlide();
            })

            $(".slide-next").on("click", function() {
                nextSlide();
            })

            function handleSwipe() {
                const driff = startX - endX;
                if (Math.abs(driff) > 50) {
                    if (driff > 0) {
                        nextSlide();
                    } else {
                        previousSlide();
                    }
                }
            }

            $(".slider").on("touchstart", function(e) {
                startX = e.originalEvent.touches[0].clientX; // Lấy vị trí ngón tay bắt đầu
                // console.log("startX:", startX); 
                // In ra giá trị startX
            });

            $(".slider").on("touchend", function(e) {
                endX = e.originalEvent.changedTouches[0].clientX; // Lấy vị trí ngón tay kết thúc
                // console.log("endX:", endX); 
                // In ra giá trị endX
                handleSwipe();
            });

            setInterval(nextSlide, 4000);

        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>




</body>

</html>
