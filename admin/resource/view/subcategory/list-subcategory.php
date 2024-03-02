<?php
include("resource/view/include/index.php");
if (isset($_POST['try_delete'])) {
	
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "subcategories";
	$whereValue["id"] = $_POST['did'];
	$deleteSubCategory = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	$tableName = $whereValue = null;
	$tableName = "subcategories";
	$whereValue["id"] = $_POST['did'];
	$deleteSubCategory = $eloquent->deleteData($tableName, $whereValue);
	

	
	
}

if (isset($_POST['change_status'])) {
	$tableName = $columnValue = $whereValue = null;
	$tableName = "subcategories";
	$whereValue["id"] = $_POST['subcat_status_id'];

	if ($_POST['current_status']  == "Active") {
		$columnValue["subcategory_status"] = "Inactive";
	} else if ($_POST['current_status']  == "Inactive") {
		$columnValue["subcategory_status"] = "Active";
	}

	$changesubcategoryStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

$tableName = $columnName = $onCondition = $joinType = null;
$columnName["1"] = "subcategories.id";
$columnName["2"] = "subcategories.subcategory_name";
$columnName["3"] = "subcategories.subcategory_status";
$columnName["4"] = "subcategories.subcategory_banner";
$columnName["5"] = "categories.category_name";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$subcategoryList = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);

?>


<div class="wrapper">
	<div class="row">

		<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Sub-Category-List', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>


		
		<section class="panel">
			<header class="panel-heading">
				<?php $t('Sub-Category-List') ?>
			</header>
			<div class="panel-body">

				<?php

				if (isset($_POST['did'])) {
					if ($deleteSubCategory > 0) {
						showToast($t('SUBCATEGORY-DELETED-SUCCESSFULLY', 1));
					}
				}


				if (isset($_POST['change_status'])) {
					if ($changesubcategoryStatus > 0) {

						showToast($t('SUBCATEGORY-UPDATED-SUCCESSFULLY', 1));
					}
				}
				?>

				<div class="div-table">
					<table class="styled-table" id="dynamic-table">
						<thead>
							<tr>
								<th style="width:2%"><?php $t('ID') ?></th>
								<th style="width:20%"><?php $t('Category-Name') ?> </th>
								<th style="width:30%"><?php $t('SubCategory-Name') ?> </th>
								<th style="width:12%"><?php $t('Status') ?> </th>
								<th style="width:20%"><?php $t('SubCategory-Banner') ?> </th>
								<th style="width:16%"><?php $t('Action') ?> </th>
							</tr>
						</thead>
						<tbody>

							<?php

							$n = 1;
							foreach ($subcategoryList as $eachRow) {
								echo '
									<tr >
										<td>' . $n . '</td>
										<td>' . $eachRow["category_name"] . '</td>
										<td>' . $eachRow["subcategory_name"] . '</td>
										<td class="center">



	

											<form method="post" action="">
												<input type="hidden" name="subcat_status_id" value="' . $eachRow["id"] . '"/>
												<input type="hidden" name="current_status" value="' . $eachRow["subcategory_status"] . '"/>

												<button name="change_status" class="btn-switch"  type="submit">
												<div class="switch">
												<input  type="checkbox"  id="switch" ' . ($eachRow["subcategory_status"] == "Active" ? 'checked' : '') . '/>
												<label for="switch"></label>
											     </div>
												
												</button>

											</form>
										</td>
										<td >
											<a target="_blank" href="' . $GLOBALS['BANNER_DIRECTORY'] . $eachRow['subcategory_banner'] . '"> 
												<img src="' . $GLOBALS['BANNER_DIRECTORY'] . $eachRow['subcategory_banner'] . '" class="img-rounded" height="40px" width="180px" />
											</a>
											
										</td>
										<td >
											<div class="flex-button">
											
												<form action="" method="post" >
												<input type="hidden" name="did" value="' . $eachRow['id'] . '" />
												<button name="try_delete" class="btn-switch" type="submit" >
												<img src="../public/assets/images/delete.svg" class="hero-icon delete" alt="Delete">
												</button>
											</form>
												<form method="post" action="edit-subcategory">
													<input type="hidden" name="edit_subcategory_id" value="' . $eachRow["id"] . '"/>
													<button name="edit_subcategory" class="btn-switch" type="submit">
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
