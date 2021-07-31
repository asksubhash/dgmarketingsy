<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?= $post['tittle']; ?> | As blog</title>
	<?php $this->load->view('front/header-css.php'); ?>

</head>

<body>



	<?php $this->load->view('front/menu.php') ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-0 m-0">
				<div class="blog-header">
					<h1 class="text-capitalize "> <?= $post['tittle']; ?></h1>
					<ul class="text-center">
						<li><a href="<?= base_url(); ?>">Home</a></li>
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
					<div class="row">
						<div class="col-12">
							<div class=" mt-5 post-details-di">
								<header class="entry-header mb-3">
									<h1 class="entry-title"><?= $post['tittle']; ?></h1>
									<div class="entry-meta">
										<div class="entry-meta">
											<span>By <a href="javascript:void(0)" class="text-decoration-none font-italic mr-2 text-muted"><?= $post['author_name']; ?></a></span><span>created on <a href="javascript:void(0)" rel="bookmark" class="text-decoration-none font-italic text-muted"><time><?= date("d F, Y", strtotime($post['created_at'])) ?></time></a></span>
										</div>
									</div>
								</header>
								<div class="card rounded-0 border-0   bg-light mb-5">
									<?php if (file_exists('./public/admin/uploads/post/' . $post['image'])) : ?>
										<img src="<?= base_url('public/admin/uploads/post/' . $post['image']) ?>" class="card-img-top  rounded-0 border-0" alt="<?= $post['tittle']; ?>">
									<?php endif; ?>
									<div class="card-body border-bottom border-muted mt-3 p-0 ">
										<div>
											<?= $post['desc']; ?>
										</div>
									</div>
									<div class="mt-3">
										<span class=" fa fa-folder-open"></span>
										<span>
											<a href="javascript:void(0)" class="text-muted text-decoration-none"><?= $post['category_name'] ?></a>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12  ">
							<h2 class="text-muted">Comment</h2>
							<div class="card mt-3 mb-3">
								<div class="card-body">
									<form id="user_comment_form">
										<div class="form-group">
											<textarea name="" id="user_comment" class="form-control  rounded-0 " placeholder="Comment Here..."></textarea>
										</div>
										<div class="form-group col-md-5 ml-0 p-0 ">
											<input type="hidden" id="post_id" value="<?= $post['id'] ?>">
											<input type="text" class="form-control rounded-0 " id="user_name" placeholder="Enter Your Name">
										</div>

										<button type="submit" class="btn rounded-0">Submit</button>
									</form>

									<?php if (!empty($comment)) : ?>
										<div class="col-12 pl-0 mt-4">
											<?php foreach ($comment as $comments) : ?>
												<div class=" user-comments  border-bottom mb-4">
													<div class="d-flex">
														<span class="fal fa-user pr-2 "></span>
														<p class="pb-0 mt-0 mb-1 "> <strong class="text-muted"><?= $comments['name'] ?></strong> </p>
													</div>
													<p class=" font-italic ml-3 ">
														<?= $comments['comment'] ?>..
														<a href="javascript:void(0)" class=" text-decoration-none text-muted" data-id="<?= $comments['id'] ?>" id="user_comment_reply"> <span class="fad fa-share"></span> Reply </a>
													</p>

												</div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>

								</div>
							</div>
						</div>
						<div class="col-12 mt-5">

							<div class="text-left mb-3 ">
								<h3 class="text-uppercase text-muted"> <span>RELATED</span> <span> Posts</span> </h3>
							</div>
							<?php if (!empty($latest_posts)) : ?>
								<div class="row">
									<?php foreach ($latest_posts as $latest) : ?>
										<div class="col-xl-4 col-lg-4 col-md-6 col-12 mt-3 mb-5">
											<div class="card border-0 rounded-0 bg-light h-100">
												<?php if (file_exists('./public/admin/uploads/post/' . $latest['image'])) : ?>
													<a href="<?= base_url('blog/detail/' . $latest['id']) ?>">
														<img src="<?= base_url('public/admin/uploads/post/' . $latest['image']) ?>" class="card-img-top  rounded-0 border-0" height="155" alt="<?= $post['tittle']; ?>">
													</a>
												<?php endif; ?>
												<div class="card-body p-0 m-0">
													<h5 class=" mt-3 "> <a href="<?= base_url('blog/detail/' . $latest['id']) ?>" class="m-0 p-0 text-decoration-none text-dark"><?= $latest['tittle'] ?></a> </h5>
													<a href="javascript:void(0)" class="m-0 p-0 text-decoration-none text-muted "><?= date("d F, Y", strtotime($latest['created_at'])) ?> </a>

												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

						</div>

					</div>
				</div>

				<div class="col-xl-4 col-lg-4 col-md-12 col-12  mt-4  ">
					<div class="row">
						<div class="col-12">
							<section class="categories-blog-p mt-5 ml-xl-5 ">
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
							<section class="categories-blog-p mt-5 ml-xl-5">
								<h5 class="text-muted text-uppercase "><strong>FOLLOW US ON</strong></h5>
								<ul class=" list-unstyled pb-3 pt-2 d-flex">
									<li class="   pt-1 pb-1 follow-us-font-li"><a href="" class=" font-weight-normal border text-decoration-none border-0"><span class="fab fa-facebook-f "></span> </a> </li>
									<li class="   pt-1 pb-1 pl-2 follow-us-font-li"><a href="" class=" font-weight-normal border text-decoration-none border-0"><span class="fab fa-twitter "></span> </a> </li>
									<li class="   pt-1 pb-1 pl-2 follow-us-font-li "><a href="" class=" font-weight-normal border text-decoration-none border-0"><span class="fab fa-instagram "></span> </a> </li>
								</ul>

							</section>
						</div>
						<div class="col-12 mb-2">
							<section class="categories-blog-p mt-5 ml-xl-5 ">
								<h5 class="text-muted text-uppercase "><strong>RECENT POSTS </strong></h5>
								<?php if (!empty($recent_posts)) : ?>
									<ul class=" list-unstyled pb-3 pt-2  recent-blog-post-site">

										<?php foreach ($recent_posts as $recent_post) : ?>
											<li class=" d-flex ">
												<?php if (file_exists('./public/admin/uploads/post/' . $recent_post['image'])) : ?>
													<a href="<?= base_url('blog/detail/' . $recent_post['id']) ?>" class="post-thumbnail mt-1">
														<img width="68" height="53" src="<?= base_url('public/admin/uploads/post/' . $recent_post['image']) ?>" alt="<?= $recent_post['tittle'] ?>">
													</a>
												<?php endif; ?>

												<div class="entry-header">
													<h5 class="entry-title"><a href="<?= base_url('blog/detail/' . $recent_post['id']) ?>"><?= $recent_post['tittle'] ?></a></h5>
													<div class="entry-meta">
														<span class="posted-on ml-4">
															on
															<time>
																<a href="javascript:void(0)" class=" text-decoration-none ">
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
