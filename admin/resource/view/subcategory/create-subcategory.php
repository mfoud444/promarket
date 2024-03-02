<?php
include("resource/view/include/index.php");
$tableName = $columnName = null;
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);

if (isset($_POST['create_subcategory'])) 
{
	
	if( $control->checkImage(@$_FILES['subcategory_banner']['type'], @$_FILES['subcategory_banner']['size'], @$_FILES['subcategory_banner']['error']) == 1)
	{
		
		$filename = "SUBCATBANNER_" . date("YmdHis") . "_" . $_FILES['subcategory_banner']['name'];
		
		$tableName = $columnValue = null;
		$tableName = "subcategories";
		$columnValue["subcategory_name"] = $_POST['subcategory_name'];
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_status"] = $_POST['subcategory_status'];
		$columnValue["subcategory_banner"] = $filename;
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$createSubcategory = $eloquent->insertData($tableName, $columnValue);
		
		if($createSubcategory > 0)
		{
			
			move_uploaded_file($_FILES['subcategory_banner']['tmp_name'], $GLOBALS['BANNER_DIRECTORY'] . $filename);
		}
	}
}

?>

<div class="wrapper">
    <div class="row">

        <?php	
$links = [
    ['url' => 'dashboard', 'label' => $t('home',1)],
    ['url' => 'dashboard', 'label' => $t('dashboard',1)],
    ['url' => '', 'label'=> $t('Create-Sub-Category',1)],
];
echo BreadcrumbGenerator::generateBreadcrumb($links);
			?>

        <section class="panel">
            <header class="panel-heading">
                <?php $t('Create-Sub-Category')?>
            </header>
            <div class="panel-body">

                <?php 
						
						if (isset($_POST['create_subcategory'])) 
						{
							if (@$createSubcategory > 0)
							{

								showToast($t('SUBCATEGORY-INSERTED-SUCCESSFULLY', 1));
							
							}

						}
					?>

                <div class="form">
                    <form class="form-horizontal" id="subCategory" method="post" action=""
                        enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="SubCategoryName" class="control-label"> <?= $t('Sub-Category-Name') ?> </label>
                            <div>
                                <input class="form-control" id="subcategory_name" name="subcategory_name" type="text" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="CategoryName" class="control-label"> <?= $t('Main-Category-Name') ?> </label>
                            <div>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option> <?= $t('Select-a-Category') ?>  </option>

                                    <?php
										
											foreach($categoryList as $eachRow)
											{
												echo '<option value="'. $eachRow['id'] .'">'. $eachRow['category_name'] .'</option>' ;
											}
										?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="SubCategoryStatus" class="control-label"> <?= $t('Sub-Category-Status') ?> </label>
                            <div>
                                <select name="subcategory_status" class="form-control">
                                    <option><?= $t('Active') ?>  </option>
                                    <option> <?= $t('Inactive') ?> </option>
                                </select>
                            </div>
                        </div>



                        <div class="file-group">
                            <input class="file-input" type="file" name="subcategory_banner" onchange="readURL(this);"
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
                                <button name="create_subcategory" class="btn-success" type="submit"> <?php $t('Save') ?>
                                </button>
                                <button class="btn-reset" type="reset"><?php $t('Reset') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>


