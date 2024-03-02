<?php
include("resource/view/include/index.php");

if(isset($_REQUEST['id']))
{
	
	$_SESSION['SMCB_details_data'] = $_REQUEST['id'];
}

$columnName["1"] = "order_items.product_id ";
$columnName["2"] = "order_items.prod_quantity ";
$columnName["3"] = "products.product_name";
$columnName["4"] = "products.product_master_image";
$columnName["5"] = "products.product_price";
$tableName["MAIN"] = "order_items";
$joinType = "INNER";
$tableName["1"] = "products";
$onCondition["1"] = ["order_items.product_id", "products.id"];
$whereValue["order_items.order_id"] = @$_SESSION['SMCB_details_data'];
$orderdetailsResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);

?>

<div class="wrapper">
	<div class="row">

	<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Order-Details', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>

			<section class="panel">
				<header class="panel-heading">
				<?php $t('Order-Details') ?>
				</header>
				<div class="panel-body">
				<div class="div-table">
					<table class="styled-table" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 5%"> # </th>
									<th style="width: 10%"><?php $t('Item-ID') ?> </th>
									<th style="width: 40%"><?php $t('Item-Name') ?></th>
									<th style="width: 10%"><?php $t('Item-Image') ?></th>
									<th style="width: 10%"><?php $t('Item-Price') ?></th>
									<th style="width: 10%"><?php $t('Item-Qty') ?></th>
									<th style="width: 15%"><?php $t('Action') ?></th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
									
									$n = 1;
									foreach ($orderdetailsResult as $eachRow) 
									{
										echo '
										<tr class="gradeA">
											<td>'. $n .'</td>
											<td>'. $eachRow["product_id"] .'</td>
											<td>'. $eachRow["product_name"] .'</td>
											<td class="center">
												<a target="_blank" href="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachRow["product_master_image"] .'"> 
													<img src="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachRow["product_master_image"] .'" class="img-circle" style="border: 1px outset green; height: 48px; width: 45px;"/>
												</a>
											</td>
											<td>'. $eachRow["product_price"].' '. $GLOBALS["CURRENCY"] .'</td>
											<td>'. $eachRow["prod_quantity"] .'</td>
											<td class="center">
											<div class="flex-button">
												<a href="?aid='. $eachRow["product_id"] .'"  >
												<img src="../public/assets/images/delete.svg" class="hero-icon delete" alt="Delete">
												</a>												
												<a href="list-order" class="" >
												<i class="bx bx-arrow-back"></i>
												</a>
												</div>
											</td>
											
										</tr>
										';
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
				