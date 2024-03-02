<?php
include("resource/view/include/index.php");

if(isset($_POST['invoice_delete']))
{
	$tableName = "invoices";
	$whereValue["id"] = $_POST['remove_inovice'];
	$deleteInovice = $eloquent->deleteData($tableName, $whereValue);
}
$columnName = $tableName = $joinType = $onCondition = null;
$columnName["1"] = "invoices.id";
$columnName["2"] = "invoices.invoice_id";
$columnName["3"] = "invoices.created_at";
$columnName["4"] = "customers.customer_name";
$columnName["5"] = "orders.payment_method";
$columnName["6"] = "orders.grand_total";
$tableName["MAIN"] = "invoices";
$joinType = "INNER";
$tableName["1"] = "orders";
$tableName["2"] = "customers";
$onCondition["1"] = ["invoices.order_id", "orders.id"];
$onCondition["2"] = ["invoices.customer_id", "customers.id"];
$invoiceData = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);

?>


<div class="wrapper">
	<div class="row">
		
	<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Invoice', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>
		
			<section class="panel">
				<header class="panel-heading">
				<?php $t('ORDER-DETAILS') ?>
				</header>
				<div class="panel-body">
					
					<?php
						
						if( isset($_POST['invoice_delete']) )
						{
							if($deleteInovice > 0)
							{
								showToast($t('INVOICE-DATA-DELETED', 1));

							
							}
					
						}
					?>
					
					<div class="div-table">
					<table class="styled-table" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 7%"><?php $t('ID') ?> </th>
									<th style="width: 25%"><?php $t('Invoice-No') ?> </th>
									<th style="width: 15%"><?php $t('Customer-Name') ?> </th>
									<th style="width: 15%"><?php $t('Payment-Method') ?></th>
									<th style="width: 10%"><?php $t('Transaction') ?></th>
									<th style="width: 13%"><?php $t('Issued-Date') ?></th>
									<th style="width: 15%"><?php $t('Action') ?></th>
								</tr>
							</thead>
							<tbody>
								
							<?php 
								
								$n = 1;
								foreach ($invoiceData as $eachRow) 
								{
									echo '
										<tr class="gradeX">
											<td>'. $n .'</td>
											<td>'. $eachRow["invoice_id"] .'</td>
											<td>'. $eachRow["customer_name"] .'</td>
											<td>'. $eachRow["payment_method"] .'</td>
											<td>'. $GLOBALS['CURRENCY'] ." ". $eachRow["grand_total"] .'</td>
											<td>'. $eachRow["created_at"] .'</td>
											<td >
												<div class="flex-button">
												
													<form action="" method="post" style="display: inline">
														<input type="hidden" name="remove_inovice" value="'. $eachRow['id'] .'"/>
														<button name="invoice_delete"  class="btn-switch" type="submit">
														<img src="../public/assets/images/delete.svg" class="hero-icon delete" alt="Delete">
														</button>
													</form>
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
	