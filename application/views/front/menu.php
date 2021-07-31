<?php
require('function.php');

$url_get = uri_string();
$f_uri_get = url_active($url_get);
$s_active = '';
$a_active = '';
$c_active = '';
$home_active = '';
$blog_active = '';

if ($f_uri_get == 'service_active') {
	$s_active = 'as_active';
} else if ($f_uri_get == 'about_active') {
	$a_active = 'as_active';
} else if ($f_uri_get == 'contact_active') {
	$c_active = 'as_active';
} elseif ($f_uri_get == 'home_active') {
	$home_active = 'as_active';
} elseif ($f_uri_get == '') {
	$home_active = 'as_active';
} elseif ($f_uri_get == 'blog_active') {
	$blog_active = 'as_active';
}

?>
<header class=" bg-white m-0 p-0 ">
	<div class="container shadow-bottom main-navbar">
		<nav class="navbar navbar-expand-lg ">
			<a class="brand-img" href="<?= base_url() ?>"> <img src="<?= base_url('public/image/logo.png'); ?>" alt="as blog"> </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class=" fas fa-bars"></span>
			</button>
			<div class="collapse navbar-collapse align-right" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item ">
						<a class="nav-link <?= $home_active ?>" href="<?= base_url() ?>">Home </a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $s_active ?>" href="<?= base_url('page/service') ?>">services </a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $blog_active ?>" href="<?= base_url('blog') ?>">Blog </a>
					</li>
					<li class="nav-item">
						<div class="dropdown">
							<a class="dropdown-toggle nav-link" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Categories
							</a>
							<?php if (!empty($category)) : ?>
								<div class="dropdown-menu category-dropdown rounded-0">
									<?php foreach ($category as $categories) : ?>
										<a class="dropdown-item" href="<?= base_url('blog/category/' . $categories['id']) ?>"><?= $categories['name'] ?></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</li>
					<li class="nav-item ">
						<a class="nav-link <?= $a_active ?>" href="<?= base_url('page/about') ?>">About Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $c_active ?>" href="<?= base_url('page/contact') ?>">contact us </a>
					</li>

				</ul>
			</div>
		</nav>
	</div>
</header>
