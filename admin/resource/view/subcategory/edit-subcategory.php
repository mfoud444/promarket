<?php
include("resource/view/include/index.php");
if (isset($_POST['try_update'])) {

	$_SESSION['SMC_edit_subcategory_id'] = $_POST['id'];

	if (empty($_FILES['subcategory_banner']['name'])) {

		$tableName = $columnValue = $whereValue = null;
		$tableName = "subcategories";
		$columnValue["subcategory_name"] = $_POST['subcategory_name'];
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_status"] = $_POST['subcategory_status'];
		$whereValue["id"] = $_SESSION['SMC_edit_subcategory_id'];

		$updatesubcategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	} else {

		if ($control->checkImage(@$_FILES['subcategory_banner']['type'], @$_FILES['subcategory_banner']['size'], @$_FILES['subcategory_banner']['error']) == 1) {

			$filename = "SUBCATBANNER__" . date("YmdHis") . "_" . $_FILES['subcategory_banner']['name'];

			$tableName = $columnValue = $whereValue = null;
			$tableName = "subcategories";
			$columnValue["subcategory_name"] = $_POST['subcategory_name'];
			$columnValue["category_id"] = $_POST['category_id'];
			$columnValue["subcategory_status"] = $_POST['subcategory_status'];
			$columnValue["subcategory_banner"] = $filename;
			$whereValue["id"] = $_SESSION['SMC_edit_subcategory_id'];
			$updatesubcategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);

			if ($updatesubcategoryData > 0) {

				move_uploaded_file($_FILES['subcategory_banner']['tmp_name'], $GLOBALS['BANNER_DIRECTORY'] . $filename);


				unlink($_SESSION['SMC_edit_subcategory_banner_file_old']);
			
			}
		}
	}
}

if (isset($_POST['edit_subcategory_id'])) {
	$_SESSION['SMC_edit_subcategory_id'] = $_POST['edit_subcategory_id'];
}

$tableName = $columnName = $joinType = $onCondition = $whereValue = null;
$columnName["1"] = "subcategories.subcategory_name";
$columnName["2"] = "subcategories.subcategory_status";
$columnName["3"] = "subcategories.subcategory_banner";
$columnName["4"] = "subcategories.category_id";
$columnName["5"] = "subcategories.id";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$whereValue["subcategories.id"] = $_SESSION['SMC_edit_subcategory_id'];
$getsubcategoryData = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);

$_SESSION['SMC_edit_subcategory_banner_file_old'] = $GLOBALS['BANNER_DIRECTORY'] . $getsubcategoryData[0]['subcategory_banner'];

$tableName = $columnName = null;
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);

?>


<div class="wrapper">
	<div class="row">

		<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Edit-Sub-Category', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>

		<section class="panel">
			<header class="panel-heading">
				<?php $t('Edit-Sub-Category') ?>
			</header>
			<div class="panel-body">

				<?php

				if (isset($_POST['try_update'])) {
					if (@$updatesubcategoryData > 0) {
						showToast($t('SUBCATEGORY-UPDATED-SUCCESSFULLY', 1));
					
					}
				}
				?>

				<div class="form">
					<form class="form-horizontal" id="subCategory" method="post" action="" enctype="multipart/form-data">
						<div class="form-group ">
							<label for="SubCategoryName" class="control-label"> <?= $t('Sub-Category-Name') ?> </label>
							<div>
								<input class="form-control" id="subcategory_name" name="subcategory_name" type="text" value="<?php echo $getsubcategoryData[0]['subcategory_name']; ?>" />
							</div>
						</div>
						<div class="form-group ">
							<label for="MainCategoryName" class="control-label"> <?= $t('Main-Category-Name') ?> </label>
							<div>
								<select name="category_id" id="category_id" class="form-control">
									<option value=""><?= $t('Select-a-Category') ?></option>
									<?php
									foreach ($categoryList as $eachRow) {
										$selected = ($eachRow['id'] == $getsubcategoryData[0]['category_id']) ? 'selected' : '';
										echo '<option value="' . $eachRow['id'] . '" ' . $selected . '>' . $eachRow['category_name'] . '</option>';
									}
									?>
								</select>

							</div>
						</div>

						<div class="form-group ">
							<label for="status" class="control-label"> <?= $t('Sub-Category-Status') ?> </label>
							<div>
								<select name=" subcategory_status" class="form-control">
									<option <?php if ($getsubcategoryData[0]['subcategory_status'] == "Active") echo "selected"; ?>>
										<?= $t('Active') ?> </option>
									<option <?php if ($getsubcategoryData[0]['subcategory_status'] == "Inactive") echo "selected"; ?>>
										<?= $t('Inactive') ?> </option>
								</select>
							</div>
						</div>


						<div class="form-group">
							<label for="SubCatBanner" class="control-label"> <?= $t('Sub-Category-Banner') ?> </label>


							<div class="file-group">
								<input class="file-input" type="file" name="subcategory_banner" onchange="readURL(this);" value="<?= $getsubcategoryData[0]['subcategory_banner'] ?>" hidden>
								<i class="fas fa-cloud-upload-alt"></i>
								<p><?php $t('browse-file') ?></p>
								<div class="preview-image-div">
									<img class="preview-image" src="#" alt="Preview" style="display: none;">
									<p class="file-name"></p>
								</div>
							</div>


						</div>






						<input type="hidden" name="id" value="<?php echo $getsubcategoryData[0]['id']; ?>">
						<div class="form-group">
							<div>
								<button name="try_update" class="btn-success" type="submit"> <?php $t('Update') ?> </button>
								<a href="list-subcategory" class="btn-default" style="text-decoration: none;">
									<?php $t('SubCategory-List') ?> </a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>

</div>