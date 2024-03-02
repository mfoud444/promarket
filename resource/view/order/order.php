<?php
include_once('resource/view/include/index.php');
if(isset($_POST['submit_order']))
{
	
	$tableName = "orders";
	$columnValue["order_date"] = date("Y-m-d H:i:s");
	$columnValue["sub_total"] = $_POST['cartsub_total'];
	$columnValue["tax"] = $_POST['tax_total'];
	$columnValue["transaction_id"] = 'COD#' . @$_SESSION['SSCF_login_id'];
	$columnValue["delivery_charge"] = $_POST['delivery_charge'];
	$columnValue["discount_amount"] = $_POST['discount_amount'];
	$columnValue["grand_total"] = $_POST['grand_total'];
	$columnValue["customer_id"] = @$_SESSION['SSCF_login_id'];
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$saveorderDetails = $eloquent->insertData($tableName, $columnValue);
	
	$_SESSION['LAST_ORDER_ID'] = $saveorderDetails['LAST_INSERT_ID'];
	
	if($saveorderDetails['NO_OF_ROW_INSERTED'] > 0)
	{
		
		$_SESSION['SSCF_orders_order_id'] = $saveorderDetails['LAST_INSERT_ID'];
		

		$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = $paginate = null;
		$columnName["1"] = "products.id";
		$columnName["2"] = "products.product_price";
		$columnName["3"] = "shopcarts.quantity";
		$tableName["MAIN"] = "shopcarts";
		$joinType = "INNER";
		$tableName["1"] = "products";
		$onCondition["1"] = ["shopcarts.product_id", "products.id"];
		$whereValue["shopcarts.customer_id"] = @$_SESSION['SSCF_login_id'];
		$formatBy["DESC"] = "shopcarts.id";
		$shopCartItems = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);
		
		foreach($shopCartItems AS $eachOrderItems)
		{
		
			$columnValue = $tableName = null;
			$tableName = "order_items";
			$columnValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$columnValue["order_id"] = $_SESSION['SSCF_orders_order_id'];
			$columnValue["product_id"] = $eachOrderItems['id'];
			$columnValue["product_price"] = $eachOrderItems['product_price'];
			$columnValue["prod_quantity"] = $eachOrderItems['quantity'];
			$columnValue["created_at"] = date("Y-m-d H:i:s");
			$saveorderItems = $eloquent->insertData($tableName, $columnValue);
		}
		
	
		if(@$saveorderItems['NO_OF_ROW_INSERTED'] > 0)
		{
			$tableName = $whereValue = null;
			$tableName = "shopcarts";
			$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$deleteshopcartData = $eloquent->deleteData($tableName, $whereValue);			
			
			$tableName = $whereValue = null;
			$tableName = "deliveries";
			$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$deleteshopcartData = $eloquent->deleteData($tableName, $whereValue);
		}
	}
}



?>

<main class="main">


	<?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
			['url' => '#', 'label' => $t('Orders & Shipping', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			
				
				<?php

					if(isset($_POST['submit_order']))
					{
						if(@$saveorderDetails > 0)
						echo '
				
						<div class=" show flex" style="margin:10px; font-size:1.2rem;">
						'. $t('Dear Mr.') . $t('thanks for your order submission. Please fill up the below') 
						. $t('Shipping Details') . $t(', so that we delivered your product at your destination.').'</div>';
					}
					
			
					
				
				?>

			</div>

			<div class="checkout-steps">
						
						<header class="panel-heading">
			<?php $t('Shipping-Address') ?>
				
			</header>
			<div class="form">
			<form class="form-horizontal" action="payments" method="post">
    <div class="form-group required-field">
        <label><?= $t('First Name') ?></label>
        <input type="text" id="f1" name="shipadd_fname" class="form-control">
    </div>
    <div class="form-group required-field">
        <label><?= $t('Last Name') ?></label>
        <input type="text" id="f2" name "shipadd_lname" class="form-control">
    </div>

    <div class="form-group required-field">
        <label><?= $t('Street Address') ?></label>
        <input type="text" id="f3" name="shipadd_stadd" class="form-control">
    </div>
    <div class="form-group required-field">
        <label><?= $t('City') ?></label>
        <input type="text" id="f4" name="shipadd_cty" class="form-control">
    </div>

    <div class="form-group required-field">
        <label><?= $t('Phone Number') ?></label>
        <div class="form-control-tooltip">
            <input type="tel" id="f6" name="shipadd_phn" class="form-control">
            <span class="input-tooltip" data-toggle="tooltip" title="<?= $t('For delivery questions.') ?>" data-placement="right">
                <i class="icon-question-circle"></i>
            </span>
        </div>
    </div>
    <div id="error-message" class="error-message"></div>
    <button type="submit" name="proceed_to_payment" id="save-data" class="btn btn-sm btn-warning float-right">
        <?= $t('Submit and Proceed to Payment') ?>
    </button>
</form>

			</div>
					
					</div>
		</div>
	
	</div>
	
	

</main>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        var saveButton = document.getElementById("save-data");

        saveButton.addEventListener("click", function (e) {
            var fName = document.getElementById("f1").value;
            var lName = document.getElementById("f2").value;
            var stAdd = document.getElementById("f3").value;
            var phone = document.getElementById("f6").value;

            if (fName === '' || lName === '' || stAdd === ''  || phone === '') {
				
                e.preventDefault();
                var errorMessage = document.getElementById("error-message");
                errorMessage.innerHTML = '<b>*</b> All fields are required';
                errorMessage.style.display = "block";
            } else {
                return true;
            }
        });
    });
</script>
