<?php
include("resource/view/include/index.php");
if(isset($_POST['update_data']))
{
	#== IF UPDATE DATA WITHOUT IMAGES
	if(	
	empty($_FILES['product_master_image']['name']) &&
	empty($_FILES['products_image_one']['name']) &&
	empty($_FILES['products_image_two']['name']) &&
	empty($_FILES['products_image_three']['name'])
	)
	{
		$tableName = $columnValue = $whereValue = null;
		$tableName = "products";
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_id"] = $_POST['subcategory_id'];
		$columnValue["product_name"] = $_POST['product_name'];
		$columnValue["product_summary"] = $_POST['product_summary'];
		$columnValue["product_details"] = $_POST['product_details'];
		$columnValue["product_quantity"] = $_POST['product_quantity'];
		$columnValue["product_price"] = $_POST['product_price'];
		$columnValue["product_status"] = $_POST['product_status'];
		$columnValue["product_featured"] = $_POST['product_featured'];
		$columnValue["product_tags"] = $_POST['product_tag'];
		$whereValue["id"] = $_SESSION['SMC_product_product_id'];
		$updateproductData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	#== IF UPDATE DATA WITH IMAGES
	else
	{
		#== NEW IMAGE FILE NAME GENERATE
		$filemasname = "PRODUCT_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		$fileaddonename = "PRODUCTONE_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		$fileaddtwoname = "PRODUCTTWO_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		$fileaddthreename = "PRODUCTTHREE_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		
		#== IMAGE FILES VALIDATION
		$prodmstrResult = $control->checkImage($_FILES['product_master_image']['type'], $_FILES['product_master_image']['size'], $_FILES['product_master_image']['error']);
		$prodaddoneResult = $control->checkImage($_FILES['products_image_one']['type'], $_FILES['products_image_one']['size'], $_FILES['products_image_one']['error']);
		$prodaddtwoResult = $control->checkImage($_FILES['products_image_two']['type'], $_FILES['products_image_two']['size'], $_FILES['products_image_two']['error']);
		$prodaddthreeResult = $control->checkImage($_FILES['products_image_three']['type'], $_FILES['products_image_three']['size'], $_FILES['products_image_three']['error']);
		
		if($prodmstrResult == 1 && $prodaddoneResult == 1 && $prodaddtwoResult == 1 && $prodaddthreeResult == 1)
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "products";
			$columnValue["category_id"] = $_POST['category_id'];
			$columnValue["subcategory_id"] = $_POST['subcategory_id'];
			$columnValue["product_name"] = $_POST['product_name'];
			$columnValue["product_summary"] = $_POST['product_summary'];
			$columnValue["product_details"] = $_POST['product_details'];
			$columnValue["product_master_image"] = $filemasname;
			$columnValue["products_image_one"] = $fileaddonename;
			$columnValue["products_image_two"] = $fileaddtwoname;
			$columnValue["products_image_three"] = $fileaddthreename;
			$columnValue["product_quantity"] = $_POST['product_quantity'];
			$columnValue["product_price"] = $_POST['product_price'];
			$columnValue["product_status"] = $_POST['product_status'];
			$columnValue["product_featured"] = $_POST['product_featured'];
			$columnValue["product_tags"] = $_POST['product_tag'];
			$whereValue["id"] = $_SESSION['SMC_product_product_id'];
			$updateproductData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if($updateproductData > 0)
			{
				#== ADD IMAGES TO THE DIRECTORY
				move_uploaded_file($_FILES['product_master_image']['tmp_name'], $GLOBALS['PRODUCT_DIRECTORY'] . $filemasname);
				move_uploaded_file($_FILES['products_image_one']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddonename);
				move_uploaded_file($_FILES['products_image_two']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddtwoname);
				move_uploaded_file($_FILES['products_image_three']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddthreename);
				
				#== REMOVE IMAGES FROM THE DIRECTORY
				unlink($_SESSION['SMC_edit_data_image_mas_file_old']);
				unlink($_SESSION['SMC_edit_data_image_one_file_old']);
				unlink($_SESSION['SMC_edit_data_image_two_file_old']);
				unlink($_SESSION['SMC_edit_data_image_three_file_old']);
			}
		}
	}
}

