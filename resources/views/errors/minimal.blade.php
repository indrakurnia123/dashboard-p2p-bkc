<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title')</title>
	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('vendors/core/core.css')}}">
	<!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}"/>
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('css/demo_1/style.css')}}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('assets/css/demo_1/style.css')}}"/>
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
						<img src="{{asset('/images/404.svg')}}" class="img-fluid mb-2" alt="404">
						<h1 class="font-weight-bold mb-22 mt-2 tx-80 text-muted">@yield('code')</h1>
						<h4 class="mb-2">@yield('message')</h4>
						<h6 class="text-muted mb-3 text-center">Halaman yang kamu cari tidak ditemukan.</h6>
						<a href="{{ route('dashboard.p2p-lending') }}" class="btn btn-primary">Ke halaman utama</a>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- core:js -->
	<script src="{{asset('vendors/core/core.js')}}"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{asset('vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('js/template.js')}}"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
	<!-- end custom js for this page -->
</body>
</html>