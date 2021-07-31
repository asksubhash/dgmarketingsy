$(document).ready(function () {
	var base_url = $('#base_url').val();

	$('#add-new-post-btn').on('click', function () {
		$('#add-new-post-modal').modal('show');
	});

	$('#add_new_post').on('submit', function e(e) {
		e.preventDefault();
		let form_data = new FormData();
		let tittle = $('#post_tittle').val();
		let cate_id = $('#cate_id').val();
		let meta = $('#post_meta').val();
		let slug = $('#post_slug').val();
		let desc = $('#post_desc').val();
		let post_author = $('#post_author').val();
		let img_property = document.getElementById('post_image').files['0'];

		if (tittle == '' || cate_id == '' || meta == '' || slug == '' || desc == '' || img_property == '' || post_author == '') {
			$('#post_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close text-white" data-dismiss="alert" aria-label="close">&times;</a> All <span class="red">*</span> mark field Required</div>');
		} else {
			if (img_property) {
				var image_name = img_property.name;
				var image_extension = image_name.split('.').pop().toLowerCase();

				if ($.inArray(image_extension, ['png', 'jpg', 'jpeg', ]) == -1) {
					$('.post_image_error').html('');
					$('.post_image_error').addClass('text-danger');
					$('.post_image_error').append('Invalid Image Type. Only jpg, png, jpeg images are allowed.');
					return false;
				} else {
					var image_size = img_property.size;
					if (image_size > 2000000) {
						$('.post_image_error').html('');
						$('.post_image_error').addClass('text-danger');
						$('.post_image_error').append('Invalid size. Size should be less than 2MB.');
						return false;
					} else {
						form_data.append('image', img_property);
					}
				}
			}
			form_data.append('tittle', tittle);
			form_data.append('author', post_author);
			form_data.append('cate_id', cate_id);
			form_data.append('meta', meta);
			form_data.append('slug', slug);
			form_data.append('desc', desc);
			form_data.append('form', 'ADD_NEW_POST_FORM');

			$.ajax({
				type: "POST",
				url: base_url + "admin/post/create",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				async: false,
				dataType: "json",
				success: function (response) {
					console.log(response);
					if (response.status == 'form_error') {
						$('.post_tittle_error').html(response.post_tittle_error);
						$('.post_category_error').html(response.post_category_error);
						$('.post_meta_error').html(response.post_meta_error);
						$('.post_slug_error').html(response.post_slug_error);
						$('.post_desc_error').html(response.post_desc_error);
						$('.post_author_error').html(response.post_author_error);

						$('.post_image_error').html('');
						$('.post_image_error').addClass('text-danger');
						$('.post_image_error').html(response.post_image_error);
					} else if (response.status == true) {
						swal("Good job!", response.msg, "success").then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal("oops", response.msg, "warning");;
					} else {
						$('#post_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>Server not responding</div>');
					}

				}
			});
		}
	});

	// status change 
	$('.post_status_change_btn').on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		let value = $(this).data('value');
		if (id !== '') {
			$.ajax({
				type: "POST",
				url: base_url + "admin/post/status_update",
				data: {
					form: 'POST_STATUS_CHANGE',
					id: id,
					value: value
				},
				dataType: "json",
				success: function (response) {
					if (response.status == true) {
						swal('Good job!..', response.msg, 'success').then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal('warning', response.msg, 'warning');
					} else {
						swal('warning', 'server not responding', 'warning');
					}
				}
			});
		}
	})

	// delete record 
	$('.post_delete_btn').on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		if (id !== '') {
			swal({
					title: "Are you sure?",
					text: "Once deleted, you will not be able to recover this record!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {

						$.ajax({
							type: "POST",
							url: base_url + "admin/post/delete",
							data: {
								form: 'DELETE_POST_FORM',
								id: id
							},
							dataType: "json",
							success: function (response) {
								if (response.status == true) {
									swal('Good job!..', response.msg, 'success').then(() => {
										window.location.reload();
									});
								} else if (response.status == false) {
									swal('warning', response.msg, 'warning');
								} else {
									swal('warning', 'server not responding', 'warning');
								}
							}
						});

					} else {
						swal("Your post record is safe!");
					}
				});
		} else {
			swal('warning ', 'wrong credential', 'warning');
		}
	});

	// show post data 
	$('.edit_post_btn').on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		if (id !== '') {
			$.ajax({
				type: "POST",
				url: base_url + "admin/post/showPost",
				data: {
					form: 'GET_POST_DATA',
					id: id
				},
				dataType: "json",
				success: function (response) {
					if (response.status == true) {
						data = response.data;
						$('#update_post_tittle').val(data.tittle);
						$('#update_post_meta').val(data.meta_tittle);
						$('#update_post_slug').val(data.slug);
						$('#update_post_author').val(data.author_name);
						$('#post_id').val(data.id);
						$('#update_post_desc').html(data.desc);
						$('#update_post_desc').summernote('code');

						var select_option =
							'<option value="">Select Category</option>';
						$.each(
							response.category,
							function (key, value) {
								if (value.id == data.cat_id) {
									select_option +=
										'<option value="' +
										value.id +
										'" selected="selected">' +
										value.name +
										'</option>';
								} else {
									select_option +=
										'<option value="' +
										value.id +
										'">' +
										value.name +
										'</option>';
								}
							}
						);
						$('#update_cate_id').append(select_option);

						let img = $('#post_adit_image');
						img.attr('src', base_url + './public/admin/uploads/post/' + data.image);
						$('#update-post-modal').modal('show');

					} else if (response.status == false) {
						swal('warning', response.msg, 'warning');
					} else {
						swal('warning', 'server not responding', 'warning');
					}
				}
			});
		}
	});


	// update record 
	$('#update_post_form').on('submit', function (e) {

		e.preventDefault();
		let form_data = new FormData();
		let tittle = $('#update_post_tittle').val();
		let cate_id = $('#update_cate_id').val();
		let meta = $('#update_post_meta').val();
		let slug = $('#update_post_slug').val();
		let desc = $('#update_post_desc').val();
		let post_author = $('#update_post_author').val();
		let post_id = $('#post_id').val();
		let img_property = document.getElementById('update_post_image').files['0'];

		if (tittle == '' || cate_id == '' || meta == '' || slug == '' || desc == '' || post_author == '' || post_id == '') {
			$('#update_post_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close text-white" data-dismiss="alert" aria-label="close">&times;</a> All <span class="red">*</span> mark field Required</div>');
		} else {

			if (img_property) {
				var image_name = img_property.name;
				var image_extension = image_name.split('.').pop().toLowerCase();

				if ($.inArray(image_extension, ['png', 'jpg', 'jpeg', ]) == -1) {
					$('.update_post_img_error').html('');
					$('.update_post_img_error').addClass('text-danger');
					$('.update_post_img_error').append('Invalid Image Type. Only jpg, png, jpeg images are allowed.');
					return false;
				} else {
					var image_size = img_property.size;
					if (image_size > 2000000) {
						$('.update_post_img_error').html('');
						$('.update_post_img_error').addClass('text-danger');
						$('.update_post_img_error').append('Invalid size. Size should be less than 2MB.');
						return false;
					} else {
						form_data.append('image', img_property);
					}
				}
			}

			form_data.append('tittle', tittle);
			form_data.append('author', post_author);
			form_data.append('cate_id', cate_id);
			form_data.append('id', post_id);
			form_data.append('meta', meta);
			form_data.append('slug', slug);
			form_data.append('desc', desc);
			form_data.append('form', 'UPDATE_POST_FORM');

			$.ajax({
				type: "POST",
				url: base_url + "admin/post/update",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				async: false,
				dataType: "json",
				success: function (response) {
					console.log(response);
					if (response.status == 'form_error') {
						$('.update_post_tittle_error').html(response.update_post_tittle_error);
						$('.update_post_category_error').html(response.update_post_category_error);
						$('.update_post_meta_error').html(response.update_post_meta_error);
						$('.update_post_slug_error').html(response.update_post_slug_error);
						$('.update_post_desc_error').html(response.update_post_desc_error);
						$('.update_post_author_error').html(response.update_post_author_error);

						$('.update_post_image_error').html('');
						$('.update_post_image_error').addClass('text-danger');
						$('.update_post_image_error').html(response.update_post_image_error);
					} else if (response.status == true) {
						swal("Good job!", response.msg, "success").then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal("oops", response.msg, "warning");;
					} else {
						$('#update_post_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>Server not responding</div>');
					}

				}
			});
		}

	});

});
