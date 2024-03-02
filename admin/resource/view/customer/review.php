<?php
include("resource/view/include/index.php");
if(isset($_POST['customer_review']))
{
	$tableName = $whereValue = null;
	$tableName = "contacts";
	$whereValue["id"] = $_POST['review_id'];
	$deleteReviewData = $eloquent->deleteData($tableName, $whereValue);
}	
$columnName = $tableName = null;
$columnName = "*";
$tableName = "contacts";
$reviewData = $eloquent->selectData($columnName, $tableName);
?>

<div class="wrapper">
	<div class="row">

	<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Review', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>

			<section class="panel">
				<header class="panel-heading">
				<?php $t('List-of-Reviews')?>
				</header>
				<div class="panel-body">
					
					<?php

						if(isset($_POST['did']))
						{
							if($deleteReviewData > 0)
							{showToast($t('CUSTOMER-DATA-DELETED', 1));
						
							}
						}
						
					?>	
					
					<div class="div-table">
					<table class="styled-table" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 5%"><?php $t('ID') ?> </th>
									<th style="width: 15%"><?php $t('User-Name') ?> </th>
									<th style="width: 15%"><?php $t('User-Email') ?> </th>
									<th style="width: 10%"><?php $t('User-Mobile') ?> </th>
									<th style="width: 37%"><?php $t('User-Comments') ?> </th>
									<th style="width: 10%"><?php $t('Date') ?> </th>
									<th style="width: 8%"><?php $t('Action') ?> </th>
								</tr>
							</thead>
							<tbody>
								
							<?php
							
								$n = 1;
								foreach ($reviewData as $eachRow) 
								{
									echo '
									<tr class="gradeX">
										<td>'. $n .'</td>
										<td>'. $eachRow["contacts_name"] .'</td>
										<td>'. $eachRow["contacts_email"] .'</td>
										<td>'. $eachRow["contacts_phone"] .'</td>
										<td style="width: 400px;">'. $eachRow["contacts_overview"] .'</td>
										<td>'. $eachRow["created_at"] .'</td>
										<td class="center">
											<form action="" method="post">
												<input type="hidden" name="review_id" value="'. $eachRow["id"] .'"> 
												<button type="submit" name="customer_review" style="outline:none; border:none" >
												<img src="../public/assets/images/delete.svg" class="hero-icon delete" alt="Delete">
												</button>
											</form>
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
</div>
																			