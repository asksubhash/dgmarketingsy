$(document).ready(function () {
	var base_url = $('#base_url').val();
	$('#owl-carousel').owlCarousel({
		loop: true,
		margin: 30,
		dots: false,
		nav: true,
		navText: ["<button class='owl-left'> <span class='fad fa-chevron-left'></span></button > ", " <button class='owl-right'> <span class='fad fa-chevron-right'></span></button > "],
		animateOut: 'fadeOut',
		autoplay: true,
		autoplayHoverPause: true,
		items: 1,
	})

	$('#get_in_touch_form').on('submit', function (e) {
		e.preventDefault();
		let name = $('#user_get_in_touch_name').val();
		let l_name = $('#user_get_in_touch_last_name').val();
		let email = $('#user_get_in_touch_email').val();
		let subject = $('#user_get_in_touch_sub').val();
		let desc = $('#user_get_in_touch_msg').val();
		let mail_format = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

		if (name == '' || l_name == '' || email == '' || subject == '' || desc == '') {
			swal('', 'all field required | please care fully inter your detail', 'warning');
		} else {
			if (!email.match(mail_format)) {
				swal('invalid email ', 'You have entered an invalid email address!', 'warning');
			} else if (name.length < 3) {
				swal('invalid name ', 'please inter at least 4 character string!', 'warning');
			} else if (l_name.length < 3) {
				swal('invalid last name ', 'please inter at least 4 character string!', 'warning');
			} else if (subject.length < 5) {
				swal('invalid subject ', 'please inter at least 5 character string!', 'warning');
			} else if (desc.length < 10) {
				swal('invalid description ', 'please inter at least 10 character string!', 'warning');
			} else {
				$.ajax({
					type: "POST",
					url: base_url + "page/insertGetInTouch",
					data: {
						form: 'GET_IN_TOUCH_FORM',
						name: name,
						last_name: l_name,
						email: email,
						subject: subject,
						desc: desc

					},
					dataType: "json",
					success: function (response) {
						if (response.status == true) {
							swal('Good Job!..', response.msg, 'success').then(() => {
								window.location.reload();
							});
						} else if (response.status == false) {
							swal('warning', response.msg, 'warning');
						} else if (response.status == 'form_error') {
							if (response.name_error !== '') {
								swal('name  ', response.name_error, 'warning');
							} else if (response.l_name_error !== '') {
								swal('Last Name ', response.l_name_error, 'warning');
							} else if (response.email_error !== '') {
								swal('email ', response.email_error, 'warning');
							} else if (response.subject_error !== '') {
								swal('subject ', response.subject_error, 'warning');
							} else if (response.desc_error !== '') {
								swal('description ', response.desc_error, 'warning');
							}

						} else {
							swal('error', 'server not responding', 'error');
						}
					}
				});
			}


		}

	});

	$('#news_letter_form').on('submit', function (e) {
		e.preventDefault();
		let email = $('#news_letter_email').val();
		let mail_format = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
		if (email == '') {
			swal('', 'Email field required', 'warning');
		} else {
			if (!email.match(mail_format)) {
				swal('invalid email ', 'You have entered an invalid email address!', 'warning');
			}
			$.ajax({
				type: "POST",
				url: base_url + "page/newsLetter",
				data: {
					form: 'NEWS_LETTER_EMAIL_FORM',
					email: email,
				},
				dataType: "json",
				success: function (response) {
					if (response.status == true) {
						swal('Good Job!..', response.msg, 'success').then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal('warning', response.msg, 'warning');
					} else if (response.status == 'form_error') {
						if (response.email_error !== '') {
							swal('email ', response.email_error, 'warning');
						}

					} else {
						swal('error', 'server not responding', 'error');
					}
				}
			});

		}

	});

	// user comment on post 
	$('#user_comment_form').on('submit', function (e) {
		e.preventDefault();
		let name = $(this).find('#user_name').val();
		let comment = $(this).find('#user_comment').val();
		let post_id = $(this).find('#post_id').val();
		if (name !== '' || comment !== '' || post_id !== '') {
			$.ajax({
				type: "POST",
				url: base_url + "blog/insertUserComment",
				data: {
					form: 'USER_COMMENT_FORM',
					name: name,
					comment: comment,
					post_id: post_id,
				},
				dataType: "json",
				success: function (response) {
					if (response.status == true) {
						swal('Good Job!..', response.msg, 'success').then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal('warning', response.msg, 'warning');
					} else if (response.status == 'form_error') {
						if (response.name_error !== '') {
							swal('name ', response.name_error, 'warning');
						} else if (response.comment_error !== '') {
							swal('comment ', response.comment_error, 'warning');
						}

					} else {
						swal('error', 'server not responding', 'error');
					}
				}
			});
		} else {
			swal(' ', 'Please Enter Your Detail Or Comment', 'warning');
		}

	})
});
