<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view('front/header-css.php') ?>
	<title>As blog | latest blog | recent post</title>
</head>

<body>



	<?php $this->load->view('front/menu.php') ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-0 m-0">
				<div class="blog-header">
					<h1 class="text-capitalize "> Blog Post</h1>
					<ul class="text-center">
						<li><a href="<?= base_url() ?>">Home</a></li>
						<li>Blog
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<section class=" bg-light ">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 col-lg-8 col-md-12 col-12 mt-4">
					<div class="row mb-5">
						<?php if (!empty($posts)) : ?>
							<?php foreach ($posts as $post) : ?>
								<div class="col-md-6 col-12 mt-5">

									<div class="card rounded-0 h-100  border-0 pl-4 pr-4 shadow  ">
										<div class="card-header bg-white m-0 pt-3 pb-0 border-0">
											<h5 class="card-title text-capitalize post-cart-title"> <a href="<?= base_url('blog/detail/' . $post['id']) ?>"><?= $post['tittle'] ?></a> </h5>
										</div>
										<?php if (file_exists('./public/admin/uploads/post/' . $post['image'])) : ?>
											<a href="<?= base_url('blog/detail/' . $post['id']) ?>">
												<img src="<?= base_url('public/admin/uploads/post/' . $post['image']) ?>" class="card-img-top  rounded-0 border-0" height="249" alt="<?= $post['tittle'] ?>">
											</a>
										<?php endif; ?>
										<div class="card-body">
											<p class="card-text"><?php echo word_limiter(strip_tags($post['desc']), 20); ?></p>
											<a href="<?= base_url('blog/detail/' . $post['id']) ?>" class=" text-decoration-none ">Read More</a>
										</div>
										<div class="card-footer bg-white  border-bottom-0 border-left-0 border-right-0 post-footer-category d-flex  justify-content-between">
											<div>
												<span class=" fa fa-folder-open"></span>
												<span>
													<a href="javascript:void(0)"><?= $post['category_name'] ?></a>
												</span>
											</div>
											<div class=" created_at ">
												<span class="text-muted">
													<span>On</span> <span class="ml-1"><?= date("d F Y", strtotime($post['created_at'])) ?></span>
												</span>
											</div>

										</div>
									</div>

								</div>
							<?php endforeach; ?>
						<?php else : ?>
							<div class="col-12 mt-5">
								<section class="page_404">
									<div class="container">
										<div class="row">
											<div class="col-sm-12 ">
												<div class="col-sm-10 col-sm-offset-1  text-center">
													<div class="four_zero_four_bg">
														<h1 class="text-center ">404</h1>
													</div>

													<div class="contant_box_404">
														<h3 class="h2">
															Look like you Blogs not found
														</h3>

														<p>the page you are looking for not avaible!</p>

														<a href="<?= base_url() ?>" class="link_404 text-decoration-none">Go to Home</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>
						<?php endif; ?>
						<div class="col-md-12 mt-5">
							<?php echo $pagination_links; ?>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-12 col-12  mt-4  ">
					<div class="row">
						<div class="col-12">
							<section class="categories-blog-p mt-5 ml-5 ">
								<h5 class="text-muted text-uppercase "><strong>Categories</strong></h5>
								<?php if (!empty($category)) : ?>
									<ul class=" list-unstyled pb-3">
										<?php foreach ($category as $cat) : ?>
											<li class=" text-left d-flex justify-content-between  pt-1 pb-1 "><a href="<?= base_url('blog/category/' . $cat['id']) ?>" class=" font-weight-normal text-decoration-none"><?= $cat['name'] ?> </a> </li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</section>
						</div>
						<div class="col-12 mb-2">
							<section class="categories-blog-p mt-5 ml-5 ">
								<h5 class="text-muted text-uppercase "><strong>FOLLOW US ON</strong></h5>
								<ul class=" list-unstyled pb-3 pt-2 d-flex">
									<li class="   pt-1 pb-1 follow-us-font-li"><a href="" class=" font-weight-normal border text-decoration-none border-0"><span class="fab fa-facebook-f "></span> </a> </li>
									<li class="   pt-1 pb-1 pl-2 follow-us-font-li"><a href="" class=" font-weight-normal border text-decoration-none border-0"><span class="fab fa-twitter "></span> </a> </li>
									<li class="   pt-1 pb-1 pl-2 follow-us-font-li "><a href="" class=" font-weight-normal border text-decoration-none border-0"><span class="fab fa-instagram "></span> </a> </li>
								</ul>

							</section>
						</div>
						<div class="col-12 mb-2">
							<section class=" mt-5 ml-5 ">
								<h5 class="text-muted text-uppercase "><strong>RECENT POSTS </strong></h5>
								<?php if (!empty($recent_posts)) : ?>
									<ul class=" list-unstyled pb-3 pt-2  recent-blog-post-site">

										<?php foreach ($recent_posts as $recent_post) : ?>
											<li class=" d-flex ">
												<?php if (file_exists('./public/admin/uploads/post/' . $recent_post['image'])) : ?>
													<a href="<?= base_url('blog/detail' . $recent_post['id']) ?>" class="post-thumbnail mt-1">
														<img width="68" height="53" src="<?= base_url('public/admin/uploads/post/' . $recent_post['image']) ?>" alt="<?= $recent_post['tittle'] ?>">
													</a>
												<?php endif; ?>

												<div class="entry-header">
													<h5 class="entry-title"><a href="<?= base_url('blog/detail' . $recent_post['id']) ?>" class=" text-decoration-none text-muted"><?= $recent_post['tittle'] ?></a></h5>
													<div class="entry-meta">
														<span class="posted-on ml-4">
															on <time>
																<a href="javascript:void(0)" class=" text-decoration-none text-muted ">
																	<?= date("d F, Y", strtotime($recent_post['created_at'])) ?></a>
															</time>
														</span>
													</div>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>

							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php $this->load->view('front/footer.php') ?>