if(isset($_POST['edit_data']))
{
	# HOLD PRODUCT ID IN A SESSION
	$_SESSION['SMC_product_product_id'] = $_POST['id'];
}

$tableName = $columnName = $whereValue = $joinType = $onCondition = null;
$columnName["1"] = "products.product_name";
$columnName["2"] = "products.product_master_image";
$columnName["3"] = "products.products_image_one";
$columnName["4"] = "products.products_image_two";
$columnName["5"] = "products.products_image_three";
$columnName["6"] = "products.product_quantity";
$columnName["7"] = "products.product_price";
$columnName["8"] = "products.product_status";
$columnName["9"] = "products.product_details";
$columnName["10"] = "products.product_summary";
$columnName["11"] = "products.product_tags";
$columnName["12"] = "products.category_id";
$columnName["13"] = "products.subcategory_id";
$columnName["14"] = "categories.id";
$columnName["15"] = "categories.category_name";
$columnName["16"] = "subcategories.id";
$columnName["17"] = "subcategories.subcategory_name";
$columnName["18"] = "products.product_featured";
$tableName["MAIN"] = "products";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$onCondition["1"] = ["products.category_id", "categories.id"];
$onCondition["2"] = ["products.subcategory_id", "subcategories.id"];
$whereValue['products.id'] = $_SESSION['SMC_product_product_id'];
$getproductData = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);


$_SESSION['SMC_edit_data_image_mas_file_old'] = $GLOBALS['PRODUCT_DIRECTORY'] . $getproductData[0]['product_master_image'];
$_SESSION['SMC_edit_data_image_one_file_old'] = $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_one'];
$_SESSION['SMC_edit_data_image_two_file_old'] = $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_two'];
$_SESSION['SMC_edit_data_image_three_file_old'] = $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_three'];

$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);

?>

	<div class="row">

	<?php	
