<!DOCTYPE html>
<html>
@include('include.header')
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">

			@include('include.navbar')
            
            @include('include.sidebar')
           
            @yield('content')


            @include('include.footer')

		</div>
	</body>
</html>