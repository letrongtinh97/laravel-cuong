@extends('master')

@section('title')
	Thanh toán	
@endsection

@section('content')

<section id="cart_items">
	<h2 class="title text-center">Đặt hàng thành công</h2>
	<?php alert($errors , session('Success')) ?>
	<div class="">
		<div class="review-payment" style="margin-bottom:30px; ">
			<h2>Cảm ơn bạn đã đặt hàng ở chỗ chúng tôi, chúng tôi sẽ liên hệ với bạn sớm nhất</h2>
		</div>
		
	</div>
</section> <!--/#cart_items-->

@endsection
