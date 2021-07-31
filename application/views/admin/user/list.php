<div class="content-wrapper">
	<section class="content-header">
		<h1>
			News latter
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= base_url() . 'admin/home/index' ?>"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active">news latter</li>
		</ol>
	</section>

	<section class="content container-fluid">
		<div class="box box-success">
			<div class="box-header ui-sortable-handle">
				<div class="row">
					<div class="box-header">
						<h3 class="box-title text-capitalize">news latter user List</h3>
					</div>
					<div class="col-sm-12 table-responsive">
						<?php if (!empty($newsletter)) : ?>
							<table id="dataTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="40">No..</th>
										<th>User Email Address</th>
										<th>USer Active Diative Status</th>
										<th>User Submitted Date</th>
										<th width="100">Action</th>
									</tr>
								</thead>
								<tbody class="category_data_tbody">

									<?php
									$i = 1;
									foreach ($newsletter as $user) : ?>
										<tr>
											<td width="100"><?= $i++ ?></td>

											<td width="500">
												<?= $user['email']; ?>
											</td>
											<td>
												<?php
												$btn_class = '';
												if ($user['status'] == 0) {
													$btn_class = 'btn-warning';
												} else if ($user['status'] == 1) {
													$btn_class = 'btn-success';
												}
												?>
												<button href="Javascript:void(0)" title="Click to active" data-value="<?= $user['status']; ?>" data-id="<?= $user['id']; ?>" class="category_status btn <?= $btn_class; ?> w-50"><?= ($user['status'] == 0) ? 'Inactive' : 'Active' ?></button>
											</td>
											<td width="200"><?php echo $user['created_at']; ?></td>
											<td>
												<a href="Javascript:void(0)" class="btn btn-danger newsletter_user_delete_btn" data-id="<?= $user['id']; ?>"><span class="fa fa-trash"></span></a>
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





					</div>
				</div>
			</div>
		</div>
	</section>

</div>
