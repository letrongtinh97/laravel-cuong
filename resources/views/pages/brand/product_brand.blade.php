@extends('master')

@section('title')
    Thương hiệu - {{ $productBrandName->name }}
@endsection

@section('content')


<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Thương hiệu {{ $productBrandName->name }} - {{ $productBrand->total() }} sản phẩm</h2>
    @if($productBrand->total() == 0)
        <h3 style="text-align: center;">Không có sản phẩm nào thuộc thương hiệu {{ $productBrandName->name }}</h3>
    @else
        @foreach($productBrand as $pBrd)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('public/uploads/products/' . $pBrd->image)}}" alt="" />
                            @if($pBrd->sale_price != 0)
                                <h2>{{ number_format($pBrd->sale_price) . ' đ' }}</h2>
                                <p>{{ $pBrd->name }} <span class="glyphicon glyphicon-star-empty" style="color: #FE980F;"></span></p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Tiết kiệm đến {{ round(100 - ($pBrd->sale_price * 100 / $pBrd->unit_price)) }}%</a>
                            @else
                                <h2>{{ number_format($pBrd->unit_price) . ' đ' }}</h2>
                                <p>{{ $pBrd->name }}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-gift"></i>Không khuyến mãi</a>
                            @endif
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                @if($pBrd->sale_price != 0)
                                    <strike><span style="font-size: 18px;">{{ number_format($pBrd->unit_price) . ' đ' }}</span></strike><br>
                                    <h2>{{ number_format($pBrd->sale_price) . ' đ' }}</h2>
                                    <p>Đang khuyến mãi</p>
                                @else
                                    <h2>{{ number_format($pBrd->unit_price) . ' đ' }}</h2>
                                @endif                               
                                <p><a href="{{URL::to('/chi-tiet-san-pham/' . $pBrd->id . '/' . $pBrd->slug)}}">{{ $pBrd->name }}</a></p>
                                <a href="{{URL::to('/chi-tiet-san-pham/' . $pBrd->id . '/' . $pBrd->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>Xem sản phẩm</a>
                            </div>
                        </div>
                        @if($pBrd->sale_price != 0)
                            <img class="new" src="{{ URL::to('public/frontend/images/sale.png') }}">
                        @endif
                    </div>
                    <div class="choose" style="text-align: center;">
                    <form action="{{ URL::to('/chosen/' . Session::get('id')) }}" method="POST" >
                        {{ csrf_field() }}
                        @if(Session::get('id'))
                            <input type="hidden" name="customers_id" value="{{ Session::get('id') }}">
                            <input type="hidden" name="product_id" value="{{ $pBrd->id }}">
                            <button style="background:  #FE980F;" type="submit" class="btn btn-warning">Yêu thích sản phẩm</button>
                        @else
                            <button style="background:  #FE980F;" onclick="alertLogin()" type="button" class="btn btn-warning">Yêu thích sản phẩm</button>
                        @endif
                    </form> 
                </div>
                </div>
            </div>
        @endforeach
    @endif                
</div><!--features_items-->
<div class="row" style="text-align: center;">{{ $productBrand->links() }}</div>

@endsection