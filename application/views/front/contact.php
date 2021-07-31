<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view('front/header-css.php') ?>
	<title> Contact us | contact to new latest blog post access | As blog</title>
</head>

<body>



	<?php $this->load->view('front/menu.php') ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-0 m-0">
				<div class="contact-header">
					<h1 class="text-capitalize "> Contact</h1>
					<ul class="text-center">
						<li><a href="<?= base_url() ?>">Home</a></li>
						<li>Contact Us
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<section class=" mt-5 mb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-12">
					<div class="contact_form_wrapper">
						<h2 class="contact_title"> <span>get</span> in touch</h2>
						<p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus quis officiis dolorum voluptas unde sit sequi cupiditate quae neque reiciendis. </p>
					</div>
					<form action="" class="contact_form" id="get_in_touch_form">
						<div class="form-single-col justify-content-between d-flex">
							<input type="text" class="form-control " id="user_get_in_touch_name" placeholder="First-name">
							<input type="text" class="form-control " placeholder="Last-name" id="user_get_in_touch_last_name">
						</div>
						<div class="form-single-col justify-content-between d-flex mt-5">
							<input type="text" class="form-control " placeholder="Email " id="user_get_in_touch_email">
							<input type="text" class="form-control " placeholder="Subject" id="user_get_in_touch_sub">
						</div>
						<div class="form-single-col mt-5">
							<textarea name="" rows="5" id="user_get_in_touch_msg" placeholder="Type your massage hare...."></textarea>
						</div>
						<button class="mt-2" type="submit">Submit</button>
					</form>

				</div>
				<div class="col-lg-5 col-md-5 col-12 mt">
					<div class="address">
						<h2 class="address_title"><span>get</span> address info</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
							In suscipit laborum possimus ex molestiae et sint ullam nisi beatae totam,
							architecto, pariatur corrupti odio cupiditate tenetur obcaecati eum? Rerum, illo.</p>
						<div class="address_text_wrapper mt-4 ">
							<div class="address_single_col d-flex">
								<i id="address_icon" class="fal fa-map-marker-alt "></i>
								<div class="add_contact ">
									<span class=" text-uppercase ">address :</span>
									<p>2th flor saket saidullazab </p>
								</div>
							</div>
							<div class="address_single_col d-flex">
								<i id="address_icon" class="fal fa-phone-alt"></i>
								<div class="add_contact ">
									<span class=" text-uppercase ">phone number :</span>
									<p>+918882802941 </p>
								</div>
							</div>
							<div class="address_single_col d-flex">
								<i id="address_icon" class="fal fa-envelope"></i>
								<div class="add_contact ">
									<span class=" text-uppercase ">Email address :</span>
									<p>arthlibrary@gmail.com</p>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php $this->load->view('front/footer.php') ?>
