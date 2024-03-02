<?php
include("resource/view/include/index.php");
if( isset($_POST['create_category']) )
{$filename = "Category_" . date("YmdHis") . "_" . $_FILES['category_image']['name'];
	
	if( $control->checkImage(@$_FILES['category_image']['type'], @$_FILES['category_image']['size'], @$_FILES['category_image']['error']) == 1)
	{
	
		
		if(!empty($_POST['category_name']) && !empty($_POST['category_status']))
	{
		$tableName = $columnValue = null;
		$tableName = "categories";
		$columnValue["category_name"] = $_POST['category_name'];
		$columnValue["category_status"] = $_POST['category_status'];
		$columnValue["category_image"] = $filename;
		
		$createCategory = $eloquent->insertData($tableName, $columnValue);
	}
		if($createCategory> 0)
		{
			
			move_uploaded_file($_FILES['category_image']['tmp_name'], $GLOBALS['CATEGORY_DIRECTORY'] . $filename);
		}
	}


}
?>

<div class="wrapper">
	<div class="row">
	
	<?php	
$links = [
    ['url' => 'dashboard', 'label' => $t('Home',1)],
    ['url' => 'dashboard', 'label' => $t('Dashboard',1)],
    ['url' => '#', 'label' => $t('Create-Category',1)],
];
echo BreadcrumbGenerator::generateBreadcrumb($links);
			?>
	
			<section class="panel">
				<header class="panel-heading">
					<?php $t('CREATE-A-NEW-CATEGORY') ?>
				</header>
				<div class="panel-body">
					
					<?php 
					
						if(isset($_POST['create_category']))
						{
							if(@$createCategory > 0)
							{

								showToast($t('CATEGORY-INSERTED-SUCCESSFULLY', 1));
							
							}
					
						}
					?>
					
					<div class="form">
						<form class="form-horizontal" id="signupForm" method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="CategoryName" class="control-label"> <?php $t('Category-Name') ?>  </label>
								<div>
									<input class="form-control" name="category_name" type="text"/>
								</div>
							</div>
							<div class="form-group ">
								<label for="CategoryStatus" class="control-label"> <?php $t('Category-Status') ?>   </label>
								<div>
									<select class="form-control" name="category_status">
										<option value="Active"><?= $t('Active') ?> </option>
										<option value="Inactive"> <?= $t('Inactive') ?>  </option>
									</select>
								</div>
							</div>

							<div class="file-group">
                            <input class="file-input" type="file" name="category_image" onchange="readURL(this);"
                                hidden>
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p><?php $t('browse-file')?></p>
                            <div class="preview-image-div">
                                <img class="preview-image" src="#" alt="Preview" style="display: none;">
                                <p class="file-name"></p>
                            </div>
                        </div>

							<div class="form-group">
								<div class="">
									<button name="create_category" class="btn-success" type="submit"> <?php $t('Save') ?> </button>
									<button class="btn-reset" type="reset"> <?php $t('Reset') ?> </button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</section>
		</div>
</div>
