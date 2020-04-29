@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa số lượng sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php alert($errors , session('Success')) ?>
                    
                    <form action="{{URL::to('admin/total-product-details/edit/' . $total->id)}}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng hàng mới</label>
                            <input type="text" class="form-control" name="new" placeholder="Nhập số lượng hàng mới">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hàng tồn</label>
                            <input type="text" readonly="" class="form-control" value="{{ $total->old }}" name="old" placeholder="">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tổng số lượng hàng đang có</label>
                            <input type="text" readonly="" class="form-control" value="{{ $total->total }}" name="total" placeholder="">
                        </div>                                           
                        <button type="submit" name="total_product_edit" class="btn btn-info">Nhập hàng</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection