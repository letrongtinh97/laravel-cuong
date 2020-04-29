@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php alert($errors , session('Success')) ?>

                    <form action="{{URL::to('admin/product/edit/' . $Product->id)}}" enctype="multipart/form-data" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" value="{{ $Product->name }}" name="product_name" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="text" class="form-control" value="{{ $Product->unit_price }}" name="product_unit_price" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá khuyến mãi</label>
                            <input type="text" class="form-control" value="{{ $Product->sale_price }}" name="product_sale_price" placeholder="Nhập giá khuyến mãi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <p>
                                <img src="public/uploads/products/{{$Product->image}}" width="200px">
                            </p>
                            <input type="file" class="form-control" name="product_image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none;" rows="5" class="form-control" name="product_desc" placeholder="Mô tả sản phẩm">{{ $Product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea style="resize: none;" rows="5" class="form-control" name="product_content" placeholder="Nội dung sản phẩm">{{ $Product->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_category" class="form-control input-sm m-bot15">
                                @foreach($category as $cate)
                                    <option
                                    @if($Product->category_product->id == $cate->id) 
                                        selected=""
                                    @endif
                                    value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục thương hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand as $br)
                                    <option
                                    @if($Product->brand_product->id == $br->id) 
                                        selected=""
                                    @endif 
                                    value="{{ $br->id }}">{{ $br->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Sửa sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection