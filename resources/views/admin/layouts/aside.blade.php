<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/admin/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý đơn hàng
                            @if(count($orderNew))
                                <sup style="color: red;">{{ count($orderNew) }}</sup>
                            @endif
                        </span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/manager/all')}}">Mới nhất</a></li>
                        <li><a href="{{URL::to('admin/manager/all/sending')}}">Đang giao hàng</a></li>
                        <li><a href="{{URL::to('admin/manager/all/checked')}}">Đã giao hàng</a></li>
                        <li><a href="{{URL::to('admin/manager/all/cancel')}}">Đã hủy</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/coupon/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/coupon/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Số lượng sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/total-product-details/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/total-product-details/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('admin/category-product/add')}}">Thêm mới</a></li>
						<li><a href="{{URL::to('admin/category-product/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/brand-product/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/brand-product/all')}}">Danh sách</a></li>
                    </ul>
                </li> 

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Màu sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/color/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/color/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Màu sản phẩm chi tiết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/color-details/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/color-details/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Kích cỡ sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/size/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/size/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Kích cỡ sản phẩm chi tiết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/size-details/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/size-details/all')}}">Danh sách</a></li>
                    </ul>
                </li>  

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('admin/product/add')}}">Thêm mới</a></li>
                        <li><a href="{{URL::to('admin/product/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm yêu thích</span>
                    </a>
                  <ul class="sub">
                        <li><a href="{{URL::to('admin/chosen/all')}}">Danh sách</a></li>
                    </ul>
                </li>             
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->