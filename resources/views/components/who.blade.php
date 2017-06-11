@if(Auth::guard('web')->check())
	<p class="text-success">You are logged IN as <strong>User.!</strong></p>
@else
	<p class="text-danger">You are logged OUT as <strong>User.!</strong></p>
@endif

@if(Auth::guard('admin')->check())
	<p class="text-success">You are logged IN as <strong>Admin.!</strong></p>
@else
	<p class="text-danger">You are logged OUT as <strong>Admin.!</strong></p>
@endif

