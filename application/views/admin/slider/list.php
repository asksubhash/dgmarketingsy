<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Home page slider
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url() . 'admin/home/index' ?>"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active">Slider</li>
		</ol>
	</section>

	<section class="content container-fluid">
		<div class="box box-success">
			<div class="box-header ui-sortable-handle">
				<div class="row">
					<div class="box-header">
						<h3 class="box-title">Slider List</h3>
						<div class="btn-group pull-right">
							<a href="Javascript:void(0)" type="button" class="btn btn-default" id="add-new-slider-btn">
								<i class="fad fa-plus"></i>
								Add New Slider
							</a>
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<?php if (!empty($slider)) : ?>
							<table id="dataTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No..</th>
										<th>Image</th>
										<th>Category</th>
										<th>Tittle</th>
										<th>Status</th>
										<th>Created at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$i = 1;
									foreach ($slider as $slider_data) : ?>
										<tr>
											<td><?= $i++ ?></td>
											<td>
												<?php if ($slider_data['image'] !== '' && file_exists('./public/admin/uploads/slider/' . $slider_data['image'])) : ?>
													<img src="<?= base_url() . 'public/admin/uploads/slider/' . $slider_data['image']; ?>" width="50">
												<?php else : ?>
													<img src="<?= base_url() . 'public/admin/uploads/category/noimage.jpg ' ?>" width="50">
												<?php endif; ?>
											</td>
											<td>
												<?= $slider_data['cat_name']; ?>
											</td>
											<td>
												<?= $slider_data['tittle']; ?>
											</td>
											<td>
												<?php
												$btn_class = '';
												if ($slider_data['status'] == 0) {
													$btn_class = 'btn-warning';
												} else if ($slider_data['status'] == 1) {
													$btn_class = 'btn-success';
												}
												?>
												<button href="Javascript:void(0)" title="Click to active" data-value="<?= $slider_data['status']; ?>" data-id="<?= $slider_data['id']; ?>" class="slider_status_change_btn btn <?= $btn_class; ?> w-50"><?= ($slider_data['status'] == 0) ? 'Inactive' : 'Active' ?></button>
											</td>
											<td><?php echo $slider_data['created_at']; ?></td>
											<td>
												<a href="Javascript:void(0)" class="btn btn-warning edit_slider_btn" data-id="<?= $slider_data['id']; ?>"><span class="fa fa-edit"></span></a>
												<a href="Javascript:void(0)" class="btn btn-danger slider_delete_btn" data-id="<?= $slider_data['id']; ?>"><span class="fa fa-trash"></span></a>

											</td>
										</tr>
									<?php endforeach; ?>


								</tbody>
							</table>
						<?php else : ?>
							<tr>
								<td>No data found</td>
							</tr>
						<?php endif; ?>

						<!-- insert modal  -->
						<div class="modal fade" id="add-new-slider-modal">
							<div class="modal-dialog  modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Add New Home Page Slider</h4>
										<button type="button" class="close " data-dismiss="modal" aria-label="Close">
											<span class="fad fa-times"></span>
										</button>
									</div>

									<div class="modal-body">
										<form method="post" id="add_new_slider" enctype="multipart/form-data">
											<div class="row">

												<div class="col-md-12" id="slider_form_error">
												</div>

												<div class="col-md-6 form-group">
													<label>Slider Tittle <span class="red">*</span></label>
													<input type="text" name="slider_tittle" class="form-control" id="slider_tittle" placeholder="slider Tittle">
													<span class="text-danger slider_tittle_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Category <span class="red">*</span></label>
													<select name="slider_cate_id" id="slider_cate_id" class="form-control">
														<option value="">select category</option>
														<?php if (!empty($category)) :
															foreach ($category as $cat_data) :
														?>
																<option value="<?php echo $cat_data['id'] ?>"><?php echo $cat_data['name'] ?></option>
														<?php
															endforeach;
														endif;
														?>
													</select>
													<span class="text-danger slider_category_error"></span>
												</div>

												<div class="col-md-12 form-group">
													<label>slider Image <span class="red">*</span></label>
													<input type="file" name="slider_image" id="slider_image" class="form-control">
													<p class="help_block slider_image_error">Image should be in .jpg format and size should be less than 2MB;</p>
												</div>

											</div>

											<div class="row">
												<div class="col-xs-12 form-group text-center">
													<button type="submit" class="btn custom_submit_btn "><span class="fad fa-paper-plane"></span> Submit</button>
												</div>
											</div>
										</form>


									</div>

								</div>
							</div>
						</div>
						<!-- end insert modal  -->


						<!-- update modal  -->
						<div class="modal fade" id="update-slider-modal">
							<div class="modal-dialog  modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Update Home Page Slider</h4>
										<button type="button" class="close " data-dismiss="modal" aria-label="Close">
											<span class="fad fa-times"></span>
										</button>
									</div>

									<div class="modal-body">
										<form method="post" id="update_Slider_form" enctype="multipart/form-data">
											<div class="row">
												<input type="hidden" id="slider_id" />
												<div class="col-md-12" id="update_Slider_form_error">
												</div>

												<div class="col-md-6 form-group">
													<label>Slider Tittle <span class="red">*</span></label>
													<input type="text" name="update_Slider_tittle" class="form-control" id="update_Slider_tittle" placeholder="slider Tittle">
													<span class="text-danger update_Slider_tittle_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Category <span class="red">*</span></label>
													<select name="update_Slider_cate_id" id="update_Slider_cate_id" class="form-control">
													</select>
													<span class="text-danger update_slider_category_error"></span>
												</div>


												<div class="col-md-12 form-group">
													<label>Post Image</label>
													<input type="file" name="update_slider_image" id="update_slider_image" class="form-control">
													<p class="help_block update_slider_img_error">Image should be in .jpg format and size should be less than 2MB;</p>
													<div class="img-profile">
														<img src="" id="slider_adit_image" width="50">
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col-xs-12 form-group text-center">
													<button type="submit" class="btn custom_submit_btn "><span class="fad fa-paper-plane"></span> Submit</button>
												</div>
											</div>
										</form>


									</div>

								</div>
							</div>
						</div>
						<!-- end update modal  -->

					</div>
				</div>
			</div>
		</div>
	</section>

</div>
