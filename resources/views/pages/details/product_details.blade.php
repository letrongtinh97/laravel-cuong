@extends('master')

@section('title')
    Sản phẩm - {{ $productDetail->name }}
@endsection

@section('content')

<div class="product-details"><!--product-details-->
	<?php alert($errors , session('Success')) ?>
	<div class="col-sm-5">
		<div class="view-product">
			<img src="{{URL::to('public/uploads/products/' . $productDetail->image)}}" alt="" />
			<h3>ZOOM</h3>
		</div>
		<div id="similar-product" class="carousel slide" data-ride="carousel">
			
			  <!-- Wrapper for slides -->
			    <div class="carousel-inner">
					<div class="item active">
					  <a href=""><img src="public/frontend/images/similar1.jpg" alt=""></a>
					  <a href=""><img src="public/frontend/images/similar2.jpg" alt=""></a>
					  <a href=""><img src="public/frontend/images/similar3.jpg" alt=""></a>
					</div>
				</div>

			  <!-- Controls -->
			  <a class="left item-control" href="#similar-product" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			  </a>
			  <a class="right item-control" href="#similar-product" data-slide="next">
				<i class="fa fa-angle-right"></i>
			  </a>
		</div>

	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			@if($productDetail->sale_price != 0)
				<img class="new" src="{{ URL::to('public/frontend/images/sale.png') }}">
				<h2>{{ $productDetail->name }} <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></h2>
				<p>Tiết kiệm đến {{ round(100 - ($productDetail->sale_price * 100 / $productDetail->unit_price)) }}%</p>
			@else
				<h2>{{ $productDetail->name }}</h2>
				<p>Hiện tại sản này không có chương trình khuyến mãi</p>
			@endif
			<img src="images/product-details/rating.png" alt="" /> 
			<form action="{{ URL::to('/cart-add') }}" method="POST" >
				{{ csrf_field() }}
				<span>
					<span>
						@if($productDetail->sale_price != 0)
							{{ number_format($productDetail->sale_price) . ' đ' }}
							<p>
								<strike style="color: black; font-size: 20px;">
									{{ number_format($productDetail->unit_price) . ' đ' }}
								</strike>
							</p>
						@else
							{{ number_format($productDetail->unit_price) . ' đ' }}
						@endif
					</span>
					<label>Số lượng:</label>
					<input name="qty" type="number" min="1" value="1" />
					<input type="hidden" name="product_id" value="{{ $productDetail->id }}">
					<button type="submit" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Thêm vào giỏ hàng
					</button>
				</span>
				<select name="size" class="form-group">

                    @foreach($productDetail->size_details as $pzD)
                        <option  value="{{ $pzD->id }}">Size {{ $pzD->name }}</option>
                    @endforeach
                </select>
                <select name="color" class="form-group">
                    @foreach($productDetail->color_details as $pcD)
                        <option  value="{{ $pcD->id }}">Màu {{ $pcD->color->name }}</option>
                    @endforeach
                </select>
			</form>
			<p><b>Số lượt thích:</b> {{ count($proChosen) }} lượt thích</p>
			<p><b>Danh mục sản phẩm:</b> {{ $productDetail->category_product->name }}</p>
			<p><b>Thương hiệu:</b> {{ $productDetail->brand_product->name }}</p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
			<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details" >
			<div class="col-sm-12">{!! $productDetail->description !!}</div>
		</div>
		
		<div class="tab-pane fade" id="companyprofile" >
			<div class="col-sm-12">{!! $productDetail->content !!}</div>
		</div>

		<div class="tab-pane fade" id="reviews" >
			<p><b>VIết bình luận của bạn</b></p>	
			<form action="{{ URL::to('/chi-tiet-san-pham/' . $productDetail->id . '/' . $productDetail->slug) }}" method="POST">
				{{ csrf_field() }}
                    @if(Session::get('id'))
                        <input type="hidden" name="customers_id" value="{{ Session::get('id') }}">
                        <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
				        <input type="hidden" name="slug" value="{{ $productDetail->slug }}">
						<textarea name="content" ></textarea>
						<button type="submit" class="btn btn-default pull-right">Gửi bình luận</button>
					@else
						<textarea name="content" ></textarea>
						<button onclick="alertLogin()" type="button" class="btn btn-default pull-right">Gửi bình luận</button>
					@endif
				</form>
			<div class="col-sm-12" style="overflow-y: scroll;height: 400px; margin-top: 20px;">
				@foreach($commentPro as $cmt)
				<ul>
					<li><a href="#"><i class="fa fa-user"></i>{{ $cmt->customers->name }}</a></li>
					<li><a href="#"><i class="fa fa-clock-o"></i>{{ date('H:i:s' , strtotime($cmt->created_at)) }}</a></li>
					<li><a href="#"><i class="fa fa-calendar-o"></i>{{ date('d-m-Y'	, strtotime($cmt->created_at)) }}</a></li>
				</ul>
				<p>{{ $cmt->content }}</p>
				<hr>
				@endforeach
			</div>
		</div>		
	</div>
</div><!--/category-tab-->
<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Sản phẩm cùng tương tự</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				@foreach($productBrand1 as $pd1)	
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<a href="{{URL::to('/chi-tiet-san-pham/' . $pd1->id)}}">
                                        <img src="{{URL::to('public/uploads/products/' . $pd1->image)}}" alt="" />
                                    </a>
                                    @if($pd1->sale_price != 0)
                                        <h2>{{ number_format($pd1->sale_price) . ' đ' }}</h2>
                                        <p> <a href="{{URL::to('/chi-tiet-san-pham/' . $pd1->id)}}">{{ $pd1->name }}</a> <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></p>
                                    @else
                                        <h2>{{ number_format($pd1->unit_price) . ' đ' }}</h2>
                                        <p>
                                            <a href="{{URL::to('/chi-tiet-san-pham/' . $pd1->id)}}">{{ $pd1->name }}</a>
                                        </p>
                                    @endif
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			<div class="item">	
				@foreach($productBrand2 as $pd2)	
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<a href="{{URL::to('/chi-tiet-san-pham/' . $pd2->id)}}">
                                        <img src="{{URL::to('public/uploads/products/' . $pd2->image)}}" alt="" />
                                    </a>
                                    @if($pd2->sale_price != 0)
                                        <h2>{{ number_format($pd2->sale_price) . ' đ' }}</h2>
                                        <p> <a href="{{URL::to('/chi-tiet-san-pham/' . $pd2->id)}}">{{ $pd2->name }}</a> <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></p>
                                    @else
                                        <h2>{{ number_format($pd2->unit_price) . ' đ' }}</h2>
                                        <p>
                                            <a href="{{URL::to('/chi-tiet-san-pham/' . $pd2->id)}}">{{ $pd2->name }}</a>
                                        </p>
                                    @endif
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		  </a>
		  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		  </a>			
	</div>
</div><!--/recommended_items-->

@endsection