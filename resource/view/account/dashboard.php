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

    <div class="container">
        <div class="row">
            <div >
             

                <?php
			


				if (isset($_POST['update_accinfo'])) {
					if (@$updatecustomerData > 0)
						showToast($t('account-information-updated', 1));
				}
				?>
              
			  <?php
echo "
    <div class='form'>
        <div class='flex-col continar-table'>
            <div class='title-table'>" . $t('Account Information', 1) . "</div>
            <table class='styled-table'>
                <tr>
                    <th>" . $t('Name', 1) . "</th>
                    <td>" . $cstmrDetails[0]['customer_name'] . "</td>
                </tr>
                <tr>
                    <th>" . $t('Email', 1) . "</th>
                    <td>" . $cstmrDetails[0]['customer_email'] . "</td>
                </tr>
                <tr>
                    <th>" . $t('Phone Number', 1) . "</th>
                    <td>" . $cstmrDetails[0]['customer_mobile'] . "</td>
                </tr>
                <tr>
                    <th>" . $t('Address', 1) . "</th>
                    <td>" . @$cstmrDetails[0]['customer_address'] . "</td>
                </tr>
            </table>
            <div class='flex' style='gap:1rem;'>
                <a href='edit-account' class='btn edit-btn'>
                    " . $t('Edit Account', 1) . "
                </a>
                <a href='?exit=yes' class='btn edit-btn' style='background-color: red'>
                    " . $t('Logout', 1) . "
                </a>
            </div>
        </div>
    </div>
";
?>
           
            </div>
        </div>
    </div>
</main>