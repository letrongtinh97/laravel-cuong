@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                	<?php alert($errors , session('Success')) ?>
                    @if(checkLevel(1))
                        <form action="{{URL::to('admin/brand-product/add')}}" method="" role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" class="form-control" name="brand_product_name" placeholder="Nhập tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea style="resize: none;" rows="5" class="form-control" name="brand_product_desc" placeholder="Mô tả thương hiệu"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <option value="1">Có</option>
                                    <option value="0">Không</option>
                                </select>
                            </div>
                            <button <?php echo checkLevel(1); ?> type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                        </form>
                    @else
                        <form action="{{URL::to('admin/brand-product/add')}}" method="post" role="form">
                           	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" class="form-control" name="brand_product_name" placeholder="Nhập tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea  style="resize: none;" rows="5" class="form-control" name="brand_product_desc" placeholder="Mô tả thương hiệu"></textarea>
                            </div>
                            <div class="form-group">
                            	<label for="exampleInputPassword1">Hiển thị</label>
    	                        <select name="brand_product_status" class="form-control input-sm m-bot15">
    	                            <option value="1">Có</option>
    	                            <option value="0">Không</option>
    	                        </select>
                            </div>
                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>

@endsection