<footer class="main-footer">
	<strong>Copyright &copy; 2021 <a href="#">Jungle Sparsh</a>.</strong> All rights reserved.
</footer>
<input type="hidden" id="base_url" value="<?= base_url() ?>">
</div>

<script src="<?= base_url() ?>public/admin/js/jquery.min.js"></script>
<script src="<?= base_url() ?>public/admin/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>public/admin/js/adminLte.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/dataTable/dataTable.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bootstrap-filestyle.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/summer/summer.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/sweetAlert.js"></script>
<script src="<?= base_url() ?>public/admin/js/custom.js"></script>
<script src="<?= base_url() ?>public/admin/js/post.js"></script>
<script src="<?= base_url() ?>public/admin/js/slider.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		$('#dataTable').DataTable({
			"autoWidth": true,
			"lengthMenu": [
				[5, 10, 15, -1],
				[5, 10, 15, "All"]
			]
		});

		$(":file").filestyle({
			htmlIcon: '<span class="fa fa-folder" style="margin-right:10px;"></span>',
		});

		$('.summernote').summernote();
		$(document).on({
			ajaxStart: function() {
				$('#a-loader-box').fadeIn();
			},
			ajaxStop: function() {
				$('#a-loader-box').fadeOut();
			}
		});

	});
</script>

</body>

</html>
