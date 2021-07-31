<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/font_awesome-pro/css/all.css">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/css/skin-green.css">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/dataTable/dataTable.css">
	<link rel="stylesheet" href="<?= base_url() ?>public/admin/plugins/summer/summer.css">


</head>

<body class="hold-transition skin-green sidebar-mini ">
	<!-- <div class="ajax-loader">
		<span class="fa fa-spin fa-spinner"></span>
	</div> -->
	<div class="a-loader-box" id="a-loader-box">
		<div class="a-loader-inner-col">
			<span class="fa fa-spinner fa-spin spin-loader"></span>
			<span class="spin-text">Processing...</span>
		</div>
	</div>
	<div class="wrapper">
		<header class="main-header">

			<a href="javascript:void(0)" class="logo">
				<span class="logo-mini"><b>Dev</b>Ask</span>
				<span class="logo-lg"><b>Dev</b>Subhash</span>
			</a>

			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="fad fa-bars"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu"><a href="" target="_blank">Go to Website</a></li>
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?= base_url() ?>public/admin/image/admin/5311623434073.webp" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php $admin = $this->session->userdata('admin');
														echo $admin['admin_name']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?= base_url() ?>public/admin/image/admin/5311623434073.webp" class="img-circle" alt="User Image">

									<p>
										<small>Member since </small>
									</p>
								</li>

								<li class="user-footer">
									<div class="pull-left">
										<a href="" class="btn btn-default btn-flat"> <span class="fad fa-id-card"></span> Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?= base_url() . 'admin/login/logOut' ?>" id="SigOut" data-value="" class="btn btn-default btn-flat "> <span class="fad fa-power-off"></span> Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?= base_url() ?>public/admin/image/admin/5311623434073.webp" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>ask</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<ul class="sidebar-menu" data-widget="tree">
					<li class="header"></li>
					<li class="active">
						<a href="<?= base_url() . 'admin/home/index' ?>"><i class="fad fa-tachometer-alt"></i> <span>Admin Dashboard</span></a>
					</li>
					<li class="treeview">
						<a href="#"> <i class="fad fa-home"></i> <span>Home Page Layout</span> <i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?= base_url() . 'admin/slider/index' ?>"><i class="fad fa-sliders-h-square"></i> <span>Main Slider</span></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="javascript:void(0)"> <i class="fad fa-bars"></i> <span>Categories</span><i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="<?= base_url() . 'admin/category/index' ?>"><i class="fad fa-circle"></i> Main Category</a></li>
						</ul>
					</li>
					<li><a href="<?= base_url() . 'admin/post/index' ?>"><i class="fad fa-blog"></i> <span>blog post </span></a></li>
					<li><a href="<?= base_url() . 'admin/newsletter/index' ?>"><i class="fad fa-users"></i> <span>News letter user </span></a></li>
					<li><a href="<?= base_url() . 'admin/post/contact_us' ?>"><i class="fad fa-users"></i> <span>Contact us user </span></a></li>


				</ul>
			</section>
		</aside>
