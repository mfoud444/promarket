<?php
include("resource/view/include/index.php");
if(isset($_POST['try_update']))
{

	if(empty($_FILES['admin_image']['name']))
	{
		$adminUpdate = $adminCtrl->updateAdminData($_POST['admin_id'], $_POST['admin_name'], $_POST['admin_email'], $_POST['admin_type'], $_POST['admin_status']);
	}
	
	else
	{
		$adminfileName = "ADMINIMAGE_" . date("YmdHis") . "_" . $_FILES['admin_image']['name'];
		
		if($control->checkImage(@$_FILES['admin_image']['type'], @$_FILES['admin_image']['size'], @$_FILES['admin_image']['error']) == 1)
		{
			$adminUpdate = $adminCtrl->editAdminData($_POST['admin_id'], $_POST['admin_name'], $_POST['admin_email'], $adminfileName, $_POST['admin_type'], $_POST['admin_status']);		
			
			if($adminUpdate > 0)
			{
			
				move_uploaded_file($_FILES['admin_image']['tmp_name'], $GLOBALS['ADMINS_DIRECTORY'] . $adminfileName);
				
		
				unlink($_SESSION['SMC_old_admin_image_file']);
			}
		}
	}
}

if( isset($_POST['try_edit']) )
{
	
	$_SESSION['SMC_edit_admin_id'] = $_POST['id'];
	
	$adminData = $adminCtrl->getAdminData($_SESSION['SMC_edit_admin_id']);
}
else
{
	$adminData = $adminCtrl->getAdminData($_SESSION['SMC_edit_admin_id']);
}

$_SESSION['SMC_old_admin_image_file'] = $GLOBALS['ADMINS_DIRECTORY'] . $adminData[0]['admin_image'];
?>

<div class="wrapper">
    <div class="row">
        <?php	
$links = [
    ['url' => 'dashboard', 'label' => $t('home',1)],
    ['url' => 'dashboard', 'label' => $t('dashboard',1)],
    ['url' => '', 'label'=> $t('Edit-Admin',1)],
];
echo BreadcrumbGenerator::generateBreadcrumb($links);
			?>


        <section class="panel">
            <header class="panel-heading">
                <?php $t('Edit-Admin')?>
            </header>
            <div class="panel-body">

                <?php 
					
						if(isset($_POST['try_update']))
						{
							if(@$adminUpdate > 0)
							{
								showToast($t('ADMIN-UPDATED-SUCCESSFULLY', 1));
								// header("Location: list-admin");
								// exit;
							}
						}
					?>

                <div class="form">
                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="AdminName" class="control-label"> <?= $t('Admin-Name') ?> </label>
                            <div>
                                <input class=" form-control" name="admin_name" type="text"
                                    value="<?php echo $adminData[0]['admin_name']; ?>" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="email" class="control-label"> <?= $t('Admin-Email') ?> </label>
                            <div>
                                <input class="form-control " name="admin_email" type="email"
                                    value="<?php echo $adminData[0]['admin_email']; ?>" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="AdminType" class="control-label"> <?= $t('Admin-Type') ?> </label>
                            <div>
                                <select class="form-control" name="admin_type">
                                    <option <?php if($adminData[0]['admin_type'] == "Root Admin") echo "selected"; ?>>
                                        <?= $t('Root-Admin') ?> </option>
                                    <option
                                        <?php if($adminData[0]['admin_type'] == "Content Manager") echo "selected"; ?>>
                                        <?= $t('Content-Manager') ?> </option>
                                    <option
                                        <?php if($adminData[0]['admin_type'] == "Sales Manager") echo "selected"; ?>>
                                        <?= $t('Sales-Manager') ?> </option>
                                    <option
                                        <?php if($adminData[0]['admin_type'] == "Technical Operator") echo "selected"; ?>>
                                        <?= $t('Technical-Operator') ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="AdminStatus" class="control-label"> <?= $t('Admin-Status') ?> </label>
                            <div>
                                <select class="form-control m-bot15" name="admin_status">
                                    <option <?php if($adminData[0]['admin_status'] == "Active") echo "selected"; ?>>
                                        <?= $t('Active') ?> </option>
                                    <option <?php if($adminData[0]['admin_status'] == "Inactive") echo "selected"; ?>>
                                        <?= $t('Inactive') ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="AdminImage" class="control-label"> <?= $t('Admin-Status') ?> </label>

                            <div class="file-group">
                                <input class="file-input" type="file" name="admin_image" onchange="readURL(this);"
                                    hidden />
                                <p><?php $t('browse-file')?></p>
                                <div class="preview-image-div">
                                    <img class="preview-image" src="#" alt="Preview" style="display: none;">
                                    <p class="file-name"></p>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="admin_id" value="<?php echo $adminData[0]['id']; ?>" />
                        <div class="form-group">
                            <div>
                                <button name="try_update" class="btn-success" type="submit"> <?php $t('Update')?>
                                </button>
                                <a href="list-admin" class="btn-default"> <?php $t('Cancle')?></a>
                            </div>
                        </div>
                </div>
                </form>
            </div>
    </div>
    </section>
</div>
</div>
</div>