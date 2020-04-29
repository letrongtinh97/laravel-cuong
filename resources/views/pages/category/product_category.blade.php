@extends('master')

@section('title')
    Danh mục - {{ $productCateName->name }}
@endsection

@section('content')

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Danh mục {{ $productCateName->name }} - {{ $productCate->total() }} sản phẩm</h2>
    @if($productCate->total() == 0)
        <h3 style="text-align: center;">Không có sản phẩm nào thuộc danh mục {{ $productCateName->name }}</h3>
    @else
        @foreach($productCate as $pCate)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('public/uploads/products/' . $pCate->image)}}" alt="" />
                            @if($pCate->sale_price != 0)
                                <h2>{{ number_format($pCate->sale_price) . ' đ' }}</h2>
                                <p>{{ $pCate->name }} <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Tiết kiệm đến {{ round(100 - ($pCate->sale_price * 100 / $pCate->unit_price)) }}%</a>
                            @else
                                <h2>{{ number_format($pCate->unit_price) . ' đ' }}</h2>
                                <p>{{ $pCate->name }}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Không khuyến mãi</a>
                            @endif
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                @if($pCate->sale_price != 0)
                                    <strike><span style="font-size: 18px;">{{ number_format($pCate->unit_price) . ' đ' }}</span></strike><br>
                                    <h2>{{ number_format($pCate->sale_price) . ' đ' }}</h2>
                                    <p>Đang khuyến mãi</p>
                                @else
                                    <h2>{{ number_format($pCate->unit_price) . ' đ' }}</h2>
                                @endif                               
                                <p><a href="{{URL::to('/chi-tiet-san-pham/' . $pCate->id . '/' . $pCate->slug)}}">{{ $pCate->name }}</a></p>
                                <a href="{{URL::to('/chi-tiet-san-pham/' . $pCate->id . '/' . $pCate->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Xem sản phẩm</a>
                            </div>
                        </div>
                        @if($pCate->sale_price != 0)
                            <img class="new" src="{{ URL::to('public/frontend/images/sale.png') }}">
                        @endif
                    </div>
                    <div class="choose" style="text-align: center;">
                    <form action="{{ URL::to('/chosen/' . Session::get('id')) }}" method="POST" >
                        {{ csrf_field() }}
                        @if(Session::get('id'))
                            <input type="hidden" name="customers_id" value="{{ Session::get('id') }}">
                            <input type="hidden" name="product_id" value="{{ $pCate->id }}">
                            <button type="submit" style="background:  #FE980F;" class="btn btn-warning">Yêu thích sản phẩm</button>
                        @else
                            <button onclick="alertLogin()" type="button" class="btn btn-default">Yêu thích sản phẩm</button>
                        @endif
                    </form> 
                </div>
                </div>
            </div>
        @endforeach 
    @endif                 
</div><!--features_items-->
<div class="row" style="text-align: center;">{{ $productCate->links() }}</div>

@endsection