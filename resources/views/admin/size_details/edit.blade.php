@extends('admin.layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa kích cỡ sản phẩm chi tiết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php alert($errors , session('Success')) ?>
                    <form action="{{URL::to('admin/size-details/edit/' . $editSizeDetails->id)}}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên loại kích cỡ</label>
                            <input type="text" class="form-control" name="size_details_name" value="{{ $editSizeDetails->name }}" placeholder="Nhập tên loại kích cỡ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sản phẩm</label>
                            <select name="product_id" class="form-control input-sm m-bot15">
                                @foreach($product as $pd)                                    
                                    <option 
                                        @if($editSizeDetails->product->id == $pd->id)
                                            selected="" 
                                        @endif
                                    value="{{ $pd->id }}">{{ $pd->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kích cỡ</label>
                            <select name="size_id" class="form-control input-sm m-bot15">

                                @foreach($size as $sz)
                                    <option 
                                        @if($editSizeDetails->size->id == $sz->id)
                                            selected="" 
                                        @endif
                                    value="{{ $sz->id }}">{{ $sz->name }}</option>
                                @endforeach
                            </select>
                        </div>                   
                        <button type="submit" name="size_detail_edit" class="btn btn-info">Sửa kích cỡ sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection