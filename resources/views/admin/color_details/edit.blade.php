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

                    <form action="{{URL::to('admin/color-details/edit/' . $editcolordetails->id)}}" method="post" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên sản phẩm</label>
                            <select name="product_id" class="form-control input-sm m-bot15">
                                @foreach($product as $pd)                                    
                                    <option 
                                        @if($editcolordetails->product->id == $pd->id)
                                            selected="" 
                                        @endif
                                    value="{{ $pd->id }}">{{ $pd->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên màu</label>
                            <select name="color_id" class="form-control input-sm m-bot15">
                                @foreach($color as $sz)
                                    <option 
                                        @if($editcolordetails->color->id == $sz->id)
                                            selected="" 
                                        @endif
                                    value="{{ $sz->id }}">{{ $sz->name }}</option>
                                @endforeach
                            </select>
                        </div>                   
                        <button type="submit" name="color_detail_edit" class="btn btn-info">Sửa màu sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection