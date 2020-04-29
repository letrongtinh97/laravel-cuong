@include('admin.layouts.header')
<!--header end-->
@include('admin.layouts.aside')
<!--main content start-->
<section id="main-content">
	<section class="wrapper">

		@yield('content')

	</section>

@include('admin.layouts.footer')
