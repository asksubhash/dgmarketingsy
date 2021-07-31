<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view('front/header-css.php') ?>
	<title>As blog | new blog 2021 | latest blog</title>
</head>

<body>



	<?php $this->load->view('front/menu.php') ?>
	<slider>
		<div class="container-fluid m-0 p-0">
			<div class="carousel-wrap">
				<div id="owl-carousel" class="owl-carousel owl-theme">
					<?php if (!empty($slider)) :
						foreach ($slider as $slider_data) :
					?>
							<div class="item">
								<img src="<?= base_url() . 'public/admin/uploads/slider/thumb/' . $slider_data['image']; ?>" class="d-block w-100 " height="514">
								<div class="banner-text ">
									<span class="cat-links category"><a href="<?= base_url('blog/category/' . $slider_data['cat_id']) ?>" rel="category tag"><?= $slider_data['cat_name'] ?></a></span>
									<h2 class="title"><a href="javascript:void(0)"><?php echo $slider_data['tittle'] ?></a></h2>
								</div>
							</div>
					<?php
						endforeach;
					endif; ?>
				</div>
			</div>
		</div>
	</slider>

	<!-- about section  -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-12 mb-3">
					<div class="text-left header-nav-center">
						<h2 class=" text-capitalize "> <span>About</span> <span>Company</span> </h2>
					</div>
				</div>

				<div class="col-12">
					<div>
						<span>
							<p>
								Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, mollitia ipsam veritatis expedita sint tempore exercitationem,
								quia eos saepe explicabo dicta facere amet aspernatur? Quisquam maiores mollitia perspiciatis laudantium esse!
							</p>
						</span>
						<span>
							<p>
								Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, mollitia ipsam veritatis expedita sint tempore exercitationem,
								quia eos saepe explicabo dicta facere amet aspernatur? Quisquam maiores mollitia perspiciatis laudantium esse!
								Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, mollitia ipsam veritatis expedita sint tempore exercitationem,
								quia eos saepe explicabo dicta facere amet aspernatur? Quisquam maiores mollitia perspiciatis laudantium esse!
								Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, mollitia ipsam veritatis expedita sint tempore exercitationem,
								quia eos saepe explicabo dicta facere amet aspernatur? Quisquam maiores mollitia perspiciatis laudantium esse!
								Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, mollitia ipsam veritatis expedita sint tempore exercitationem,
								quia eos saepe explicabo dicta facere amet aspernatur? Quisquam maiores mollitia perspiciatis laudantium esse!
								Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, mollitia ipsam veritatis expedita sint tempore exercitationem,
								quia eos saepe explicabo dicta facere amet aspernatur? Quisquam maiores mollitia perspiciatis laudantium esse!
							</p>
						</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--end about section  -->

	<!-- services section  -->
	<section class="mt-3 bg-light mb-5">
		<div class="container ">
			<div class="row mt-3 mb-3">
				<div class="col-12 mb-3 mt-4">
					<div class="text-left header-nav-center">
						<h2 class="text-uppercase"> <span>Our</span> <span>Services</span> </h2>
					</div>
				</div>

				<div class="col-12 mb-5 ">
					<div class="row">
						<div class=" col-xl-3 col-lg-3  col-md-6 col-sm-6 col-6 mt-sm-3 mt-3">
							<div class="card rounded-0 h-100 border-0 ">
								<img src="<?= base_url('public/image/webdeb.png') ?>" class="card-img-top"  height="168" alt="...">
								<div class="card-body">
									<h5 class="card-title text-capitalize">Website development</h5>
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3  col-md-6 col-sm-6 col-6 mt-sm-3 mt-3">
							<div class="card rounded-0 h-100  border-0 ">
								<img src="<?= base_url('public/image/digital-mar.jpg') ?>" class="card-img-top" height="168" alt="...">
								<div class="card-body">
									<h5 class="card-title text-capitalize">Digital marketing </h5>
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3  col-md-6 col-sm-6 col-6 mt-sm-3 mt-3">
							<div class="card rounded-0 h-100  border-0">
								<img src="<?= base_url('public/image/app-deve.jpg') ?>" class="card-img-top" height="168" alt="...">
								<div class="card-body">
									<h5 class="card-title text-capitalize">Mobile app development </h5>
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3  col-md-6 col-sm-6 col-6 mt-sm-3 mt-3">
							<div class="card rounded-0  h-100  border-0">
								<img src="<?= base_url('public/image/shoft.jpg') ?>" class="card-img-top" height="168" alt="...">
								<div class="card-body">
									<h5 class="card-title text-capitalize">software development </h5>
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end services section  -->



	<!-- latest post section  -->
	<section class=" mb-5 bg-light">
		<div class="container ">
			<div class="row mt-3 mb-3">
				<div class="col-12 mb-3 mt-4">
					<div class="text-left header-nav-center">
						<h2 class="text-uppercase"> <span>Recent</span> <span> Posts</span> </h2>
					</div>
				</div>

				<div class="col-12  ">
					<div class="row">
						<?php if (!empty($recent_posts)) : ?>
							<?php foreach ($recent_posts as $recent_post) : ?>
								<div class=" col-xl-4 col-lg-4  col-md-6 col-sm-6 col-12 mt-sm-3 mt-3">
									<div class="card rounded-0 h-100  ">

										<?php if (file_exists('./public/admin/uploads/post/' . $recent_post['image'])) : ?>
											<a href="<?= base_url('blog/detail/' . $recent_post['id']) ?>" class=" text-decoration-none ">
												<img src="<?= base_url('public/admin/uploads/post/' . $recent_post['image']) ?>" alt="<?= $recent_post['tittle'] ?>" height="249" class="card-img-top rounded-0 ">
											</a>
										<?php endif; ?>

										<div class="card-body">
											<h5 class="card-title text-capitalize post-cart-title"> <a href="<?= base_url('blog/detail/' . $recent_post['id']) ?>"><?= $recent_post['tittle'] ?></a> </h5>
											<p class="card-text"><?php echo word_limiter(strip_tags($recent_post['desc']), 15); ?></p>

										</div>
										<div class="card-footer bg-white  border-bottom-0 border-left-0 border-right-0 post-footer-category d-flex  justify-content-between">
											<div>
												<span class=" fa fa-folder-open"></span>
												<span>
													<a href="<?= base_url('blog/category/' . $recent_post['cat_id']) ?>"><?= $recent_post['category_name'] ?></a>
												</span>
											</div>
											<div class=" created_at  ">
												<span class="text-muted">
													<?= date("F d, Y", strtotime($recent_post['created_at'])) ?>
												</span>
											</div>

										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>

					</div>
				</div>
				<div class="col-12 mb-3 mt-4">
					<div class="text-center">
						<a href="<?= base_url('blog') ?>" class="btn btn-success border-0 rounded-0">View All Posts</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end latest post section  -->





	<?php $this->load->view('front/footer.php') ?>
