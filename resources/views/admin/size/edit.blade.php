@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật kiểu kích cỡ
            </header>
            <div class="panel-body">
                <div class="position-center">
                	<?php alert($errors , session('Success')) ?>

                    <form action="{{URL::to('admin/size/edit/' . $editSize->id)}}" method="post" role="form">
                   	{{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên kiểu kích cỡ</label>
                        <input type="text" class="form-control" name="size_name" value="{{ $editSize->name }}" placeholder="Nhập tên danh mục">
                    </div>
                    <button type="submit" name="edit_size" class="btn btn-info">Cập nhật kiểu kích cỡ</button>
                </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection