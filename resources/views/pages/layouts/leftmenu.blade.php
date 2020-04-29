<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        	@foreach($category as $ct)
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/' . $ct->id . '/' . $ct->slug)}}">{{ $ct->name }}<span style="float: right;">({{ count($ct->product) }})</span></a></h4>
	                </div>
	            </div>
            @endforeach
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Thương hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                	@foreach($brand as $bd)
                    	<li><a href="{{URL::to('/thuong-hieu/' . $bd->id) . '/' . $bd->slug}}"> <span class="pull-right">({{ count($bd->product) }})</span>{{ $bd->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->
        
       {{--  <div class="price-range">
            <h2>Price Range</h2>
            <div class="well text-center">
                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div> --}}
        
        <div class="shipping text-center"><!--shipping-->
            <img src="{{('public/frontend/images/shipping.jpg')}}" alt="" />
        </div><!--/shipping-->  
    </div>
</div>