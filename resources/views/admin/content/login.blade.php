<!doctype html>
<html lang="en">
  <head>
  	<title>Login | SODDS Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/admin-template/login/css/style.css">

	</head>
	<body>
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-7 col-lg-5">
						<div class="login-wrap p-4 p-md-5">
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="/admin-template/assets/img/sodds.png" width="150px">
                            </div>
                            <h3 class="text-center mb-4">Sign In</h3>
                            @if (session()->has('alert-success'))
                                <div class="alert alert-success" role="alert">
                                    {{session()->get('alert-success')}}
                                </div>
                            @endif

                            @if (session()->has('alert-danger'))
                                <div class="alert alert-danger" role="alert">
                                    {{session()->get('alert-danger')}}
                                </div>
                            @endif

                            @if (session()->has('alert-warning'))
                                <div class="alert alert-warning" role="alert">
                                    {{session()->get('alert-warning')}}
                                </div>
                            @endif
                            <form autocomplete="off" method="POST" action="/admin/login/process" class="login-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-left" placeholder="Enter username" name="username" required>
                                </div>
                                <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Enter password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                                </div>
                            </form>
				        </div>
					</div>
				</div>
			</div>
		</section>

		<script src="/admin-template/login/js/jquery.min.js"></script>
		<script src="/admin-template/login/js/popper.js"></script>
		<script src="/admin-template/login/js/bootstrap.min.js"></script>
		<script src="/admin-template/login/js/main.js"></script>
	</body>
</html>



{{-- <!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | SODDS Admin </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/admin-template/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin-template/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="/admin-template/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
                @if (session()->has('alert-success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('alert-success')}}
                    </div>
                @endif

                @if (session()->has('alert-danger'))
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('alert-danger')}}
                    </div>
                @endif

                @if (session()->has('alert-warning'))
                    <div class="alert alert-warning" role="alert">
                        {{session()->get('alert-warning')}}
                    </div>
                @endif
				<form autocomplete="off" class="login100-form validate-form" method="POST" action="/admin/login/process">
					<span class="login100-form-title p-b-43">
						SODDS Admin Login
					</span>

                    {{ csrf_field() }}

					<div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username">
						<span class="label-input100">Username</span>
					</div>


					<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="/admin-template/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/admin-template/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/admin-template/login/vendor/bootstrap/js/popper.js"></script>
	<script src="/admin-template/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/admin-template/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/admin-template/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="/admin-template/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/admin-template/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/admin-template/login/js/main.js"></script>

</body>
</html> --}}
