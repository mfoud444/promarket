<?php
include("resource/view/include/index.php");

if( isset($_POST['try_delete']) )
{
	
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "categories";
	$whereValue["id"] = $_POST['did'];
	$deleteCategory = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	$tableName = $whereValue = null;
	$tableName = "categories";
	$whereValue["id"] = $_POST['did'];
	$deleteCategory = $eloquent->deleteData($tableName, $whereValue);
	
}
if(isset($_POST['change_status']))
{
	$tableName = $columnValue = $whereValue = null;
	$tableName = "categories";
	$whereValue["id"] = $_POST['category_status_id'];
	
	if($_POST['current_status'] == "Active")
	{
		$columnValue["category_status"] = "Inactive";
	}
	else if($_POST['current_status'] == "Inactive")
	{
		$columnValue["category_status"] = "Active";
	}
	$updatecategoryStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
$tableName = $columnName = null;
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);
?>

<div class="wrapper">
	<div class="row">
	<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('List-Category', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>
	
			<section class="panel">
				<header class="panel-heading">
				<?php $t('List-Category')?>
				</header>
				<div class="panel-body">
					
					<?php 
					
						if(isset($_POST['did']))
						{
							if($deleteCategory > 0)
							{
								showToast($t('CATEGORY-DELETED-SUCCESSFULLY', 1));
					
							}

						}
						
						if(isset($_POST['change_status']))
						{
							if($updatecategoryStatus > 0)
							{
								showToast($t('CATEGORY-UPDATED-SUCCESSFULLY', 1));
					
							}

						}
					?>
					
					<div class="div-table">
					<table class="styled-table" id="dynamic-table">
							<thead>
								<tr>
									<th style="width:5%"><?php $t('ID') ?> </th>
									<th style="width:67%"><?php $t('Category-Name') ?></th>
									<th style="width:10%"><?php $t('Status') ?></th>
									<th style="width:18%"><?php $t('Action') ?></th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
									$n=1;
									foreach($categoryList AS $eachRow)
									{
										echo '
										<tr class="gradeA">
											<td>'. $n .'</td>
											<td>'. $eachRow['category_name'] .'</td>
											<td class="center">
												<form method="post" action="">
													<input type="hidden" name="category_status_id" value="'.$eachRow['id'].'" />
													<input type="hidden" name="current_status" value="'.$eachRow['category_status'].'" />
													<button name="change_status" class="btn-switch"  type="submit">
													<div class="switch">
													<input  type="checkbox"  id="switch" ' . ($eachRow["category_status"] == "Active" ? 'checked' : '') . '/>
													<label for="switch"></label>
													 </div>
												
													
													</button>
												</form>
											</td>
											<td >
												<div class="flex-button">
											
													<form action="" method="post" >
													<input type="hidden" name="did" value="'. $eachRow['id'] .'" />
													<button name="try_delete" class="btn-switch" type="submit" >
													<img src="../public/assets/images/delete.svg" class="hero-icon delete" alt="Delete">
													</button>
												</form>
													<form method="post" action="edit-category" >
														<input type="hidden" name="category_id" value="'.$eachRow['id'].'"/>
														<button name="try_edit" class="btn-switch" type="submit">
															<img src="../public/assets/images/edit.svg" class="hero-icon" alt="Edit">
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
</div>
