<?php
include("resource/view/include/index.php");
$columnName = $tableName  = null;
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);
if (isset($_POST['create_product'])) {
    // Initialize database table name and column values
    $tableName = "products";
    $columnValue = array();
    showToast($t( $_POST['subcategory_id'], 1));
    // Other form field values
    $columnValue["category_id"] = $_POST['category_id'];
    if (isset($_POST['subcategory_id']) && !empty($_POST['subcategory_id'])) {
        $columnValue["subcategory_id"] = $_POST['subcategory_id'];
    } 
    $columnValue["product_name"] = $_POST['product_name'];
    $columnValue["product_summary"] = $_POST['product_summary'];
    $columnValue["product_details"] = $_POST['product_details'];
    $columnValue["product_quantity"] = $_POST['product_quantity'];
    $columnValue["product_price"] = $_POST['product_price'];
    $columnValue["product_status"] = $_POST['product_status'];
    $columnValue["product_featured"] = $_POST['product_featured'];
    $columnValue["product_tags"] = $_POST['product_tag'];
    $columnValue["created_at"] = date("Y-m-d H:i:s");

    // Initialize file names
    $filemasname = $fileaddonename = $fileaddtwoname = $fileaddthreename = "";

    // Check if the first uploaded image has a result of 1
    if (isset($_FILES['product_images']['tmp_name'][0])) {
        $file = $_FILES['product_images'];

        // Generate unique file name for the first uploaded file
        $filemasname = "PRODUCT_" . date("YmdHis") . "_" . $file['name'][0];

        // Check image file validation for the first file
        $imageResult = $control->checkImage($file['type'][0], $file['size'][0], $file['error'][0]);

        if ($imageResult != 1) {
            // Handle the case where the first image is not valid (e.g., show an error message)
            echo "The first uploaded image is not valid.";
            exit;
        }
    }

    // Iterate through the remaining uploaded files (up to 3 files)
    if (isset($_FILES['product_images']) && count($_FILES['product_images']['tmp_name']) > 1) {
        for ($i = 1; $i < min(count($_FILES['product_images']['tmp_name']), 4); $i++) {
            $file = $_FILES['product_images'];

            // Generate unique file name for each uploaded file
            $file_name = "PRODUCT_" . date("YmdHis") . "_" . $file['name'][$i];

            // Check image file validation for each file
            $imageResult = $control->checkImage($file['type'][$i], $file['size'][$i], $file['error'][$i]);

            if ($imageResult == 1) {
                // Assign uploaded file names to respective variables based on the index
                switch ($i) {
                    case 1:
                        $fileaddonename = $file_name;
                        break;
                    case 2:
                        $fileaddtwoname = $file_name;
                        break;
                    case 3:
                        $fileaddthreename = $file_name;
                        break;
                }
            }
        }
    }

    // Set the column values for image files
    $columnValue["product_master_image"] = $filemasname;
    $columnValue["products_image_one"] = $fileaddonename;
    $columnValue["products_image_two"] = $fileaddtwoname;
    $columnValue["products_image_three"] = $fileaddthreename;

    // Insert data into the database
    $createProduct = $eloquent->insertData($tableName, $columnValue);

    if ($createProduct > 0) {
        for ($i = 0; $i < min(count($_FILES['product_images']['tmp_name']), 4); $i++) {
            // Determine the appropriate file name based on the index $i
            switch ($i) {
                case 0:
                    $file_name = $filemasname;
                    break;
                case 1:
                    $file_name = $fileaddonename;
                    break;
                case 2:
                    $file_name = $fileaddtwoname;
                    break;
                case 3:
                    $file_name = $fileaddthreename;
                    break;
            }

            // Move the uploaded file using the determined file name
            move_uploaded_file($_FILES['product_images']['tmp_name'][$i], $GLOBALS['PRODUCT_DIRECTORY'] . $file_name);
        }

        showToast($t('PRODUCT-INSERTED-SUCCESSFULLY', 1));
    
    } else {
        echo "Product creation failed.";
    }
}



?>


<div class="wrapper">
	<div class="row">
	

	<?php	
