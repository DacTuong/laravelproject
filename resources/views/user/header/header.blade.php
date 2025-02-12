<header>
    <div class="main-header">
        <div class="container-xl">
            <!-- header with search -->
            <div class="header-nav">
                <div class="row align-items-center" style="margin:0;">
                    <div class="col-8 col-lg-3 col-md-8">
                        <a href="{{URL::to('/')}}" class="header__logo-home">
                            <img class="img-style" src="{{ URL::to('/user/image/logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 ">
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
                    <div class="col-4 col-lg-5 col-md-4 header-right">
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
                                    <!-- <div class="cart-message">
                                        <img src="https://web.nvnstatic.net/tp/T0199/img/empty_cart.png?v=7" alt="">
                                        <p>Không có sản phẩm trong giỏ hàng của bạn</p>
                                    </div> -->

                                    <form action="">
                                        <div class="title_cart_hea">
                                            Giỏ hàng
                                        </div>
                                        <div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="nav-heading-container">
        <div class="container-xl">
            <div class="nav-sidebar">
                <div class="brand-container">
                    @foreach ( $brands as $brand )
                    <div class="brand-item">
                        <a href="{{URL::to('/show-brand-user'.'/'.$brand->brand_id)}}">{{$brand->brand_name}}
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

</header>