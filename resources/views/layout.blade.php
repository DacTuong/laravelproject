@php
use Illuminate\Support\Facades\Session;

$id = Session::get('id_customer');
$name = Session::get('name_customer')
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("user/css/base.css")}}">
    <link rel="stylesheet" href="{{asset("user/css/main.css")}}">
    <link rel="stylesheet" href="{{asset("user/css/toastr.css")}}">
    <link rel="stylesheet" href="{{asset("user/css/bootstrap.css")}}">

    <!-- Link font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link font-awesome -->
</head>

<body>
    <div class="app">
        @include('user.header.header')
        <!-- Overlay -->
        <div id="overlay" class="overlay" onclick="closeAllOverlay()"></div>

        <!-- sidebar -->
        <div id="sidebar">
            <!-- Nội dung sidebar -->

            <div class="sidebar-header">
                <a href="" class="user-customer-sidebar" onclick="openSidebar()">
                    <img src="{{ URL::to('user/image/avatar-user.png') }}" alt="">
                    {{Session::get('name_customer')}}
                </a>
                <button class="close-sidebar" onclick="closeSidebar()">X</button>
            </div>

            <div class="sidebar-body">
                <ul class="sidebar-content">
                    <li> <a href="{{ URL::to('/thong-tin-ca-nhan') }}">Thông tin khách hàng</a></li>
                    <li> <a href="{{URL::to('/cart')}}">Giỏ hàng</a></li>
                    <li> <a href="{{URL::to('/checkout')}}">Thanh toán</a></li>
                    <li> <a href="{{ URL::to('/wishlist') }}">Danh sách yêu thích</a></li>
                    <li> <a href="{{ URL::to('/history-order') }}">Lịch sử mua hàng</a></li>
                    <li> <a href="{{ URL::to('/setting') }}">Cài đặt</a></li>
                    <li> <a href="{{ URL::to('/logout') }}">Đăng xuất</a></li>
                </ul>
            </div>

        </div>
        <!-- sidebar -->

        <div class="app_container">
            <div class="container">
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

    <script src="{{asset("user/js/jquery-3.6.0.min.js")}}"></script>
    <script src="{{asset("user/js/sweetalert2.js")}}"></script>
    <script src="{{asset("user/js/toastr.js")}}"></script>

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
        // Mở sidebar
        function openSidebar() {
            // Hiển thị sidebar bằng cách đặt left về 0
            document.getElementById('sidebar').style.right = '0';
            // Hiển thị overlay bằng cách thay đổi display thành block
            document.getElementById('overlay').style.display = 'block';
        }

        // Đóng sidebar
        function closeSidebar() {
            // Hiển thị sidebar bằng cách đặt left về 0
            document.getElementById('sidebar').style.right = '-300px';
            // Hiển thị overlay bằng cách thay đổi display thành block
            document.getElementById('overlay').style.display = 'none';
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
        }
    </script>


    <script src="{{asset("user/js/select_shipping.js")}}"></script>


    <script src="{{asset('user/js/ajax.js')}}"></script>


    <script>
        $(document).on("click", ".cancel-order", function() {
            // alert('Bạn đã ấn nút hủy đơn hàng');
            $(".model-cancel-order").addClass("show");
            $(".overlay").addClass("show");
        })

        $(document).ready(function() {
            // Ẩn textarea khi trang được tải
            $(".reason_cancellation").hide();

            $("input[name='reason']").change(function() {
                if ($("#reason4").is(":checked")) {
                    $(".reason_cancellation").show();
                } else {
                    $(".reason_cancellation").hide();
                }
            });
        });
    </script>
</body>

</html>