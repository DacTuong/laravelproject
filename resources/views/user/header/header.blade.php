<header class="header">
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div style="border: 1px solid red;">
                <a href="{{URL::to('/')}}" class="header__logo-home">
                    <img class="img-style" src="{{ URL::to('/user/image/logo.png') }}" alt="">
                </a>
            </div>
            <!-- Phần tìm kiếm -->
            <div class="d-none d-lg-flex flex-grow-1 mx-3" style="border: 1px solid black;">
                <div class="box__search">
                    <form action="{{URL::to('/search')}}" method="POST">
                        {{csrf_field()}}
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
            <div class="d-flex align-items-center" style="border: 1px solid red;">
                <button class="desktop-only"><i class="bi bi-person"></i> Tài khoản </button>
                <div class="cart-row desktop-only">
                    <a class="cart-link" href="{{URL::to('/cart')}}">
                        <!-- <img src="{{ URL::to('user/image/shopping-cart.png' ) }}" alt=""> -->
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
                <button class="btn d-lg-none search-toggle"><i class="bi bi-search"></i></button>
                <button class="btn d-lg-none user-toggle"><i class="bi bi-person"></i></button>
                <a href="{{URL::to('/cart')}}" class=" btn d-lg-none">
                    <i class="bi bi-cart"></i>
                    <span class="badge bg-danger" id="quantity-cart"></span>
                </a>
                <button class="btn d-lg-none menu-toggle"><i class="bi bi-list"></i></button>
            </div>
        </div>
    </div>


    <div class="nav-menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="#">Trang chủ</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>