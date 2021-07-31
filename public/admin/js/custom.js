$(function () {

	var base_url = $('#base_url').val();


	$('#add-new-category-btn').on('click', function () {
		$('#add-new-cat-modal').modal('show');
	});

	// new record insert 
	$('#add_new_cat').submit(function (e) {
		e.preventDefault();
		let form_data = new FormData();
		let cat_name = $('#category_name').val();
		let cat_desc = $('#category_desc').val();
		let img_property = document.getElementById('cat_image').files[0];

		if (img_property) {
			var image_name = img_property.name;
			var image_extension = image_name.split('.').pop().toLowerCase();

			if ($.inArray(image_extension, ['png', 'jpg', 'jpeg', ]) == -1) {
				$('.cate_img_error').html('');
				$('.cate_img_error').addClass('text-danger');
				$('.cate_img_error').append('Invalid Image Type. Only jpg, png, jpeg images are allowed.');
				return false;
			} else {
				var image_size = img_property.size;
				if (image_size > 2000000) {
					$('.cate_img_error').html('');
					$('.cate_img_error').addClass('text-danger');
					$('.cate_img_error').append('Invalid size. Size should be less than 2MB.');
					return false;
				} else {
					form_data.append('image', img_property);
				}
			}
		}

		form_data.append('category_name', cat_name);
		form_data.append('category_desc', cat_desc);
		form_data.append('form', 'CATEGORY_INSERT_FORM');


		if (cat_name != "" && cat_desc != "") {
			$.ajax({
				type: "POST",
				url: base_url + "admin/category/create",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				async: false,
				dataType: "json",
				beforeSend: function () {
					$('#a-loader-box').fadeIn();
				},
				success: function (response) {
					if (response.status == 'form_error') {
						$('.cate_name_error').html(response.category_name_error);
						$('.cate_desc_error').html(response.category_desc_error);
						$('.cate_img_error').html('');
						$('.cate_img_error').addClass('text-danger');
						$('.cate_img_error').html(response.category_image_error);
					} else if (response.status == true) {
						swal("Good job!", response.msg, "success").then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal("oops", response.msg, "warning");;
					} else {
						$('#category_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>Server not responding</div>');
					}
				}
			});
		} else {
			$('#category_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>All field Required</div>');
		}
	});

	// status change 
	$('.category_status').on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		let value = $(this).data('value');
		if (id !== '') {
			$.ajax({
				type: "POST",
				url: base_url + "admin/category/status_update",
				data: {
					form: 'CATEGORY_STATUS_CHANGE',
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
	$('.category_delete_btn').on('click', function (e) {
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
							url: base_url + "admin/category/delete",
							data: {
								form: 'DELETE_CATEGORY_FORM',
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
						swal("Your category record is safe!");
					}
				});
		} else {
			swal('warning ', 'wrong credential', 'warning');
		}
	});

	// show category data 
	$('.edit_category_btn').on('click', function (e) {
		e.preventDefault();
		let id = $(this).data('id');
		if (id !== '') {
			$.ajax({
				type: "POST",
				url: base_url + "admin/category/showCategory",
				data: {
					form: 'GET_CATEGORY_DATA',
					id: id
				},
				dataType: "json",
				success: function (response) {
					if (response.status == true) {
						data = response.data;
						$('#update_category_name').val(data.name);
						$('#update_category_desc').html(data.desc);
						$('#update_category_desc').summernote('code');
						$('#category_id').val(data.id);
						let img = $('#cat_adit_image');
						img.attr('src', base_url + './public/admin/uploads/category/' + data.image);
						$('#update-cat-modal').modal('show');
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
	$('#update_category').on('submit', function (e) {

		e.preventDefault();
		let form_data = new FormData();
		let cat_name = $('#update_category_name').val();
		let cat_desc = $('#update_category_desc').val();
		let id = $('#category_id').val();
		let img_property = document.getElementById('update_cat_image').files[0];

		if (img_property) {
			var image_name = img_property.name;
			var image_extension = image_name.split('.').pop().toLowerCase();

			if ($.inArray(image_extension, ['png', 'jpg', 'jpeg', ]) == -1) {
				$('.cate_img_error').html('');
				$('.cate_img_error').addClass('text-danger');
				$('.cate_img_error').append('Invalid Image Type. Only jpg, png, jpeg images are allowed.');
				return false;
			} else {
				var image_size = img_property.size;
				if (image_size > 2000000) {
					$('.cate_img_error').html('');
					$('.cate_img_error').addClass('text-danger');
					$('.cate_img_error').append('Invalid size. Size should be less than 2MB.');
					return false;
				} else {
					form_data.append('image', img_property);
				}
			}
		}

		form_data.append('id', id);
		form_data.append('category_name', cat_name);
		form_data.append('category_desc', cat_desc);
		form_data.append('form', 'CATEGORY_UPDATE_FORM');


		if (cat_name != "" && cat_desc != "") {
			$.ajax({
				type: "POST",
				url: base_url + "admin/category/update",
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				async: false,
				dataType: "json",
				beforeSend: function () {
					$('#a-loader-box').fadeIn();
				},
				success: function (response) {
					if (response.status == 'form_error') {
						$('.update_cate_name_error').html(response.category_name_error);
						$('.update_cate_desc_error').html(response.category_desc_error);
						$('.update_cate_img_error').html('');
						$('.update_cate_img_error').addClass('text-danger');
						$('.update_cate_img_error').html(response.category_image_error);
					} else if (response.status == true) {
						swal("Good job!", response.msg, "success").then(() => {
							window.location.reload();
						});
					} else if (response.status == false) {
						swal("oops", response.msg, "warning");;
					} else {
						$('#update_category_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>Server not responding</div>');
					}
				}
			});
		} else {
			$('#update_category_form_error').append('<div class="alert alert-warning alert-dismissible"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>All field Required</div>');
		}

	});

});
