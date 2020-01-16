<!DOCTYPE html>
<html lang="vi">
	@include('admin.layout._common.head')
	<body style="font-family: Roboto  !important;" class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<div class="m-grid m-grid--hor m-grid--root m-page">
		    @include('admin.layout._common.header')
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			    @yield('content-page')
			</div>
			@include('admin.layout._common.footer')
		</div>
		@include('admin.layout._common.sidebar')
		@include('admin.layout._common.bottom')
		@yield('script')
	</body>
</html>
