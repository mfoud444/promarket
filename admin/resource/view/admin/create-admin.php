<?php
include("resource/view/include/index.php");
if (isset($_POST['create_admin'])) {

	$adminfileName = "ADMINIMAGE_" . date("YmdHis") . "_" . $_FILES['admin_image']['name'];


	if ($control->checkImage(@$_FILES['admin_image']['type'], @$_FILES['admin_image']['size'], @$_FILES['admin_image']['error']) == 1) {
		$saveResult = $adminCtrl->createAdminData($_POST['admin_name'], $_POST['admin_email'], $adminfileName, sha1($_POST['admin_password']), $_POST['admin_type'], $_POST['admin_status']);

		if (@$saveResult > 0) {
			
			move_uploaded_file($_FILES['admin_image']['tmp_name'], $GLOBALS['ADMINS_DIRECTORY'] . $adminfileName);
		}
	}
}

?>

<div class="wrapper">
	<div class="row">
		<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Create-Admin', 1)],

		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>
		<section class="panel">
			<header class="panel-heading">
				<?php $t('Create-Admin') ?>
			</header>
			<div class="panel-body">

				<?php

				if (isset($_POST['create_admin'])) {
					if (@$saveResult > 0) {
						showToast($t('ADMIN-INSERTED-SUCCESSFULLY', 1));
					}
				}
				?>

				<div class="form">
					<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label for="AdminName" class="control-label "> <?= $t('Admin-Name') ?> </label>
							<div class="">
								<input class=" form-control" name="admin_name" type="text" required />
							</div>
						</div>
						<div class="form-group">
							<label for="AdminEmail" class="control-label "> <?= $t('Admin-Email') ?> </label>
							<div class="">
								<input class="form-control " name="admin_email" type="email" autocomplete="none" required />
							</div>
						</div>
						<div class="form-group">
							<label for="AdminPassword" class="control-label "> <?= $t('Admin-Password') ?> </label>
							<div class="">
								<input class="form-control" name="admin_password" type="password" autocomplete="none" required />
							</div>
						</div>
						<div class="form-group">
							<label for="AdminType" class="control-label "> <?= $t('Admin-Type') ?> </label>
							<div class="">
								<select name="admin_type" class="form-control">
									<option value=""> <?= $t('Select-a-Type') ?> </option>
									<option value="Root Admin"> <?= $t('Root-Admin') ?> </option>
									<option value="Content Manager"> <?= $t('Content-Manager') ?> </option>
									<option value="Sales Manager"> <?= $t('Sales-Manager') ?> </option>
									<option value="Technical Operator"> <?= $t('Technical-Operator') ?> </option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="AdminStatus" class="control-label"> <?= $t('Admin-Status') ?> </label>
							<div class="">
								<select name="admin_status" class="form-control">
									<option value="Active"> <?= $t('Active') ?> </option>
									<option value="Inactive"> <?= $t('Inactive') ?> </option>
								</select>
							</div>
						</div>
						<div class="file-group">
							<input class="file-input" type="file" name="admin_image"  hidden>
							<i class="fas fa-cloud-upload-alt"></i>
							<p><?php $t('browse-file') ?></p>
							<div class="preview-image-div">
								<img class="preview-image" src="#" alt="Preview" style="display: none;">
								<p class="file-name"></p>
							</div>
						</div>
						<div class="form-group">
							<div>
								<button name="create_admin" class="btn-success" type="submit">
									<?php $t('Save') ?></button>
								<button class="btn-reset" type="reset"> <?php $t('Reset') ?></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
</div>