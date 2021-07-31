<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view('front/header-css.php') ?>
	<title>About us the As blog | As blog </title>
</head>

<body>



	<?php $this->load->view('front/menu.php') ?>

	<div class="container-fluid mb-5">
		<div class="row">
			<div class="col-12 p-0 m-0">
				<div class="about-header ">
					<h1 class="text-capitalize "> Discover the As Blog Team</h1>
					<ul class="text-center">
						<li><a href="<?= base_url() ?>">Home</a></li>
						<li>About
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<section>
		<div class="container mb-5">
			<div class="row">
				<div class=" col-xl-5 col-lg-5  col-md-12 col-12  about-author-col">
					<div class="card  about-author-card w-100">
						<div class="card-body">
							<div class="place-container-button">
								<h2 class="title-author">Subhash Kumar</h2>

								<div class="hover-author">
									<p class="function-author">Founder &amp; Creative Director</p>

									<div class="auth-link">
										<i class="fal fa-horizontal-rule"></i>
										<a href="https://twitter.com/programmingask" target="_blank" class="twitter-author">
											<span class="fab fa-twitter"></span> @programmingask
										</a>
									</div>
								</div>
								<div class="description-author">
									<p>From the world of the arts and digital design, subhash kumar has been the founder &amp;
										creative director of the website as blog Media for 1 years.
										Based in india since 2020, curating creative content and playlists for a
										large worldwide community of creators and artists.</p>
								</div>
								<a href="javascript:void(0)" class="btn  mb-3 mt-5 author-btn">View articles</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-7 col-lg-7  col-md-12 col-12 about-author-img-col">
					<div class="about-author-img">
						<img src="<?= base_url('public/image/au.jpg') ?>" alt="" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</section>


	<section>
		<div class="container ">
			<div class="row mt-3 mb-3">
				<div class="col-12 mb-3 mt-4">
					<div class="text-left header-nav-center">
						<h2 class="text-uppercase"> <span>About</span> <span>As blog</span> </h2>
					</div>
				</div>
				<div class="col-12 mb-4">
					<p>With TermsFeed you stay compliant with the law.

						We work with lawyers attorneys paralegals solicitors and people from the legal industry to bring high-quality and on-demand legal agreements, so you can focus on your business.

						TermsFeed is a company spread out across the world. Lawyers attorneys and the people we work with are from all over the world.
					</p>
					<p>With TermsFeed you stay compliant with the law.

						We work with lawyers attorneys paralegals solicitors and people from the legal industry to bring high-quality and on-demand legal agreements, so you can focus on your business.

						TermsFeed is a company spread out across the world. Lawyers attorneys and the people we work with are from all over the world.
					</p>
					<p>With TermsFeed you stay compliant with the law.

						We work with lawyers attorneys paralegals solicitors and people from the legal industry to bring high-quality and on-demand legal agreements, so you can focus on your business.

						TermsFeed is a company spread out across the world. Lawyers attorneys and the people we work with are from all over the world.
					</p>
				</div>
			</div>
		</div>
	</section>



	<?php $this->load->view('front/footer.php') ?>
