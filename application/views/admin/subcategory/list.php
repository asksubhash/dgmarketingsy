<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Category
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url() . 'admin/home/index' ?>"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active">Category</li>
		</ol>
	</section>

	<section class="content container-fluid">
		<div class="box box-success">
			<div class="box-header ui-sortable-handle">
				<div class="row">
					<div class="box-header">
						<h3 class="box-title">Category List</h3>
						<div class="btn-group pull-right">
							<a href="Javascript:void(0)" type="button" class="btn btn-default" id="add-new-category-btn">
								<i class="fad fa-plus"></i>
								Add New Category
							</a>
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<?php if (!empty($subcategory)) : ?>
							<table id="dataTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th >No..</th>
										<th>Name</th>
										<th >Status</th>
										<th>Created at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody class="category_data_tbody">

									<?php
									$i = 1;
									foreach ($subcategory as $cat_data) : ?>
										<tr>
											<td ><?= $i++ ?></td>
											
											<td >
												<?= $cat_data['name']; ?>
											</td>
											<td>
												<?php
												$btn_class = '';
												if ($cat_data['status'] == 0) {
													$btn_class = 'btn-warning';
												} else if ($cat_data['status'] == 1) {
													$btn_class = 'btn-success';
												}
												?>
												<button href="Javascript:void(0)" title="Click to active" data-value="<?= $cat_data['status']; ?>" data-id="<?= $cat_data['id']; ?>" class="category_status btn <?= $btn_class; ?> w-50"><?= ($cat_data['status'] == 0) ? 'Inactive' : 'Active' ?></button>
											</td>
											<td width="200"><?php echo $cat_data['created_at']; ?></td>
											<td>
												<a href="Javascript:void(0)" class="btn btn-warning edit_category_btn" data-id="<?= $cat_data['id']; ?>"><span class="fa fa-edit"></span></a>
												<a href="Javascript:void(0)" class="btn btn-danger category_delete_btn" data-id="<?= $cat_data['id']; ?>"><span class="fa fa-trash"></span></a>

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
						<div class="modal fade" id="add-new-sub_cat-modal">
							<div class="modal-dialog  modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Add New Category</h4>
										<button type="button" class="close " data-dismiss="modal" aria-label="Close">
											<span class="fad fa-times"></span>
										</button>
									</div>

									<div class="modal-body">
										<form method="post" id="add_new_cat" enctype="multipart/form-data">
											<div class="row">

												<div class="col-md-12" id="category_form_error">
												</div>

												<div class="col-md-6 form-group">
													<label>Category Name <span class="red">*</span></label>
													<input type="text" name="category_name" class="form-control" id="category_name" placeholder="category Name">
													<span class="text-danger cate_name_error"></span>
												</div>
												<div class="col-md-6 form-group">
													<label>Category Image <span class="red">*</span></label>
													<input type="file" name="cat_image" id="cat_image" class="form-control">
													<p class="help_block cate_img_error">Image should be in .jpg format and size should be less than 2MB;</p>

												</div>
												<div class="col-md-12 form-group">
													<label>Short Description <span class="red">*</span></label>
													<textarea type="text" class="form-control summernote " id="category_desc" name="category_desc" placeholder="category description" cols="30" rows="10"></textarea>
													<span class="text-danger cate_desc_error"></span>
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
						<div class="modal fade" id="update-cat-modal">
							<div class="modal-dialog  modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Update Category</h4>
										<button type="button" class="close " data-dismiss="modal" aria-label="Close">
											<span class="fad fa-times"></span>
										</button>
									</div>

									<div class="modal-body">
										<form method="post" id="update_category" enctype="multipart/form-data">
											<div class="row">
												<input type="hidden" id="category_id" />
												<div class="col-md-12" id="update_category_form_error">
												</div>

												<div class="col-md-6 form-group">

													<label>Category Name <span class="red">*</span></label>
													<input type="text" name="update_category_name" class="form-control" id="update_category_name" placeholder="category Name">
													<span class="text-danger update_cate_name_error"></span>
												</div>
												<div class="col-md-6 form-group">
													<label>Category Image</label>
													<input type="file" name="update_cat_image" id="update_cat_image" class="form-control">
													<p class="help_block update_cate_img_error">Image should be in .jpg format and size should be less than 2MB;</p>
													<div class="img-profile">
														<img src="" id="cat_adit_image">
													</div>
												</div>
												<div class="col-md-12 form-group">
													<label>Short Description <span class="red">*</span></label>
													<textarea type="text" class="form-control " id="update_category_desc" name="update_category_desc" placeholder="category description" cols="30" rows="10"></textarea>
													<span class="text-danger update_cate_desc_error"></span>
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
