@extends('admin.layouts.admin_layout')

@section('content')

<h2>Chào mừng bạn đến với trang Admin</h2>
<div class="form" style="margin-top: 30px; ">
	<h3>Hiện đang có {{ count($orderNew) }} đơn hàng mới</h3>
</div>

@endsection