<header class="header">
    <div class="container-xl py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ URL::to('/') }}" class="header__logo-home">
                    <img class="img-style" src="{{ URL::to('/user/image/logo.png') }}" alt="">
                </a>
            </div>
            <!-- Phần tìm kiếm -->
            <div class="d-none d-lg-flex flex-grow-1 mx-4">
                <div class="box__search">
                    <form action="{{ URL::to('/search') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="box__search-input-warp">
                            <input type="text" class="box__search-input" name='keywords_search'
                                placeholder="Nhập để tìm kiếm">
                        </div>
                        <button class="box__search-btn" type="submit" name="search">
                            <!-- <i class="box__search-btn-icon fa-solid fa-magnifying-glass"></i> -->
                            <i class="bi bi-search"></i>
                            Tìm kiếm
                        </button>
                    </form>
                </div>
            </div>

            <!-- User& Cart hiển thị khi chế độ màn hình lớn -->
            <div class="d-flex align-items-center gap-3">
                <div class="desktop-only customer">
                    <button class="user-customer"><i class="bi bi-person"></i>
                        @if (Session::get('id_customer'))
                            {{ Session::get('name_customer') }}
                        @else
                            Tài khoản
                        @endif
                    </button>
                    <ul class="customer__sub">
                        <li class="customer__sub-item">
                            @if (Session::get('id_customer'))
                                <a href="{{ URL::to('/thong-tin-ca-nhan') }}" class="customer__sub-link">
                                    <i class="bi bi-person"></i>
                                    Thông tin khách hàng
                                </a>
                            @else
                                <a href="{{ URL::to('/login-index') }}" class="customer__sub-link"><i
                                        class="bi bi-box-arrow-in-right"></i> Đăng nhập</a>
                            @endif
                        </li>
                        <li class="customer__sub-item">
                            @if (Session::get('id_customer'))
                                <a href="{{ URL::to('/logout') }}" class="customer__sub-link">
                                    <i class="bi bi-box-arrow-in-left"></i>
                                    Đăng xuất
                                </a>
                            @else
                                <a href="{{ URL::to('/register-index') }}" class="customer__sub-link"><i
                                        class="bi bi-person-plus-fill"></i> Đăng ký</a>
                            @endif
                        </li>
                        <li class="customer__sub-item">
                            <a class="customer__sub-link" href="{{ URL::to('/thong-tin-ca-nhan/setting') }}"><i
                                    class="bi bi-gear"></i> Cài đặt</a>
                        </li>
                        <li class="customer__sub-item">
                            <a class="customer__sub-link" href="{{ URL::to('/history-order') }}"><i
                                    class="bi bi-clock-history"></i> Lịch sử mua hàng</a>
                        </li>
                        <li class="customer__sub-item">
                            <a href="" class="customer__sub-link"><i class="bi bi-heart"></i> Danh sách yêu
                                thích</a>
                        </li>
                    </ul>
                </div>
                <div class="cart-row desktop-only">
                    <a class="cart-link" href="{{ URL::to('/cart') }}">
                        <!-- <img src="{{ URL::to('user/image/shopping-cart.png') }}" alt=""> -->
                        <i class="bi bi-cart"></i>
                        <span class="quantity_cart" id="quantity-cart">
                        </span>
                        <span class="cart-title">Giỏ hàng</span>
                    </a>
                    <div class="cart-content">
                        <div class="cardHeaderContainer">

                        </div>
                    </div>
                </div>
            </div>


            <!-- phần toggle này sẽ ẩn khi màn hình bình thường và sẽ xuất hiện khi màn hình dưới 991px -->
            <div class="d-flex gap-2">
                <button class="d-lg-none search-toggle"><i class="bi bi-search"></i></button>

                <div class="customer">
                    <button class="d-lg-none user-toggle"><i class="bi bi-person"></i></button>
                    <ul class="customer__sub">
                        <li class="customer__sub-item">
                            @if (Session::get('id_customer'))
                                <a href="{{ URL::to('/thong-tin-ca-nhan') }}" class="customer__sub-link">
                                    <i class="bi bi-person"></i>
                                    Thông tin khách hàng
                                </a>
                            @else
                                <a href="{{ URL::to('/login-index') }}" class="customer__sub-link"><i
                                        class="bi bi-box-arrow-in-right"></i> Đăng nhập</a>
                            @endif
                        </li>
                        <li class="customer__sub-item">
                            @if (Session::get('id_customer'))
                                <a href="{{ URL::to('/logout') }}" class="customer__sub-link">
                                    <i class="bi bi-box-arrow-in-left"></i>
                                    Đăng xuất
                                </a>
                            @else
                                <a href="{{ URL::to('/register-index') }}" class="customer__sub-link"><i
                                        class="bi bi-person-plus-fill"></i> Đăng ký</a>
                            @endif
                        </li>
                        <li class="customer__sub-item">
                            <a class="customer__sub-link" href="{{ URL::to('/setting') }}">Cài đặt</a>
                        </li>
                        <li class="customer__sub-item">
                            <a class="customer__sub-link" href="{{ URL::to('/history-order') }}">Lịch sử mua hàng</a>
                        </li>
                        <li class="customer__sub-item">
                            <a href="" class="customer__sub-link"><i class="bi bi-heart"></i> Danh sách yêu
                                thích</a>
                        </li>
                    </ul>
                </div>

                <a class="cart-toggle d-lg-none d-flex" href="{{ URL::to('/cart') }}">
                    <i class="bi bi-cart"></i>
                    <span class="quantity_cart">
                    </span>
                </a>

                <button class="d-lg-none menu-toggle"><i class="bi bi-list"></i></button>
            </div>
        </div>
    </div>

    <div class="container-xl py-2 d-lg-none responsiveSearch" style="display:none;">
        <div class="box__search">
            <form action="{{ URL::to('/search') }}" method="POST">
                {{ csrf_field() }}
                <div class="box__search-input-warp">
                    <input type="text" class="box__search-input" name='keywords_search'
                        placeholder="Nhập để tìm kiếm">
                </div>
                <button class="box__search-btn" type="submit" name="search">
                    <i class="bi bi-search"></i>
                    Tìm kiếm
                </button>
            </form>
        </div>
    </div>

    <div class="nav-menu">
        <div class="container-xl">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="{{ URL::to('/') }}">Trang chủ</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="productDropdown"
                                    role="button">
                                    Sản phẩm
                                </a>
                                <ul class="dropdown-menu" id="productDropdownMenu">

                                    @foreach ($category as $cate_product)
                                        <li><a class="dropdown-item"
                                                href="{{ URL::to('/' . $cate_product->cate_slug) }}">{{ $cate_product->category_name }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>


</header>
