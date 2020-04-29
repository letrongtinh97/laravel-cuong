@extends('master')

@section('title')
    Login 
@endsection

@section('content')

<section id="form" style="margin-top: 0px !important; "><!--form-->
	<h2 class="title text-center">Đăng nhập hoặc Đăng ký mới</h2>
	<?php alert($errors , session('Success')) ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập</h2>
					<form action="{{URL::to('/login-customers')}}" method="POST">
						{{ csrf_field() }}
						<input type="email" name="email" placeholder="Nhập email" />
						<input type="password" name="password" placeholder="Nhập password"/>
						<span>
							<input type="checkbox" class="checkbox"> 
							Ghi nhớ đăng nhập
						</span>
						<button type="submit" class="btn btn-default">Đăng nhập</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">Hoặc</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>Đăng kí mới</h2>
					<form action="{{URL::to('/login-add')}}" method="POST">
						{{ csrf_field() }}
						<input type="text" name="name" placeholder="Nhập họ và tên của bạn"/>
						<input type="email" name="email" placeholder="Nhập email"/>
						<input type="password" name="password" placeholder="Nhập password"/>
						<input type="text" name="phone" placeholder="Nhập số điện thoại"/>
						<button type="submit" class="btn btn-default">Đăng kí</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection
