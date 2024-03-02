<?php
include_once('resource/view/include/index.php');

if (isset($_POST['update_accinfo'])) {
	$tableName = "customers";
	$columnValue["customer_name"] = $_POST['upcstmr_name'];
	$columnValue["customer_email"] = $_POST['upcstmr_email'];
	$columnValue["customer_mobile"] = $_POST['upcstmr_phn'];
	$columnValue["customer_address"] = $_POST['upcstmr_add'];
	$whereValue["id"] = $_SESSION['SSCF_login_id'];
	$updatecustomerData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
if (@$_SESSION['SSCF_login_id'] > 0) {

	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "customers";
	$whereValue["id"] = $_SESSION['SSCF_login_id'];
	$cstmrDetails = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
?>
<main class="main">





    <?php
	$links = [
		['url' => 'index', 'label' => $t('home', 1)],
		['url' => '#', 'label' => $t('My-Account', 1)],
	];
	echo BreadcrumbGenerator::generateBreadcrumb($links);
	?>






    <?php
			


				if (isset($_POST['update_accinfo'])) {
					if (@$updatecustomerData > 0)
						showToast($t('account-information-updated', 1));
                        header("Location: dashboard");
				}
				?>





    <?php
				
					if (@$_SESSION['SSCF_login_id'] > 0) {
					?>
     <header class="panel-heading">
     <?= $t('Edit My Account')?> 
           
            </header>
    <div class="form">
        <form class="form-horizontal" action="" method="post">


            <div class="form-group required-field">
                <input type="text" name="upcstmr_name" class="form-control" name=""
                    value="<?php echo $cstmrDetails[0]['customer_name']; ?>">
            </div>
            <div class="form-group required-field">
                <input type="email" name="upcstmr_email" class="form-control"
                    value="<?php echo $cstmrDetails[0]['customer_email']; ?>">
            </div>
            <div class="form-group required-field">
                <input type="text" name="upcstmr_phn" class="form-control"
                    value="<?php echo $cstmrDetails[0]['customer_mobile']; ?>">
            </div>
            <div class="form-group required-field">
                <input type="text" name="upcstmr_add" class="form-control"
                    value="<?php echo $cstmrDetails[0]['customer_address']; ?>">
            </div>
            <button type="submit" name="update_accinfo" class="btn btn-sm btn-outline-info">
                
                <?= $t('Update')?> 
            </button>


        </form>

    </div>
    <?php
					}
					?>





</main>