@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    	<?php alert($errors , session('Success')) ?>

                        <form action="{{URL::to('admin/category-product/edit/' . $editCate->id)}}" method="post" role="form">
                       	{{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" name="category_product_name" value="{{ $editCate->name }}" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea required="" style="resize: none;" rows="5" class="form-control" name="category_product_desc" placeholder="Mô tả danh mục">{{ $editCate->description }}</textarea>
                        </div>
                        <button type="submit" name="edit_category_product" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection