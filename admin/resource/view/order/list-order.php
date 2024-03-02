<?php
include("resource/view/include/index.php");
if(isset($_POST['changeItemStatus']))
{
	$_SESSION['SMC_change_status_id'] = $_POST['id'];
	
	$tableName = $columnValue = $whereValue = null;
	$tableName = "orders";
	$columnValue["order_item_status"] = $_POST['orderItemStatus'];
	$columnValue["updated_at"] = date('Y-m-d H:i:s');
	$whereValue["id"] = $_SESSION['SMC_change_status_id'];
	$orderItemStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
$columnName = $tableName = $joinType = $onCondition = null;
$columnName["1"] = "shippings.order_id";
$columnName["2"] = "shippings.shipcstmr_name";
$columnName["3"] = "shippings.shipcstmr_mobile";
$columnName["5"] = "shippings.shipcstmr_streetadd";
$columnName["6"] = "shippings.shipcstmr_city";
$columnName["9"] = "orders.id";
$columnName["10"] = "orders.transaction_status";
$columnName["11"] = "orders.order_item_status";
$columnName["12"] = "customers.customer_email";
$tableName["MAIN"] = "shippings";
$joinType = "INNER";
$tableName["1"] = "orders";
$tableName["2"] = "customers";
$onCondition["1"] = ["shippings.order_id", "orders.id"];
$onCondition["2"] = ["customers.id", "shippings.customer_id"];
$ordersList = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);
?>

<div class="wrapper">
	<div class="row">

	<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Order-List', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
	
		?>
	
			<section class="panel">
				<header class="panel-heading">
				<?php $t('Order-List') ?>
				</header>
				<div class="panel-body">
					
					<?php 
						#== INSERT CONFIRMATION MESSAGE
						if(isset($_POST['changeItemStatus']))
						{	
							if(@$orderItemStatus > 0)
							{
								echo '<div class="alert alert-success fade in">
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											THE ORDER ITEM STATUS IS <strong>UPDATED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in">
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											SOMETHING WENT WRONG TO CHANGE STATUS! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}		
					?>
	
	<div class="div-table">
					<table class="styled-table" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 3%"><?php $t('ID') ?></th>
									<th style="width: 13%"><?php $t('Cstm-Name') ?></th>
									<th style="width: 12%"><?php $t('Cstm-Email') ?></th>
									<th style="width: 10%"><?php $t('Cstm-Mobile') ?></th>
									<th style="width: 25%"><?php $t('Cstm-Address') ?></th>
									<th style="width: 14%"><?php $t('Order-Status') ?></th>
									<th style="width: 5%"><?php $t('Payment') ?></th>
									<th style="width: 5%"><?php $t('Action') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									#== ORDER DATA TABLE
									$n = 1;
									foreach ($ordersList as $eachOrder) 
									{
										$addSummary = $eachOrder['shipcstmr_streetadd'] . ", " . $eachOrder['shipcstmr_city'] . "-" . $eachOrder['shipcstmr_zip'] . ", " . $eachOrder['shipcstmr_country']; 
								?>
								
								<tr class="gradeA">
									<td> <?= $n ?> </td>
									<td> <?= $eachOrder["shipcstmr_name"] ?> </td>
									<td> <?= $eachOrder["customer_email"] ?> </td> 
									<td> <?= $eachOrder["shipcstmr_mobile"] ?> </td>
									<td> <?= $addSummary ?> </td>
									<td class="center">
										<form action="" method="post">
											<select name="orderItemStatus" >
												<option <?php if($eachOrder["order_item_status"] == 'Pending') echo 'selected'; ?>> Pending </option>
												<option <?php if($eachOrder["order_item_status"] == 'Processing') echo 'selected'; ?>> Processing </option>
												<option <?php if($eachOrder["order_item_status"] == 'Completed') echo 'selected'; ?>> Completed </option>
												<option <?php if($eachOrder["order_item_status"] == 'Cancelled') echo 'selected'; ?>> Cancelled </option>
											</select>
											<input type="hidden" name="id" value="<?= $eachOrder['id'] ?>">
											<input type="hidden" value="<?= $eachOrder['order_item_status'] ?>">
											<button class="btn btn-secondary btn-xs" style="width: 26px; margin-top:-4px; margin-left: 4px;" name="changeItemStatus" type="submit">
												<i class="fa fa-edit fa-lg text-success"></i>
											</button>
										</form>
									</td>
									<td class="center">
										<div>
											<?php 
											echo '<form action="" method="post">
												<input type="hidden" name="id" value="'. $eachOrder['id'] .'"/>
												<input type="hidden" name="current_status" value="'. $eachOrder['transaction_status'] .'" />
												<button name="change_status" class="stock"  type="submit" ' . ($eachOrder["transaction_status"] == "Unpaid" ? 'style="background-color: #fecaca;"' : '') . '>
													' . ($eachOrder["transaction_status"]).'
												
													</button>
											
											</form>';?>
										</div>
									</td>
									<td class="center">
										<a href="detail-order?id=<?= $eachOrder["order_id"] ?>" class="btn btn-warning btn-xs"  style="width: 60px;" type="submit">
											<i class="fa fa-chevron-circle-left"></i> Details
										</a>
									</td>
								</tr>
								
								<?php
										$n++;
									}
								?>
								
							</tbody>
			
						</table>
					</div>
				</div>
			</section>
		</div>

</div>
