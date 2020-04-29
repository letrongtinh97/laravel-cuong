@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục màu
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    	<?php alert($errors , session('Success')) ?>

                        <form action="{{URL::to('admin/color/edit/' . $editColor->id)}}" method="post" role="form">
                       	{{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên màu</label>
                            <input type="text" class="form-control" name="color_product_name" value="{{ $editColor->name }}" placeholder="Nhập tên danh mục">
                        </div>
                        <button type="submit" name="edit_color_product" class="btn btn-info">Cập nhật màu</button>
                    </form>
                    </div>
                </div>
            </section>

    </div>
</div>

@endsection