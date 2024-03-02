<?php
include("resource/view/include/index.php");

if (isset($_POST['try_update'])) {

	

	if (empty($_FILES['category_image']['name'])) {

		$tableName = $columnValue = $whereValue = null;
		$tableName = "categories";
		$columnValue["category_name"] = $_POST['category_name'];
		
		$columnValue["category_status"] = $_POST['category_status'];
		$whereValue["id"] = $_SESSION['SMC_edit_category_id'];

		$updatecategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	} else {

		if ($control->checkImage(@$_FILES['category_image']['type'], @$_FILES['category_image']['size'], @$_FILES['category_image']['error']) == 1) {

			$filename = "Category_" . date("YmdHis") . "_" . $_FILES['category_image']['name'];

			$tableName = $columnValue = $whereValue = null;
			$tableName = "categories";
			$columnValue["category_name"] = $_POST['category_name'];
			
			$columnValue["category_status"] = $_POST['category_status'];
			$columnValue["category_image"] = $filename;
			$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
			$updatecategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);

			if ($updatecategoryData > 0) {

				move_uploaded_file($_FILES['category_image']['tmp_name'], $GLOBALS['CATEGORY_DIRECTORY'] . $filename);


				unlink($_SESSION['SMC_edit_category_image_file_old']);
			}
		}
	}
}

if (isset($_POST['category_id'])) {
	$_SESSION['SMC_edit_category_id'] = $_POST['category_id'];
}

// if(isset($_POST['try_update']))
// {
// 	$tableName = $columnValue = $whereValue = null;
// 	$tableName = "categories";
// 	$columnValue["category_name"] = $_POST['category_name'];
// 	$columnValue["category_status"] = $_POST['category_status'];
// 	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	
// 	$updatecategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
// }








if( isset($_POST['try_edit']) )
{

	$_SESSION['SMC_edit_category_id'] = $_POST['category_id'];
	
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "categories";
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	$getcategoryData = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
else
{
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "categories";
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	$getcategoryData = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
?>
<div class="wrapper">
	<div class="row">

	<?php	
$links = [
    ['url' => 'dashboard', 'label' => $t('Home',1)],
    ['url' => 'dashboard', 'label' => $t('Dashboard',1)],
    ['url' => '', 'label' => $t('Edit-Category',1)],
];
echo BreadcrumbGenerator::generateBreadcrumb($links);
			?>
	
			<section class="panel">
				<header class="panel-heading">
				<?php $t('EDIT-CATEGORY') ?>
					
				</header>
				<div class="panel-body">
					
					<?php 
					
						if(isset($_POST['try_update']))
						{
							if($updatecategoryData > 0)
							{
								showToast($t('CATEGORY-UPDATED-SUCCESSFULLY', 1));
					
							}
						}
					?>
					
					<div class="form">
						<form class="form-horizontal" id="signupForm" method="post" action="" enctype="multipart/form-data">
							<div class="form-group ">
								<label for="CategoryName" class="control-label"><?php $t('Category-Name') ?>  </label>
								<div>
									<input class=" form-control" name="category_name" type="text" value="<?php echo $getcategoryData[0]['category_name']?>" />
								</div>
							</div>
							<div class="form-group ">
								<label for="CategoryStatus" class="control-label"> <?php $t('Category-Status') ?> </label>
								<div>
									<select class="form-control m-bot15" name="category_status">
										<option <?php if($getcategoryData[0]['category_status'] == "Active") echo "selected";?>><?= $t('Active') ?></option>
										<option <?php if($getcategoryData[0]['category_status'] == "Inactive") echo "selected";?>><?= $t('Inactive') ?> </option>
									</select>
								</div>
							</div>

							<div class="form-group">
		<label for="CategoryImage" class="control-label"> <?= $t('Sub-Category-Banner') ?> </label>


		<div class="file-group">
			<input class="file-input" type="file" name="category_image" onchange="readURL(this);" value="<?= $getcategoryData[0]['category_image'] ?>" hidden>
			<i class="fas fa-cloud-upload-alt"></i>
			<p><?php $t('browse-file') ?></p>
			<div class="preview-image-div">
				<img class="preview-image" src="#" alt="Preview" style="display: none;">
				<p class="file-name"></p>
			</div>
		</div>


	</div>

							<div class="form-group">
								<div>
									<button name="try_update" class="btn-success" type="submit">  <?php $t('Update')?> </button>
									<a href="list-category" class="btn-default" >  <?php $t('Cancle')?> </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>

</div>
	