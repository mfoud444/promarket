<?php
include_once('resource/view/include/index.php');

if(isset($_POST['cash_on_delivery']))
{
	if($_POST['payment_values'] = 1)
	{
		#== INSERT INVOICE TABLE DATA
		$tableName = $columnValue = null;
		$tableName = "invoices";
		$columnValue["invoice_id"] = 'COD#' . rand(10000, 99999);
		$columnValue["customer_id"] = @$_SESSION['SSCF_login_id'];
		$columnValue["shipping_id"] = @$_SESSION['SSCF_ship_cstmr_id'];
		$columnValue["order_id"] = @$_SESSION['SSCF_orders_order_id'];
		$columnValue["transaction_amount"] = 0 ;#$_SESSION['SSCF_orders_grand_total'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$invoiceCOD = $eloquent->insertData($tableName, $columnValue);
		
		if($invoiceCOD['LAST_INSERT_ID'] > 0)
		{
			
			$columnName = $tableName = $whereValue =  null;
			$columnName = "*";
			$tableName = "invoices";
			$whereValue['id'] = $invoiceCOD['LAST_INSERT_ID'];
			$invoiceresultCOD = $eloquent->selectData($columnName, $tableName, $whereValue);
			
		
			$tableName = $columnValue = $whereValue =  null;
			$tableName = "orders";
			$columnValue["payment_method"] = "Cash On Delivery";
			$columnValue["transaction_id"] = 'COD#' . @$_SESSION['SSCF_login_id'];
			$columnValue["transaction_status"] = "Unpaid";
			$whereValue["id"] = $_SESSION['SSCF_orders_order_id'];
			$ordersUpdate = $eloquent->updateData($tableName, $columnValue, @$whereValue);
		}
		header("Location: index");
	}
}


if(isset($_POST['proceed_to_payment']))
{
	if(@$_SESSION['SSCF_login_id'] > 0)
	{
		$tableName = $columnValue = null;
		$tableName = "shippings";
		$columnValue["shipcstmr_name"] = $_POST['shipadd_fname'] . " " . $_POST['shipadd_lname'];
		$columnValue["customer_id"] = $_SESSION['SSCF_login_id'];
		$columnValue["order_id"] = $_SESSION['SSCF_orders_order_id'];
		$columnValue["shipcstmr_mobile"] = $_POST['shipadd_phn'];
		$columnValue["shipcstmr_streetadd"] = $_POST['shipadd_stadd'];
		$columnValue["shipcstmr_city"] = $_POST['shipadd_cty'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$shipaddResult = $eloquent->insertData($tableName, $columnValue);
		
		$_SESSION['SSC_last_shipadd_id'] = $shipaddResult['LAST_INSERT_ID'];
		$_SESSION['SSC_last_insert_id_no'] = $shipaddResult['NO_OF_ROW_INSERTED'];
	}
}

$tableName = $columnName = $whereValue =  null;
$columnName = "*";
$tableName = "shippings";
$whereValue["id"] = $_SESSION['SSC_last_shipadd_id'];
$shipcstmResult = $eloquent->selectData($columnName, $tableName, $whereValue);


$_SESSION['SSCF_ship_cstmr_id'] = $shipcstmResult[0]['id'];
$_SESSION['SSCF_ship_cstmr_order_id'] = $shipcstmResult[0]['order_id'];
$_SESSION['SSCF_ship_cstmr_name'] = $shipcstmResult[0]['shipcstmr_name'];
$_SESSION['SSCF_ship_cstmr_addr'] = $shipcstmResult[0]['shipcstmr_streetadd'];
$_SESSION['SSCF_ship_cstmr_city'] = $shipcstmResult[0]['shipcstmr_city'];

?>

<main class="main">


	<?php
	$links = [
		['url' => 'index', 'label' => $t('home', 1)],
		['url' => '#', 'label' => $t('Payment Integration', 1)],
	];
	echo BreadcrumbGenerator::generateBreadcrumb($links);
	?>
	<div class="container">
		<div class="form">


			<form class="form-horizontal" style="gap:10px;" action="" method="post">
				<h2> Choose the method of payment </h2>

				<div class="input-group">
					<select class="form-control" name="shipping_method">
						<option> Select Cash Method </option>
						<option value="50" selected> Cash on Delivery </option>
						<option value="50" > Transfer </option>


					</select>
				</div>


				<div class="input-group-append">
					<button name="cash_on_delivery" class="btn btn-sm btn-info" style="width: 100%;" type="submit">Confirm Cash On Delivery</button>
				</div>

			</form>
		</div>


	</div>

</main>