@extends('master')

@section('title')
	Chosen - {{ $customers->name }}
@endsection

@section('content')

<section id="cart_items">
	<h2 class="title text-center">Sản phẩm yêu thích của {{ $customers->name }} </h2>
	<?php alert($errors , session('Success')) ?>
	<div class="">
		<div class="review-payment" style="margin-bottom:30px; ">
			@if(count($chosen) == 0)
				<h2>Bạn chưa thích sản phẩm nào</h2>
			@else
				<div class="features_items"><!--features_items-->
				    @foreach($chosen as $cs)
				        <div class="col-sm-4">
				            <div class="product-image-wrapper">
				                <div class="single-products">
			                        <div class="productinfo text-center">
			                            <img src="{{URL::to('public/uploads/products/' . $cs->product->image)}}" alt="" />
			                            @if($cs->product->sale_price != 0)
			                                <h2>{{ number_format($cs->product->sale_price) . ' đ' }}</h2>
			                                <p>{{ $cs->product->name }} <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></p>
			                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Tiết kiệm đến {{ round(100 - ($cs->product->sale_price * 100 / $cs->product->unit_price)) }}%</a>
			                            @else
			                                <h2>{{ number_format($cs->product->unit_price) . ' đ' }}</h2>
			                                <p>{{ $cs->product->name }}</p>
			                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Không khuyến mãi</a>
			                            @endif
			                            
			                        </div>
			                        <div class="product-overlay">
			                            <div class="overlay-content">
			                                @if($cs->product->sale_price != 0)
			                                    <strike><span style="font-size: 18px;">{{ number_format($cs->product->unit_price) . ' đ' }}</span></strike><br>
			                                    <h2>{{ number_format($cs->product->sale_price) . ' đ' }}</h2>
			                                    <p>Đang khuyến mãi</p>
			                                @else
			                                    <h2>{{ number_format($cs->product->unit_price) . ' đ' }}</h2>
			                                @endif                               
			                                <p><a href="{{URL::to('/chi-tiet-san-pham/' . $cs->product->id . '/' .$cs->product->slug)}}">{{ $cs->product->name }}</a></p>
			                                <a href="{{URL::to('/chi-tiet-san-pham/' . $cs->product->id . '/' .$cs->product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Xem sản phẩm</a>
			                            </div>
			                        </div>
			                        @if($cs->product->sale_price != 0)
			                            <img class="new" src="{{ URL::to('public/frontend/images/sale.png') }}">
			                        @endif
				                </div>
				                <div class="choose" style="text-align: center;">
				                    <form action="{{ URL::to('/chosen/cancel/' . Session::get('id')) }}" method="POST" >
				                        {{ csrf_field() }}
				                        <input type="hidden" name="customers_id" value="{{ Session::get('id') }}">
				                        <input type="hidden" name="product_id" value="{{ $cs->product->id }}">
				                        <button style="background:  #FE980F;" type="submit" class="btn btn-warning">Bỏ thích sản phẩm</button>
				                    </form> 
				                </div>
				            </div>
				        </div>
				    @endforeach                
				</div>
			@endif
		</div>	
	</div>
</section> <!--/#cart_items-->

@endsection
