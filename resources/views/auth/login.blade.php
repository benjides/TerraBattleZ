<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootstrap Login Form</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<style media="screen">
			.form-signin
			{
				max-width: 330px;
				padding: 15px;
				margin: 0 auto;
			}
			.form-signin .form-signin-heading, .form-signin .checkbox
			{
				margin-bottom: 10px;
			}
			.form-signin .checkbox
			{
				font-weight: normal;
			}
			.form-signin .form-control
			{
				position: relative;
				font-size: 16px;
				height: auto;
				padding: 10px;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}
			.form-signin .form-control:focus
			{
				z-index: 2;
			}
			.form-signin input[type="text"]
			{
				margin-bottom: -1px;
				border-bottom-left-radius: 0;
				border-bottom-right-radius: 0;
			}
			.form-signin input[type="password"]
			{
				margin-bottom: 10px;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
			}
			.account-wall
			{
				margin-top: 20px;
				padding: 40px 0px 20px 0px;
				background-color: #f7f7f7;
				-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
				-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
				box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			}
			.login-title
			{
				color: #555;
				font-size: 18px;
				font-weight: 400;
				display: block;
			}
			.profile-img
			{
				width: 96px;
				height: 96px;
				margin: 0 auto 10px;
				display: block;
				-moz-border-radius: 50%;
				-webkit-border-radius: 50%;
				border-radius: 50%;
			}
			.need-help
			{
				margin-top: 10px;
			}
			.new-account
			{
				display: block;
				margin-top: 10px;
			}
		</style>
	</head>
	<body>
		<div class="container">
		    <div class="row">
		        <div class="col-sm-6 col-md-4 col-md-offset-4">
		            <h1 class="text-center login-title">Terra Battle Z - Admin Dashboard</h1>
		            <div class="account-wall">
		                <img class="profile-img"
										src="{{url('assets/content/brand.png')}}"
		                alt="">
										@if (count($errors) > 0)
											<div class="alert alert-danger">
												<strong>Whoops!</strong> There were some problems with your input.<br><br>
												<ul>
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										@endif
		                <form class="form-signin" role="form" method="POST" action="{{ url('/admin/login') }}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="text" placeholder="Username" class="form-control" name="username" value="{{ old('username') }}">
											<input type="password" placeholder="Password" class="form-control" name="password">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="remember"> Remember Me
												</label>
											</div>
			                <button class="btn btn-lg btn-primary btn-block" type="submit">
			                    Sign in
											</button>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
	</body>
</html>
