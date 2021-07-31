$(document).ready(function () {
	var base_url = $('#base_url').val();

	$('#add-new-slider-btn').on('click', function () {
		$('#add-new-slider-modal').modal('show');
	});

	$('#add_new_slider').on('submit', function e(e) {
		e.preventDefault();
		let form_data = new FormData();
		let tittle = $('#slider_tittle').val();
		let cate_id = $('#slider_cate_id').val();
		let img_property = document.getElementById('slider_image').files['0'];

		if (tittle == '' || img_property == '') {
			$('#slider_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close text-white" data-dismiss="alert" aria-label="close">&times;</a> All <span class="red">*</span> mark field Required</div>');
		} else {
			if (img_property) {
				var image_name = img_property.name;
				var image_extension = image_name.split('.').pop().toLowerCase();

				if ($.inArray(image_extension, ['png', 'jpg', 'jpeg', ]) == -1) {
					$('.slider_image_error').html('');
					$('.slider_image_error').addClass('text-danger');
					$('.slider_image_error').append('Invalid Image Type. Only jpg, png, jpeg images are allowed.');
					return false;
				} else {
					var image_size = img_property.size;
					if (image_size > 2000000) {
						$('.slider_image_error').html('');
						$('.slider_image_error').addClass('text-danger');
						$('.slider_image_error').append('Invalid size. Size should be less than 2MB.');
						return false;
					} else {
						form_data.append('image', img_property);
					}
				}
			}

			form_data.append('tittle', tittle);
			form_data.append('cate_id', cate_id);
			form_data.append('form', 'ADD_NEW_SLIDER_FORM');

			$.ajax({
				type: "POST",
				url: base_url + "admin/slider/create",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				async: false,
				dataType: "json",
				success: function (response) {
					console.log(response);
					if (response.status == 'form_error') {
						$('.slider_tittle_error').html(response.slider_tittle_error);
						$('.slider_category_error').html(response.slider_category_error);
						$('.slider_image_error').html('');
						$('.slider_image_error').addClass('text-danger');
						$('.slider_image_error').html(response.slider_image_error);
					} else if (response.status == true) {
						swal("Good job!", response.msg, "success").then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal("oops", response.msg, "warning");;
					} else {
						$('#slider_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>Server not responding</div>');
					}

				}
			});
		}
	});

	// status change 
	$('.slider_status_change_btn').on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		let value = $(this).data('value');
		if (id !== '') {
			$.ajax({
				type: "POST",
				url: base_url + "admin/slider/status_update",
				data: {
					form: 'SLIDER_STATUS_CHANGE',
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
	$('.slider_delete_btn').on('click', function (e) {
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
							url: base_url + "admin/slider/delete",
							data: {
								form: 'DELETE_SLIDER_FORM',
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
						swal("Your slider record is safe!");
					}
				});
		} else {
			swal('warning ', 'wrong credential', 'warning');
		}
	});

	// show slider data 
	$('.edit_slider_btn').on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		if (id !== '') {
			$.ajax({
				type: "POST",
				url: base_url + "admin/slider/showSlider",
				data: {
					form: 'GET_SLIDER_DATA',
					id: id
				},
				dataType: "json",
				success: function (response) {
					if (response.status == true) {
						data = response.data;
						$('#update_Slider_tittle').val(data.tittle);
						$('#slider_id').val(data.id);
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
						$('#update_Slider_cate_id').append(select_option);

						let img = $('#slider_adit_image');
						img.attr('src', base_url + './public/admin/uploads/slider/' + data.image);
						$('#update-slider-modal').modal('show');

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
	$('#update_Slider_form').on('submit', function (e) {

		e.preventDefault();
		let form_data = new FormData();
		let tittle = $('#update_Slider_tittle').val();
		let cate_id = $('#update_Slider_cate_id').val();
		let slider_id = $('#slider_id').val();
		let img_property = document.getElementById('update_slider_image').files['0'];

		if (tittle == '' || cate_id == '' || slider_id == '') {
			$('#update_Slider_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close text-white" data-dismiss="alert" aria-label="close">&times;</a> All <span class="red">*</span> mark field Required</div>');
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
			form_data.append('cate_id', cate_id);
			form_data.append('id', slider_id);
			form_data.append('form', 'UPDATE_SLIDER_FORM');

			$.ajax({
				type: "POST",
				url: base_url + "admin/slider/update",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				async: false,
				dataType: "json",
				success: function (response) {
					console.log(response);
					if (response.status == 'form_error') {
						$('.update_Slider_tittle_error').html(response.update_Slider_tittle_error);
						$('.update_slider_category_error').html(response.update_slider_category_error);

						$('.update_slider_img_error').html('');
						$('.update_slider_img_error').addClass('text-danger');
						$('.update_slider_img_error').html(response.update_slider_img_error);
					} else if (response.status == true) {
						swal("Good job!", response.msg, "success").then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal("oops", response.msg, "warning");;
					} else {
						$('#update_Slider_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>Server not responding</div>');
					}

				}
			});
		}

	});

});
