@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm số lượng sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    	<?php alert($errors , session('Success')) ?>

                        <form action="{{URL::to('admin/total-product-details/add')}}" method="post" role="form">
                       	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sản phẩm</label>
                                <select name="product_id" class="form-control input-sm m-bot15">
                                    @foreach($product as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" name="size_detail_add" class="btn btn-info">Chọn sản phẩm</button>
                        </form>
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection