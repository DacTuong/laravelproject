<header>
    <div class="main-header">
        <div class="container">
            <!-- header with search -->
            <div class="header-nav">
                <div class="row align-items-center" style="margin:0;">
                    <div class="col-2 col-lg-2 order-1 order-lg-1" style="border:1px solid black">
                        <a href="{{URL::to('/')}}" class="header__logo-home">
                            <img class="img-style" src="{{ URL::to('/user/image/logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12 col-lg-7 order-3 order-lg-2 mt-3 mt-lg-0" style="border:1px solid red">
                        <div class="box__search">
                            <form action="{{URL::to('/search')}}" method="POST">
                                {{csrf_field()}}
                                <div class="box__search-input-warp">
                                    <input type="text" class="box__search-input" name='keywords_search'
                                        placeholder="Nhập để tìm kiếm">
                                </div>
                                <button class="box__search-btn" type="submit" name="search">
                                    <i class="box__search-btn-icon fa-solid fa-magnifying-glass"></i>
                                    Tìm
                                </button>
                            </form>
                        </div>


                    </div>
                    <div class="col-10 col-lg-3 header-right order-2 order-lg-3 d-flex justify-content-end "
                        style="border:1px solid white">
                        <div class="customer">
                            @if (Session::get('id_customer'))
                            <!-- User is logged in -->
                            <p href="" class="user-customer" onclick="openSidebar()">
                                {{Session::get('name_customer')}}
                            </p>
                            @else
                            <!-- User is not logged in -->
                            <a href="{{ URL::to('/login-index') }}" class="sign-in-btn">Đăng nhập</a>
                            <a href="{{ URL::to('/register-index') }}" class="sign-up-btn">Đăng ký</a>
                            @endif

                        </div>
                        <div class="cart-row">
                            <a class="cart-link" href="{{URL::to('/cart')}}">
                                <img src="{{ URL::to('user/image/shopping-cart.png' ) }}" alt="">
                                <span class="quantity_cart" id="quantity-cart">
                                </span>
                                <span class="cart-title">Giỏ hàng</span>
                            </a>
                            <div class="cart-content">
                                <div class="cardHeaderContainer">

                                    <div class="cart-view">
                                        <div class="title_cart_hea">
                                            Giỏ hàng
                                        </div>
                                        <div>
                                            <div class="row info hover-cart-item" style="margin: 0;">
                                                <div class="col-md-3 imageProduct col-3" style="border:1px solid black">
                                                    <img src="https://shopdidong.vn/profiles/shopdidongvn/uploads/attach/1669244328_galaxy-s21-ultrmain7791020png.webp"
                                                        alt="">
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <span>Samsung Galaxy S21 Ultra 5G</span>
                                                </div>
                                                <div class="col-md-3 col-3">
                                                    <span>Số lượng</span>
                                                    <br>
                                                    <span>x1</span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="nav-heading-container">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    </div>

</header>