$links = [
    ['url' => 'dashboard', 'label' => $t('home',1)],
    ['url' => 'dashboard', 'label' => $t('dashboard',1)],
    ['url' => '', 'label'=> $t('Create-Product',1)],
];
echo BreadcrumbGenerator::generateBreadcrumb($links);
			?>
		



			<section class="panel">
				<header class="panel-heading">
					CREATE PRODUCTS
				</header>
				<div class="panel-body">
					
					<?php 
					
						// if(isset($_POST['create_product'])) 
						// {
						// 	if(@$createProduct > 0)
						// 	{
						// 		showToast($t('PRODUCT-INSERTED-SUCCESSFULLY', 1));
							
						// 	}
							
						// }
					?>
						<div class="form">
					<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="form-group ">
							<label for="ProductStatus" class="control-label">Category</label>
							<div class="">
								
								<select name="category_id" id="category_id" class="form-control" required>
									<option value=""><?= $t('Select-a-Category') ?> </option> 
									
									<?php
									
										foreach($categoryList AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['category_name'] .'</option>';
										}
									?>
									
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label"> Subcategory </label>
							<div class="">
								<select name="subcategory_id" id="subcategory_id" class="form-control">
									<option value="">Select a Subcategory</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="ProductName" class="control-label"> Product Name </label>
							<div class="">
								<input type="text" name="product_name" class="form-control" id="product_name" required>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductSummary" class="control-label"> Product Summary </label>
							<div>
								<div class="form-group">
									<div>
										<textarea name="product_summary" class="form-control" id="summerOne" rows="9" required></textarea>
									</div>
								</div>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductDetails" class="control-label"> Product Details </label>
							<div>
								<div class="form-group">
									<div>
										<textarea name="product_details" class="form-control" id="summerTwo" rows="9" required></textarea>
									</div>
								</div>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductQuantity" class="control-label">Product Quantity</label>
							<div class="">
								<input type="number" name="product_quantity" class="form-control" id="product_quantity" required>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductPrice" class="control-label"> Product Price </label>
							<div class="">
								<input type="number" step="any" name="product_price" class="form-control" id="product_price" required>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label"> Product Status </label>
							<div class="">
								<select name="product_status" class="form-control" required>
									<option>Out of Stock</option>
									<option>In Stock</option>
								</select>
							</div>
						</div>						
						<div class="form-group"  >
							<label for="ProductStatus" class="control-label"> Product Feature </label>
							<div class="">
								<select name="product_featured" class="form-control" required>
									<option>NO</option>
									<option>YES</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="ProductName" class="control-label"> Product Tags </label>
							<div>
								<input type="tags" name="product_tag" id="tag-input1" required>
							</div>
						</div>



						<div class="file-group">
                            <input class="file-input" type="file"  name="product_images[]" multiple hidden
                                hidden>
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p><?php $t('browse-file')?></p>
                            <div class="preview-image-div">
                             
                            </div>
                        </div>

	


					
						
					
						<div class="form-group">
							<div>
								<button name="create_product" class="btn-success" type="submit"> <?php $t('Save')?> </button>
								<button class="btn-reset" type="reset"> <?php $t('Reset')?> </button>
							</div>
						</div>
					</form>
						</div>
				</div>
			</section>
		</div>

</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        var categorySelect = document.getElementById("category_id");
        var subcategorySelect = document.getElementById("subcategory_id");

        categorySelect.addEventListener("change", function () {
            var cat_id = categorySelect.value;

            if (cat_id !== "") {
                var formData = new FormData();
                formData.append("ajax_create_product", "YES");
                formData.append("category_id", cat_id);

                fetch("ajax", {
                    method: "POST",
                    body: formData
                })
                .then(function (response) {
                    return response.text();
                })
                .then(function (response) {
                    var resp = response.trim();
                    subcategorySelect.innerHTML = resp;

                    if (resp === "") {
                        subcategorySelect.innerHTML = "<option value=''> No Subcategory Found </option>";
                    }
                })
                .catch(function (error) {
                    console.error("Error:", error);
                });
            } else {
                subcategorySelect.innerHTML = "<option value=''> Select a Subcategory </option>";
            }
        });
    });
</script>
