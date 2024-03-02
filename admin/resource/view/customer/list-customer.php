<?php
include("resource/view/include/index.php");
if(isset($_POST['did']))
{

	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "customers";
	$whereValue["id"] = $_POST['did'];
	$getcustomerData = $eloquent->selectData($columnName, $tableName, @$whereValue);

	$tableName = $whereValue = null;
	$tableName = "customers";
	$whereValue["id"] = $_POST['did'];
	$deletecustomerData = $eloquent->deleteData($tableName, $whereValue);
}	

if(isset($_POST['change_status']))
{
	$tableName = $whereValue = $columnValue = null;
	$tableName = "customers";
	$whereValue["id"] = $_POST['customer_status_id'];
	
	if($_POST['current_status'] == "Active")
	{
		$columnValue["customer_status"] = "Inactive";
	}
	else if($_POST['current_status'] == "Inactive")
	{
		$columnValue["customer_status"] = "Active";
	}
	
	$updatecustomerStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

$columnName = $tableName = null;
$columnName = "*";
$tableName = "customers";
$customerList = $eloquent->selectData($columnName, $tableName);

?>

<div class="wrapper">
	<div class="row">
	

		<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Customer-List', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>
		



			<section class="panel">
				<header class="panel-heading">
				<?php $t('Customer-List') ?>
				</header>
				<div class="panel-body">
					
					<?php
					
						if(isset($_POST['did']))
						{
							if($deletecustomerData > 0)
							{
								showToast($t('CUSTOMER-DELETED-SUCCESSFULLY', 1));
						
							}
					
						}
						
						
						if(isset($_POST['change_status']))
						{
							if($updatecustomerStatus > 0)
							{
								showToast($t('CUSTOMER-UPDATED-SUCCESSFULLY', 1));
						
							}
					
						}
					?>	
					
					<div class="div-table">
					<table class="styled-table" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 7%"><?php $t('ID') ?></th>
									<th style="width: 15%"><?php $t('Full-Name') ?></th>
									<th style="width: 15%"><?php $t('Email') ?></th>
									<th style="width: 10%"><?php $t('Mobile') ?></th>
									<th style="width: 22%"><?php $t('Address') ?></th>
									<th style="width: 8%"><?php $t('Status') ?></th>
									<th style="width: 15%"><?php $t('SignUp-date') ?></th>
									<th style="width: 8%"><?php $t('Action') ?></th>
								</tr>
							</thead>
							<tbody>
								
							<?php 
							
								$n = 1;
								foreach ($customerList as $eachRow) 
								{
									echo '
									<tr class="gradeX">
										<td>'. $n .'</td>
										<td>'. $eachRow["customer_name"] .'</td>
										<td>'. $eachRow["customer_email"] .'</td>
										<td>'. $eachRow["customer_mobile"] .'</td>
										<td>'. $eachRow["customer_address"] .'</td>
										<td>
											<form method="post" action="">
												<input type="hidden" name="customer_status_id" value="'. $eachRow["id"] .'"/>
												<input type="hidden" name="current_status" value="'. $eachRow["customer_status"] .'"/>
												<button name="change_status" class="btn-switch"  type="submit">
												<div class="switch">
												<input  type="checkbox"  id="switch" ' . ($eachRow["customer_status"] == "Active" ? 'checked' : '') . '/>
												<label for="switch"></label>
											     </div>

												</button>
											</form>
										</td>
										<td>'. $eachRow["created_at"] .'</td>
										<td class="center">
										<form action="" method="post" >
										<input type="hidden" name="did" value="'. $eachRow['id'] .'" />
										<button name="try_delete" class="btn-switch" type="submit" >
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
