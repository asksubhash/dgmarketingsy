<!-- news letter -->
<section>
	<div class="footer-newsletter">
		<div class="block_footer_newsletter text-center">
			<div class=" mb-4 ">
				<h3 id="title-part">Stay Updated</h3>
				<span class="text-newsletter text-muted">Get the latest creative news from As blog about art, design...</span>
			</div>
			<div class="row m-0 p-0">
				<div class="col-10 offset-1 col-lg-8 offset-lg-2 d-flex justify-content-center align-items-center">
					<form class="form-inline" id="news_letter_form">
						<div class="form-group mx-sm-3 mb-2">
							<input type="email" class="form-control new-letter-input w-100" id="news_letter_email" placeholder="Your email address">
						</div>
						<button type="submit" class="btn text-uppercase mb-2">Sign Up</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end  news letter -->
<footer>
	<div class="container ">
		<div class="row ">
			<div class="col-md-4 mt-5">
				<section>
					<div class="footer-brand-img">
						<p><a href=""><img src="<?= base_url('public/image/logo.png'); ?>" alt=""></a></p>
						<p class="text-muted">Fashion is a popular style or practice, especially in clothing, footwear, accessories, makeup, hairstyle and body. Fashion is a distinctive and often constant trend in the style in which a person dresses.</p>
					</div>
				</section>
			</div>
			<div class="col-md-2 mt-5">
				<h5 class="widget-title">Browse Categories</h5>
				<div class="footer-category">
					<ul class="list-unstyled ">
						<?php if (!empty($category)) :
							foreach ($category as $cat) :
						?>
								<li>
									<a href="<?= base_url('blog/category/' . $cat['id']) ?>"><?= $cat['name'] ?></a>
								</li>
						<?php endforeach;
						endif; ?>
					</ul>
				</div>
			</div>
			<div class="col-md-3 mt-5">
				<h5 class="widget-title">Recent Posts</h5>
				<div>
					<?php if (!empty($recent_post)) : ?>
						<?php foreach ($recent_post as $r_post) : ?>
							<div class="recent_post_wrapper d-flex mb-4">
								<div class="img_wrapper">
									<?php if (file_exists('./public/admin/uploads/post/' . $r_post['image'])) : ?>
										<a href="<?= base_url('blog/detail/' . $r_post['id']) ?>" class="post-thumbnail mt-1">
											<img width="68" height="53" src="<?= base_url('public/admin/uploads/post/' . $r_post['image']) ?>" alt="<?= $r_post['tittle'] ?>">
										</a>
									<?php endif; ?>

								</div>
								<div class="content_wrapper">
									<div class="entry-header">
										<span class="cat_tittle"><a href="<?= base_url('blog/category/' . $r_post['cat_id']) ?>" target="_self" alt="<?= $r_post['category_name'] ?>"> <?= $r_post['category_name'] ?></a></span>
										<h3 class="entry-title"><a target="_self" href="<?= base_url('blog/detail/' . $r_post['id']) ?>"> <?= $r_post['tittle'] ?></a></h3>

										<div class="entry-meta">
											<span class="posted-on"><a href="javascript:void(0)"><?= date("d F Y", strtotime($r_post['created_at'])) ?></time></a></span>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-md-3 mt-5">
				<h5 class="widget-title">Useful Links</h5>
				<div class="footer-category">
					<ul class="list-unstyled ">
						<li>
							<a href="">About Us</a>
						</li>
						<li>
							<a href="">Contact Us</a>
						</li>
						<li>
							<a href="">Site Map</a>
						</li>
						<li>
							<a href="">Contact Us</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="site-info">
		<div class="container-fluid">
			<span class="copyright">2021 Copyright <a href="<?= base_url() ?>">As Blog</a>. </span><span>| Developed By<a href="" rel="nofollow" target="_blank"> Dev Ask</a></span>.<span class="wp-link"> Powered by <a href="<?= base_url() ?>" target="_blank">codeigniter</a>.</span>
		</div>
	</div>
</footer>


<input type="hidden" id="base_url" value="<?= base_url() ?>">
<script src="<?= base_url('public/js/jquery.js') ?>"></script>
<script src="<?= base_url('public/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('public/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('public/admin/plugins/sweetAlert.js') ?>"></script>
<script src="<?= base_url('public/js/home.js') ?>"></script>
</body>

</html>
