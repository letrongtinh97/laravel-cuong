@extends('master')

@section('title')
    Trang chủ
@endsection

@section('content')

<div class="features_items"><!--features_items-->
    <?php alert($errors , session('Success')) ?>
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach($productNew as $pd)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/products/' . $pd->image)}}" alt="" />
                        @if($pd->sale_price != 0)
                            <h2>{{ number_format($pd->sale_price) . ' đ' }}</h2>
                            <p>{{ $pd->name }} <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Tiết kiệm đến {{ round(100 - ($pd->sale_price * 100 / $pd->unit_price)) }}%</a>
                        @else
                            <h2>{{ number_format($pd->unit_price) . ' đ' }}</h2>
                            <p>{{ $pd->name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Không khuyến mãi</a>
                        @endif
                        
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            @if($pd->sale_price != 0)
                                <strike><span style="font-size: 18px;">{{ number_format($pd->unit_price) . ' đ' }}</span></strike><br>
                                <h2>{{ number_format($pd->sale_price) . ' đ' }}</h2>
                                <p>Đang khuyến mãi</p>
                            @else
                                <h2>{{ number_format($pd->unit_price) . ' đ' }}</h2>
                            @endif                               
                            <p><a href="{{URL::to('/chi-tiet-san-pham/' . $pd->id . '/' .$pd->slug)}}">{{ $pd->name }}</a></p>
                            <a href="{{URL::to('/chi-tiet-san-pham/' . $pd->id . '/' .$pd->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Xem sản phẩm</a>
                        </div>
                    </div>
                    @if($pd->sale_price != 0)
                        <img class="new" src="{{ URL::to('public/frontend/images/sale.png') }}">
                    @endif
                </div>
                <div class="choose" style="text-align: center;">
                    <form action="{{ URL::to('/chosen/' . Session::get('id')) }}" method="POST" >
                        {{ csrf_field() }}
                        @if(Session::get('id'))
                            <input type="hidden" name="customers_id" value="{{ Session::get('id') }}">
                            <input type="hidden" name="product_id" value="{{ $pd->id }}">
                            <button style="background:  #FE980F;" type="submit" class="btn btn-warning">Yêu thích sản phẩm</button>
                        @else
                            <button style="background:  #FE980F;" onclick="alertLogin()" type="button" class="btn btn-warning">Yêu thích sản phẩm</button>
                        @endif
                    </form>     
                </div>
            </div>
        </div>
    @endforeach                
</div><!--features_items-->

<div class="row" style="text-align: center;">{{ $productNew->links() }}</div>

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm đang khuyến mãi</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($productSale1 as $PS1)   
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL::to('/chi-tiet-san-pham/' . $PS1->id . '/' . $PS1->slug)}}">
                                        <img src="{{URL::to('public/uploads/products/' . $PS1->image)}}" alt="" />
                                    </a>
                                    @if($PS1->sale_price != 0)
                                        <h2>{{ number_format($PS1->sale_price) . ' đ' }}</h2>
                                        <p>
                                             <a href="{{URL::to('/chi-tiet-san-pham/' . $PS1->id . '/' . $PS1->slug)}}">{{ $PS1->name }}</a> <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span>
                                        </p>
                                    @else
                                        <h2>{{ number_format($PS1->unit_price) . ' đ' }}</h2>
                                        <p>
                                            <a href="{{URL::to('/chi-tiet-san-pham/' ). $PS1->id . '/' . $PS1->slug}}">{{ $PS1->name }}</a>
                                        </p>
                                    @endif
                                    <a href="{{URL::to('/chi-tiet-san-pham/' . $PS1->id . '/' .$PS1->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Xem sản phẩm</a>
                                </div>
                                @if($PS1->sale_price != 0)
                                    <img class="new" src="{{ URL::to('public/frontend/images/sale.png') }}">
                                @endif                               
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="item">
                @foreach($productSale2 as $PS2)  
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="{{URL::to('/chi-tiet-san-pham/'. $PS2->id . '/' . $PS2)}}">
                                        <img src="{{URL::to('public/uploads/products/' . $PS2->image)}}" alt="" />
                                    </a>
                                    @if($PS2->sale_price != 0)
                                        <h2>{{ number_format($PS2->sale_price) . ' đ' }}</h2>
                                        <p> <a href="{{URL::to('/chi-tiet-san-pham/' . $PS2->id . '/' . $PS2)}}">{{ $PS2->name }}</a> <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></p>
                                    @else
                                        <h2>{{ number_format($PS2->unit_price) . ' đ' }}</h2>
                                        <p>
                                            <a href="{{URL::to('/chi-tiet-san-pham/' . $PS2->id . '/' . $PS2)}}">{{ $PS2->name }}</a>
                                        </p>
                                    @endif
                                    <a href="{{URL::to('/chi-tiet-san-pham/' . $PS2->id . '/' .$PS2->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Xem sản phẩm</a>
                                </div>
                                @if($PS2->sale_price != 0)
                                    <img class="new" src="{{ URL::to('public/frontend/images/sale.png') }}">
                                @endif 
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