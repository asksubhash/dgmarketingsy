<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Post
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url() . 'admin/home/index' ?>"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active">post</li>
		</ol>
	</section>

	<section class="content container-fluid">
		<div class="box box-success">
			<div class="box-header ui-sortable-handle">
				<div class="row">
					<div class="box-header">
						<h3 class="box-title">post List</h3>
						<div class="btn-group pull-right">
							<a href="Javascript:void(0)" type="button" class="btn btn-default" id="add-new-post-btn">
								<i class="fad fa-plus"></i>
								Add New Post
							</a>
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<?php if (!empty($post)) : ?>
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
									foreach ($post as $post_data) : ?>
										<tr>
											<td><?= $i++ ?></td>
											<td>
												<?php if ($post_data['image'] !== '' && file_exists('./public/admin/uploads/post/' . $post_data['image'])) : ?>
													<img src="<?= base_url() . 'public/admin/uploads/post/' . $post_data['image']; ?>" width="50">
												<?php else : ?>
													<img src="<?= base_url() . 'public/admin/uploads/category/noimage.jpg ' ?>" width="50">
												<?php endif; ?>
											</td>
											<td>
												<?= $post_data['cat_name']; ?>
											</td>
											<td>
												<?= $post_data['tittle']; ?>
											</td>
											<td>
												<?php
												$btn_class = '';
												if ($post_data['status'] == 0) {
													$btn_class = 'btn-warning';
												} else if ($post_data['status'] == 1) {
													$btn_class = 'btn-success';
												}
												?>
												<button href="Javascript:void(0)" title="Click to active" data-value="<?= $post_data['status']; ?>" data-id="<?= $post_data['id']; ?>" class="post_status_change_btn btn <?= $btn_class; ?> w-50"><?= ($post_data['status'] == 0) ? 'Inactive' : 'Active' ?></button>
											</td>
											<td><?php echo $post_data['created_at']; ?></td>
											<td>
												<a href="Javascript:void(0)" class="btn btn-warning edit_post_btn" data-id="<?= $post_data['id']; ?>"><span class="fa fa-edit"></span></a>
												<a href="Javascript:void(0)" class="btn btn-danger post_delete_btn" data-id="<?= $post_data['id']; ?>"><span class="fa fa-trash"></span></a>

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
						<div class="modal fade" id="add-new-post-modal">
							<div class="modal-dialog  modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Add New Post</h4>
										<button type="button" class="close " data-dismiss="modal" aria-label="Close">
											<span class="fad fa-times"></span>
										</button>
									</div>

									<div class="modal-body">
										<form method="post" id="add_new_post" enctype="multipart/form-data">
											<div class="row">

												<div class="col-md-12" id="post_form_error">
												</div>

												<div class="col-md-6 form-group">
													<label>Post Tittle <span class="red">*</span></label>
													<input type="text" name="post_tittle" class="form-control" id="post_tittle" placeholder="Post Tittle">
													<span class="text-danger post_tittle_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Category <span class="red">*</span></label>
													<select name="cate_id" id="cate_id" class="form-control">
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
													<span class="text-danger post_category_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Post meta tittle <span class="red">*</span></label>
													<input type="text" name="post_meta" class="form-control" id="post_meta" placeholder="Post meta tittle">
													<span class="text-danger post_meta_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label> slug <span class="red">*</span></label>
													<input type="text" name="post_slug" class="form-control" id="post_slug" placeholder="Post slug ">
													<span class="text-danger post_slug_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label class=" text-capitalize "> Author Name <span class="red">*</span></label>
													<input type="text" name="post_author" class="form-control" id="post_author" placeholder="Post author ">
													<span class="text-danger post_author_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Post Image <span class="red">*</span></label>
													<input type="file" name="post_image" id="post_image" class="form-control">
													<p class="help_block post_image_error">Image should be in .jpg format and size should be less than 2MB;</p>
												</div>

												<div class="col-md-12 form-group">
													<label>Post content <span class="red">*</span></label>
													<textarea type="text" class="form-control summernote " id="post_desc" name="post_desc" placeholder="Post content " cols="30" rows="10"></textarea>
													<span class="text-danger post_desc_error"></span>
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
						<div class="modal fade" id="update-post-modal">
							<div class="modal-dialog  modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Update Category</h4>
										<button type="button" class="close " data-dismiss="modal" aria-label="Close">
											<span class="fad fa-times"></span>
										</button>
									</div>

									<div class="modal-body">
										<form method="post" id="update_post_form" enctype="multipart/form-data">
											<div class="row">
												<input type="hidden" id="post_id" />
												<div class="col-md-12" id="update_post_form_error">
												</div>

												<div class="col-md-6 form-group">
													<label>Post Tittle <span class="red">*</span></label>
													<input type="text" name="update_post_tittle" class="form-control" id="update_post_tittle" placeholder="Post Tittle">
													<span class="text-danger update_post_tittle_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Category <span class="red">*</span></label>
													<select name="update_cate_id" id="update_cate_id" class="form-control">
													</select>
													<span class="text-danger update_post_category_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Post meta tittle <span class="red">*</span></label>
													<input type="text" name="update_post_meta" class="form-control" id="update_post_meta" placeholder="Post meta tittle">
													<span class="text-danger update_post_meta_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label> slug <span class="red">*</span></label>
													<input type="text" name="update_post_slug" class="form-control" id="update_post_slug" placeholder="Post slug ">
													<span class="text-danger update_post_slug_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label class=" text-capitalize "> Author Name <span class="red">*</span></label>
													<input type="text" name="update_post_author" class="form-control" id="update_post_author" placeholder="Post author ">
													<span class="text-danger update_post_author_error"></span>
												</div>

												<div class="col-md-6 form-group">
													<label>Post Image</label>
													<input type="file" name="update_post_image" id="update_post_image" class="form-control">
													<p class="help_block update_post_img_error">Image should be in .jpg format and size should be less than 2MB;</p>
													<div class="img-profile">
														<img src="" id="post_adit_image">
													</div>
												</div>

												<div class="col-md-12 form-group">
													<label>Post content <span class="red">*</span></label>
													<textarea type="text" class="form-control  " id="update_post_desc" name="update_post_desc" placeholder="Post content " cols="30" rows="10"></textarea>
													<span class="text-danger update_post_desc_error"></span>
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
