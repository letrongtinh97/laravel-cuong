<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-Shopper | @yield('title')</title>
    <base href="{{ asset('')}}">
    <link href="public/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/frontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="public/frontend/css/prettyPhoto.css" rel="stylesheet">
    <link href="public/frontend/css/price-range.css" rel="stylesheet">
    <link href="public/frontend/css/animate.css" rel="stylesheet">
    <link href="public/frontend/css/main.css" rel="stylesheet">
    <link href="public/frontend/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="public/frontend/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 36 58 89 218</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> ironman931997@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}"><img src="{{('public/frontend/images/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                @if(Session::get('id'))
                                    <li><a href="{{ URL::to('/account/' . Session::get('id')) }}"><i class="fa fa-user"></i> {{ Session::get('name') }}</a></li>
                                    <li><a href="{{ URL::to('/chosen/' . Session::get('id')) }}"><i class="fa fa-star"></i> Yêu thích</a></li>
                                    @if(Session::get('checkout_id'))
                                        @if(count(Cart::content()) == 0)
                                            <li>
                                                <a href="{{URL::to('/checkout-show')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{URL::to('/payment-show')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                                            </li>
                                        @endif
                                    @else
                                        <li>
                                            <a href="{{URL::to('/checkout-show')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                                        </li>
                                    @endif
                                    @if(count(Cart::content()) > 0)
                                        <li>
                                            <a href="{{URL::to('/cart-show')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng<sup style="color: red; font-size: 12px;">{{count(Cart::content())}}</sup></a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{URL::to('/cart-show')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                                        </li>
                                    @endif
                                    <li><a href="{{URL::to('/logout-customers')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                @else
                                    <li><a href="{{URL::to('/login-show')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                    <li><a href="{{URL::to('/cart-show')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                    <li><a href="{{URL::to('/login-show')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Danh mục sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $ct)
                                            <li><a href="{{URL::to('/danh-muc-san-pham/' . $ct->id . '/' . $ct->slug)}}">{{ $ct->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Thương hiệu sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($brand as $bd)
                                            <li><a href="{{URL::to('/thuong-hieu/' . $bd->id) . '/' . $bd->slug}}">{{ $bd->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <form action="{{ URL::to('/tim-kiem') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm"/>
                                <input style="margin-top: 0px; color: #FFF;" class="btn btn-sm btn-primary" type="submit" value="Tìm kiếm" name="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