$links = [
    ['url' => 'dashboard', 'label' => $t('home',1)],
    ['url' => 'dashboard', 'label' => $t('dashboard',1)],
    ['url' => '', 'label'=> $t('Edit-Product',1)],
];
echo BreadcrumbGenerator::generateBreadcrumb($links);
			?>
	


			<section class="panel">
				<header class="panel-heading">
				<?php $t('Edit-Product') ?>
				</header>
				<div class="panel-body">
					
					<?php 
						# UPDATE MESSAGE
						if (isset($_POST['update_data'])) 
						{
							if (@$updateproductData > 0)
							{
								showToast($t('PRODUCT-UPDATED-SUCCESSFULLY', 1));
							
							}
						
						}
					?>
					<div class="form">
					<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
						
						<div class="form-group ">
							<label for="ProductStatus" class="control-label">Category</label>
							<div>
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select a Category</option>
									
									<?php 
										# CATEGORY LIST
										foreach($categoryList AS $eachRow)
										{
											echo '<option value="'.$eachRow['id'].'" ';
											
											if($eachRow['id'] == $getproductData[0]['category_id'])
											echo 'selected';
											
											echo ' >'.$eachRow['category_name'].'</option>';
										}
									?>
									
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label">Subcategory</label>
							<div>
								<select id="subcategory_id" name="subcategory_id" class="form-control">
									<option value=''> Select A Subcategory </option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="ProductName" class="control-label">Product Name</label>
							<div>
								<input type="text" name="product_name" class="form-control" value="<?php echo $getproductData[0]['product_name']?>">
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductSummary" class="control-label">Product Summary</label>
							<div>
								<textarea name="product_summary" id="summerOne" >
									<?php echo $getproductData[0]['product_summary']?>
								</textarea>
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductDetails" class="control-label">Product Details</label>
							<div>
								<textarea name="product_details" id="summerTwo">
									<?php echo $getproductData[0]['product_details']?>
								</textarea>
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductQuantity" class="control-label">Product Quantity</label>
							<div>
								<input type="number" name="product_quantity" class="form-control" value="<?php echo $getproductData[0]['product_quantity']?>">
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductPrice" class="control-label">Product Price</label>
							<div>
								<input type="number" step="any" name="product_price" class="form-control" value="<?php echo $getproductData[0]['product_price']?>">
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label">Product Status</label>
							<div>
								<select name="product_status" class="form-control">
									<option <?php if($getproductData[0]['product_status'] == "Out of Stock") echo "selected";?>>Out of Stock</option>
									<option <?php if($getproductData[0]['product_status'] == "In Stock") echo "selected";?>>In Stock</option>
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label">Product Feature</label>
							<div>
								<select name="product_featured" class="form-control" required>
									<option <?php if($getproductData[0]['product_featured'] == "NO") echo "selected";?>>NO</option>
									<option <?php if($getproductData[0]['product_featured'] == "YES") echo "selected";?>>YES</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="ProductName" class="control-label">Product Tags</label>
							<div class="col-md-7">
								<input type="tags" name="product_tag" id="tag-input1" value="<?php echo $getproductData[0]['product_tags'];?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Product Master Image</label>
							<div class="controls col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-default btn-file">
										<input type="file" name="product_master_image" class="default" onchange="readURL(this);" set-to="div1" />
									</span>
									<span class="fileupload-preview" style="margin-left:5px;"></span>
									<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Product Master Preview</label>
							<div class="col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
										<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCT_DIRECTORY'] . $getproductData[0]['product_master_image'] ;?>" alt="" id="div1"/>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex d-inline">	<!-- product additional images start -->
							<div class="form-group">
								<label class="control-label">Product Additional Image</label>
								<div class="controls">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_one" class="default" onchange="readURL(this);" set-to="div2" />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
								<div class="controls">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_two" class="default" onchange="readURL(this);" set-to="div3" />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
								<div class="controls">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_three" class="default" onchange="readURL(this);" set-to="div4" />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Product Additional Preview</label>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_one'] ;?>" alt="" id="div2"/>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_two'] ;?>" alt="" id="div3"/>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_three'] ;?>" alt="" id="div4"/>
										</div>
									</div>
								</div>
							</div>
						</div>		<!-- product additional images end -->



					
						<input type="hidden" name="product_id" value="<?php echo $getproductData[0]['id']?>"/>
						<div class="form-group">
							<div>
						
								<button name="update_data" class="btn-success" type="submit">Update</button>
								<a href="list-product" class="btn-reset" style="text-decoration: none;">Product List</a>
							</div>
						</div>
					</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= EDIT PRODUCT SECTION END =*=-->


<!--=*= TAGS INPUT START =*=-->
<script type="text/javascript">
	var tagInput = new TagsInput({
		selector: 'tag-input1'
	});
</script>
<!--=*= TAGS INPUT END =*=-->





<!--=*= AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY =*=-->
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    var cat_id = <?php echo $getproductData[0]['category_id']; ?>;
    
    if (cat_id !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText.trim();
                document.getElementById("subcategory_id").innerHTML = response;

                if (response === "") {
                    document.getElementById("subcategory_id").innerHTML = "<option value=''> No Subcategory Found </option>";
                }
            }
        };
        xhr.send("ajax_edit_product=YES&category_id=" + cat_id + "&subcategory_id=<?php echo $getproductData[0]['subcategory_id']; ?>");
    } else {
        document.getElementById("subcategory_id").innerHTML = "<option value=''> Select a Subcategory </option>";
    }

    var categorySelect = document.getElementById("category_id");
    categorySelect.addEventListener("change", function () {
        var cat_id = this.value;

        if (cat_id !== "") {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText.trim();
                    document.getElementById("subcategory_id").innerHTML = response;

                    if (response === "") {
                        document.getElementById("subcategory_id").innerHTML = "<option value=''>No Subcategory Found</option>";
                    }
                }
            };
            xhr.send("ajax_create_product=YES&category_id=" + cat_id);
        } else {
            document.getElementById("subcategory_id").innerHTML = "<option value=''>Select a Subcategory</option>";
        }
    });
});

</script>			
<!--=*= AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY =*=-->