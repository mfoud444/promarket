<?php
include("resource/view/include/index.php");
if( isset($_POST['try_delete']) )
{
	
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "products";
	$whereValue["id"] = $_POST['did'];
	$deleteproductData = $eloquent->selectData($columnName, $tableName, @$whereValue);

	$tableName = "products";
	$whereValue["id"] = $_POST['did'];
	$deleteProduct = $eloquent->deleteData($tableName, $whereValue);
	
	if($deleteProduct > 0)
	{
		
		unlink($GLOBALS['PRODUCT_DIRECTORY'].$deleteproductData[0]['product_master_image']);
		unlink($GLOBALS['PRODUCTADD_DIRECTORY'].$deleteproductData[0]['products_image_one']);
		unlink($GLOBALS['PRODUCTADD_DIRECTORY'].$deleteproductData[0]['products_image_two']);
		unlink($GLOBALS['PRODUCTADD_DIRECTORY'].$deleteproductData[0]['products_image_three']);
	}
}

if(isset($_POST['change_status']))
{
	$tableName= $columnValue= $whereValue= null;
	$tableName = "products";
	$whereValue["id"] = $_POST['change_status_id'];
	
	if($_POST['current_status'] == "In Stock")
	{
		$columnValue["product_status"] = "Out of Stock";
	}
	else if($_POST['current_status'] == "Out of Stock")
	{
		$columnValue["product_status"] = "In Stock";
	}
	$updateStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

if(isset($_POST['change_feature']))
{
	$tableName= $columnValue= $whereValue= null;
	$tableName = "products";
	$whereValue["id"] = $_POST['change_feature_id'];
	
	if($_POST['current_feature'] == "NO")
	{
		$columnValue["product_featured"] = "YES";
	}
	else if($_POST['current_feature'] == "YES")
	{
		$columnValue["product_featured"] = "NO";
	}
	$featureStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

$columnName= $tableName = $joinType = $onCondition = null;
$columnName["1"] = "products.id";
$columnName["2"] = "products.product_name";
$columnName["3"] = "products.product_master_image";
$columnName["4"] = "products.product_quantity";
$columnName["5"] = "products.product_price";
$columnName["6"] = "products.product_status";
$columnName["7"] = "products.product_featured";
$columnName["8"] = "categories.category_name";
$columnName["9"] = "subcategories.subcategory_name";
$tableName["MAIN"] = "products";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$onCondition["1"] = ["products.category_id", "categories.id"];
$onCondition["2"] = ["products.subcategory_id", "subcategories.id"];
$productList = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);

?>

<div class="wrapper">
    <div class="row">

        <?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('Product-List', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>

        <section class="panel">
            <header class="panel-heading">
                PRODUCT LIST
            </header>
            <div class="panel-body">

                <?php 
						
						if (isset($_POST['did'])) 
						{
							if ($deleteProduct > 0)
							{
								showToast($t('PRODUCT-DELETED-SUCCESSFULLY', 1));
							
							}
					
						}
						
					
						if (isset($_POST['change_status'])) 
						{
							if ($updateStatus > 0)
							{
								showToast($t('PRODUCT-UPDATED-SUCCESSFULLY', 1));
							
							}
						
						}

						if (isset($_POST['change_feature'])) 
						{
							if ($featureStatus > 0)
							{
								showToast($t('PRODUCT-UPDATED-SUCCESSFULLY', 1));
							
							}
						
						}
					?>

<div class="div-table">
					<table class="styled-table" id="dynamic-table">
                        <thead>
                            <tr>
                                <th><?php $t('ID') ?></th>
                                <th><?php $t('Category') ?> </th>
                                <th><?php $t('SubCategory') ?> </th>
                                <th><?php $t('Product-Name') ?> </th>
                                <th><?php $t('Image') ?> </th>
                                <th><?php $t('Qty') ?> </th>
                                <th><?php $t('Price') ?> </th>
                                <th><?php $t('Status') ?> </th>
                                <th><?php $t('Featured') ?> </th>
                                <th><?php $t('Action') ?> </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
								
									$n = 1;
									foreach ($productList as $eachRow) 
									{
									
										if(empty($eachRow['product_master_image']))
										{
											$productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
										}
										else
										{
											$productImage = $GLOBALS['PRODUCT_DIRECTORY'].$eachRow['product_master_image'];
										}
										
										echo '
										<tr class="gradeA">
											<td>'. $n .'</td>
											<td>'. $eachRow['category_name'] .'</td>
											<td>'. $eachRow['subcategory_name'] .'</td>
											<td>'. $eachRow["product_name"] .'</td>
											<td class="center">
											
													<img src="'. $productImage .'" class="img-circle" height="48px" width="48px" style="border: 1px outset green;">
											
											</td>
											<td>'. $eachRow["product_quantity"] .'</td>
											<td>'. $eachRow["product_price"] .' '. $GLOBALS["CURRENCY"] .'</td>
											<td class="center" style="width:50px;">
												<form method="post" action="">
													<input type="hidden" name="change_status_id" value="'. $eachRow["id"] .'"/>
													<input type="hidden" name="current_status" value="'. $eachRow["product_status"] .'"/>
													<button name="change_status" class="stock"  type="submit" ' . ($eachRow["product_status"] == "Out of Stock" ? 'style="background-color: #fecaca;"' : '') . '>
													' . ($eachRow["product_status"]).'
												
													</button>
												</form>
											</td>										
											<td class="center" style="width: 40px;">
												<form method="post" action="">
													<input type="hidden" name="change_feature_id" value="'. $eachRow["id"] .'"/>
													<input type="hidden" name="current_feature" value="'. $eachRow["product_featured"] .'"/>
													
													<button name="change_feature" class="btn-switch" type="submit">
													
													<div class="switch">
													<input  type="checkbox"  id="switch" ' . ($eachRow["product_featured"] == "YES" ? 'checked' : '') . '/>
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

													<form method="post" action="edit-product" >
														<input type="hidden" name="id" value="'. $eachRow["id"] .'"/>
														<button name="edit_data" class="btn-switch" type="submit">
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

