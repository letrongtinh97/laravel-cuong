@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
            </header>
            <div class="panel-body">
                <div class="position-center">
                	<?php alert($errors , session('Success')) ?>
                    @if(checkLevel(1))
                        <form action="{{URL::to('admin/coupon/add')}}" enctype="multipart/form-data" method="" role="form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên mã giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã giảm giá</label>
                                <input type="text" class="form-control" name="code" placeholder="Nhập mã giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng mã</label>
                                <input type="text" class="form-control" name="time" placeholder="Nhập số lượng mã">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tính năng mã</label>
                                <select name="condition" class="form-control input-sm m-bot15">
                                    <option value="0">--Chọn tính năng--</option>
                                    <option value="1">Giảm theo %</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số % hoặc số tiền giảm</label>
                               <input type="text" class="form-control" name="number" placeholder="Nhập số tiền giảm">
                            </div>
                            <button <?php echo checkLevel(1); ?> type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                        </form>
                    @else
                        <form action="{{URL::to('admin/coupon/add')}}" enctype="multipart/form-data" method="post" role="form">
                           	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên mã giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã giảm giá</label>
                                <input type="text" class="form-control" name="code" placeholder="Nhập mã giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng mã</label>
                                <input type="text" class="form-control" name="time" placeholder="Nhập số lượng mã">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tính năng mã</label>
                                <select name="condition" class="form-control input-sm m-bot15">
                                    <option value="0">--Chọn tính năng--</option>
                                    <option value="1">Giảm theo %</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số % hoặc số tiền giảm</label>
                               <input type="text" class="form-control" name="number" placeholder="Nhập số tiền giảm">
                            </div>
                            <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>

@endsection