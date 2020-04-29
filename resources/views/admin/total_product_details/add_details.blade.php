@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm kích số lượng sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    	<?php alert($errors , session('Success')) ?>

                        <form action="{{URL::to('admin/total-product-details/add-total')}}" method="post" role="form">
                       	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thêm mới số lượng</label>
                                <input type="text" class="form-control" name="new" placeholder="Nhập số lượng hàng">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kích cỡ sản phẩm</label>
                                <select name="size_details_id" class="form-control input-sm m-bot15">
                                    @foreach($size_details as $sd)
                                        <option value="{{ $sd->id }}">{{ $sd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Màu sản phẩm</label>
                                <select name="color_details_id" class="form-control input-sm m-bot15">
                                    @foreach($color_details as $cd)
                                        <option value="{{ $cd->id }}">{{ $cd->color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <button type="submit" name="size_detail_add" class="btn btn-info">Thêm mới số lượng sản phẩm</button>
                        </form>
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection