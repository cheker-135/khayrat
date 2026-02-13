<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('frontend.layouts.head')	
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	
	@include('frontend.layouts.notification')
	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@yield('main-content')
	
	@include('frontend.layouts.footer')

	<script>
		// Force unregister old service workers and clear caches
		if ('serviceWorker' in navigator) {
			navigator.serviceWorker.getRegistrations().then(function(registrations) {
				registrations.forEach(function(registration) {
					registration.unregister();
				});
			});
			caches.keys().then(function(names) {
				names.forEach(function(name) {
					caches.delete(name);
				});
			});
		}
	</script>

</body>
</html>