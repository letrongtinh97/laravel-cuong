<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Dashboard</title>
<base href="{{ asset('') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="public/backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="public/backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="public/backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="public/backend/css/font.css" type="text/css"/>
<link href="public/backend/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="public/backend/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="public/backend/css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="public/backend/js/jquery2.0.3.min.js"></script>
<script src="public/backend/js/raphael-min.js"></script>
<script src="public/backend/js/morris.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('admin/dashboard')}}" class="logo">
       ADMIN PAGE 
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        {{-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> --}}
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{('public/backend/images/2.png')}}">
                <span class="username">
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @endif

                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                @if(Auth::user()->level == 3)
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Admin</a></li>
                @elseif(Auth::user()->level == 2)
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Quản trị viên</a></li>
                @else
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Cộng tác viên</a></li>
                @endif
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end --> 
       
    </ul>
    <!--search & user info end-->
</div>
</header>