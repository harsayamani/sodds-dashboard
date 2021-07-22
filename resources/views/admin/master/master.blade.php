<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>@yield('tab_title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	@include('admin.style.style')
    @yield('adding-style')
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<center>
                <a href="/admin/dashboard" class="logo">
                    <img src="/admin-template/assets/img/sodds.png" width="100px">
                </a>
                </center>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						{{-- <li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-bell"></i>
								<span class="notification">3</span>
							</a>
							<ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-center">
										<a href="#">
											<div class="notif-icon notif-success"> <i class="la la-check"></i> </div>
											<div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
												<span class="time">12 minutes ago</span>
											</div>
										</a>
									</div>
								</li>
								<li>
									<a class="see-all" href="/admin/diagnosis/history"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
								</li>
							</ul>
						</li> --}}
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"><span>{{Session::get('name')}}</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									</li>
									<a class="dropdown-item" href="/admin/change-password"><i class="ti-email"></i> Change Password</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="/admin/account-settings"><i class="ti-settings"></i> Account Setting</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="/admin/logout"><i class="fa fa-power-off"></i> Logout</a>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="info">

                            <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{Session::get('name')}}
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>

							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="/admin/change-password">
											<span class="link-collapse">Change Password</span>
										</a>
									</li>
									<li>
										<a href="/admin/account-settings">
											<span class="link-collapse">Account Settings</span>
										</a>
									</li>
									<li>
										<a href="/admin/logout">
											<span class="link-collapse">Logout</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item @yield('is_active1')">
							<a href="/admin/dashboard">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item @yield('is_active2')">
							<a href="/admin/diagnosis/test">
								<i class="la la-check-square"></i>
								<p>Diagnosis Test</p>
							</a>
						</li>
						<li class="nav-item @yield('is_active3')">
							<a href="/admin/diagnosis/history">
								<i class="la la-history"></i>
								<p>Diagnosis History</p>
							</a>
						</li>
						<li class="nav-item @yield('is_active4')">
							<a href="/admin/manage/evidence">
								<i class="la la-cog"></i>
								<p>Manage Evidence</p>
							</a>
						</li>
                        <li class="nav-item @yield('is_active5')">
							<a href="/admin/manage/disease">
								<i class="la la-cog"></i>
								<p>Manage Disease</p>
							</a>
						</li>
                        <li class="nav-item @yield('is_active6')">
							<a href="/admin/manage/rules-ds">
								<i class="la la-cog"></i>
								<p>Manage Rules DS</p>
							</a>
						</li>
                        <li class="nav-item @yield('is_active7')">
							<a href="/admin/manage/rules-cf">
								<i class="la la-cog"></i>
								<p>Manage Rules CF</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
                        @if (session()->has('alert-success'))
                            <input type = "text" id="alert" value = "{{session()->get('alert-success')}}" hidden>
                            <input type = "text" id="state" value = "success" hidden>
                            <input type = "text" id="title" value = "SODDS Notify" hidden>
                        @elseif ($errors->any())
                            <input type = "text" id="alert" value = "{{$errors->all()[0]}}" hidden>
                            <input type = "text" id="state" value = "danger" hidden>
                            <input type = "text" id="title" value = "SODDS Notify" hidden>
                        @elseif (session()->has('alert-danger'))
                            <input type = "text" id="alert" value = "{{session()->get('alert-danger')}}" hidden>
                            <input type = "text" id="state" value = "danger" hidden>
                            <input type = "text" id="title" value = "SODDS Notify" hidden>
                        @elseif (session()->has('alert-warning'))
                            <input type = "text" id="alert" value = "{{session()->get('alert-warning')}}" hidden>
                            <input type = "text" id="state" value = "warning" hidden>
                            <input type = "text" id="title" value = "SODDS Notify" hidden>
                        @else
                            <input type = "text" id="alert" value = "null" hidden>
                            <input type = "text" id="state" value = "null" hidden>
                            <input type = "text" id="title" value = "null" hidden>
                        @endif
						<h4 class="page-title">@yield('page_title')</h4>
						@yield('content')
					</div>
				</div>
				<footer class="footer">
					<div class="container-fluid">
						<div class="copyright ml-auto">
							Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
</body>
@include('admin.script.script')
<script>
    let message = document.getElementById('alert').value;
    let state = document.getElementById('state').value;
    let title = document.getElementById('title').value;
    console.log(message);
    console.log(state);

    if(state !== 'null') {
        notificationAlert(title, message, state);
    }

    var pusher = new Pusher('9cc252851cc7a8311c0c', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('diagnosis');
    channel.bind('diagnosis-added', function(data) {
        console.log(data)
        title = 'Diagnosis Success';
        state = 'primary';
        message = `
            Disease : ${data.disease_result.disease}<br>
            Belief : ${data.max_bel_weight}
            <p><b>Just Now!</b></p>
        `;
        notificationAlert(title, message, state);
    });

    channel.bind('diagnosiscf-added', function(data) {
        console.log(data)
        console.log(data)
        title = 'Diagnosis Success';
        state = 'primary';
        message = `
            Disease : ${data.disease}<br>
            Percentage : ${data.cf_persen}
            <p><b>Just Now!</b></p>
        `;
        notificationAlert(title, message, state);
    });

    function notificationAlert(title, message, state) {
        var placementFrom = 'top';
        var placementAlign = 'right';
        // var state = 'success';
        var style = 'withicon';
        var content = {};

        content.message = message;
        content.title = title;
        if (style == "withicon") {
            content.icon = 'la la-bell';
        } else {
            content.icon = 'none';
        }
        content.target = '_blank';

        $.notify(content,{
            type: state,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            time: 1000,
        });
    }
</script>
</html>
