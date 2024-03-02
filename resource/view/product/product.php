<?php
include_once('resource/view/include/index.php');
if (isset($_REQUEST['id'])) {
	$_SESSION['SSCF_product_product_id'] = $_REQUEST['id'];
}



$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "products";
$whereValue["id"] = $_SESSION['SSCF_product_product_id'];
$productResult = $eloquent->selectData($columnName, $tableName, @$whereValue);

if(empty($productResult[0]['subcategory_id'])){
   

    $columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;
    $columnName[1] = "product_master_image";
    $tableName = "products";
    $whereValue["category_id"] = $productResult[0]['category_id'];
    $paginate["POINT"] = 0;
    $paginate["LIMIT"] = 4;
    $relatedResult = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);
    
    $columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;
    $columnName = "*";
    $tableName = "products";
    $whereValue["category_id"] = $productResult[0]['category_id'];
    $paginate["POINT"] = 0;
    $paginate["LIMIT"] = 7;
    $relevantResult = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);
    
    $columnName = $tableName = $whereValue = null;
    $columnName = "*";
    $tableName = "categories";
    $whereValue["categories.id"] = $productResult[0]['category_id'];
    $breadcrumbName = $eloquent->selectData($columnName, $tableName, @$whereValue);
    
    $links = [
		['url' => 'index', 'label' => $t('home', 1)],
		['url' => 'category?catagoryid='. $productResult[0]['category_id'], 'label' => $t(@$breadcrumbName[0]['category_name'], 1)],
	
	];


}else{
  
    $columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;
    $columnName[1] = "product_master_image";
    $tableName = "products";
    $whereValue["subcategory_id"] = $productResult[0]['subcategory_id'];
    $paginate["POINT"] = 0;
    $paginate["LIMIT"] = 4;
    $relatedResult = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);
    
    $columnName = $tableName = $whereValue = $inColumn = $inValue = $formatBy = $paginate = null;
    $columnName = "*";
    $tableName = "products";
    $whereValue["subcategory_id"] = $productResult[0]['subcategory_id'];
    $paginate["POINT"] = 0;
    $paginate["LIMIT"] = 7;
    $relevantResult = $eloquent->selectData($columnName, $tableName, @$whereValue, @$inColumn, @$inValue, @$formatBy, @$paginate);
    
    $columnName = $tableName = $whereValue = null;
    $columnName["1"] = "categories.id";
    $columnName["2"] = "categories.category_name";
    $columnName["3"] = "subcategories.id";
    $columnName["4"] = "subcategories.subcategory_name";
    $tableName["MAIN"] = "products";
    $joinType = "INNER";
    $tableName["1"] = "categories";
    $tableName["2"] = "subcategories";
    $onCondition["1"] = ["categories.id", "products.category_id"];
    $onCondition["2"] = ["subcategories.id", "products.subcategory_id"];
    $whereValue["products.id"] = $_SESSION['SSCF_product_product_id'];
    $breadcrumbName = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy);
    
	$links = [
		['url' => 'index', 'label' => $t('home', 1)],
		['url' => 'sub-catagory?id='.@$productResult[0]['category_id'], 'label' => $t(@$breadcrumbName[0]['category_name'], 1)],
		['url' => 'category?subcategoryid='. @$productResult[0]['subcategory_id'], 'label' => $t(@$breadcrumbName[0]['subcategory_name'], 1)],
	];

}


?>


<main class="main">

    <?php

	echo BreadcrumbGenerator::generateBreadcrumb($links);

  
	?>


    <div class="container">
        <div class="row">
            <div>
                <div class="product-single-container">
                

                 

						<div class="product-single-details">
                                <h1 class="product-title">

                                    <?php

									echo $productResult[0]['product_name'];
									?>

                                </h1>
                               
                                <div class="price-box1">
                                    <span class="product-price">

                                        <?php
										#== PRODUCT PRICE
										echo $GLOBALS['CURRENCY'] . " " . $productResult[0]['product_price'];
										?>

                                    </span>
                                </div>
                  
                           
                                <div class="product-action product-all-icons">
                                    <div class="flex" style=" flex-direction: row-reverse; gap:1rem; align-items: center;">

                                        <div class="product-single-qty">
                                            <h2> <?php $t('Quantity') ?></h2>
                                            <input class="horizontal-quantity form-control quantity-number" style=" border-radius: 0.5rem;" type="number" min="1" value="1">
                                        </div>


                                        <form method="post" action="">
                                            <input type="hidden" name="cart_product_id"
                                                value="<?php echo $_SESSION['SSCF_product_product_id']; ?>" />
                                            <input type="hidden" name="cart_product_quantity" value="1" />

											<button type="submit" name="add_to_cart" class="btn-icon flex add-card"  title="Add to Cart">
                                             <?php $t('Add to Cart') ?>
													<i class="bx bx-cart-add box-icon" ></i>
													</button>

                                       
                                        
                                        </form>
                                    </div>
                                </div>
                            </div>






							<div class="product-single-gallery">

<section class="wrapper">
<i class='bx bx-chevron-left box-icon button' id="prev"></i>
	<div class="image-container">
		<div class="carousel">
			<?php
          $image_key = ['product_master_image', 'products_image_one', 'products_image_two', 'products_image_three'];

          foreach ($productResult as $eachImage) {
              foreach ($eachImage as $key => $value) {
                  if ($value !== "" && $value !== null && in_array($key, $image_key)) {
              
                      echo '<img class="img-slide" src="' . $GLOBALS['PRODUCT_DIRECTORY'] . $value . '" alt="' . $key . '">';
                  }
              }
          }
          
			?>
		</div>
		<i class=" bx bx-chevron-right box-icon   button" id="next"></i>
	</div>
</section>
</div>
                     
                 
                </div>





                <div class="container-tabs">
                    <div class="tabs">
                        <h3 class="active"><?php $t('Description') ?></h3>
                      
                        <h3> <?php $t('Reviews') ?></h3>
                    </div>
                    <div class="tab-content">

                        <div class="div-content active">
                            <?php
						
							$prodDescription = htmlspecialchars_decode($productResult[0]['product_details']);
echo '<div class="description-pro">'.$prodDescription.'</div>';
							?>


                        </div>

            


                        <div class="div-content">
                            <div class="form">
                            <div class="add-product-review2 form-horizontal">
                                <h3 class=""> <?php $t('WRITE YOUR OWN REVIEW') ?> </h3>
                                <p class="control-label"> <?php $t('How do you rate this product? *') ?>  <i class="fa fa-star"></i></p>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label class="control-label"> <?php $t('Rating') ?>  <span class="required">*</span></label>
                                        <select class="form-control form-control-sm">
                                            <option value="1">1 STAR</option>
                                            <option value="2">2 STAR</option>
                                            <option value="3">3 STAR</option>
                                            <option value="4">4 STAR</option>
                                            <option value="5">5 STAR</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> <?php $t('Nickname') ?> <span class="required">*</span></label>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> <?php $t('Summary of Your Review') ?>  <span class="required">*</span></label>
                                        <input type="text" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="control-label"> <?php $t('Rating') ?>  <span class="required">*</span></label>
                                        <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-primary" style="margin-top: 5px; width:100%" value="Submit Review">
                                </form>
                            </div>
                        </div>
                        </div>
                    </dv>
                </div>
























             
                    <div class="container">
                        <h2 class="carousel-title" style="padding: 1rem;"> <?php $t('Relevant Products') ?>  </h2>
                        <div class="category-grid">

                            <?php

							foreach ($relevantResult as $eachrelevantProduct) {
								echo '
							<div class="grid-product">
								<figure class="product-image-container">
									<a href="product?id=' . $eachrelevantProduct['id'] . ' " class="products-image">
										<img src=" ' . $GLOBALS['PRODUCT_DIRECTORY'] . $eachrelevantProduct['product_master_image'] . ' " alt="product">
									</a>
								
								</figure>
								<div class="product-details">
									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:80%"></span>
										</div>
									</div>
									<h2 class="product-title">
										<a href="product?id=' . $eachrelevantProduct['id'] . ' ">' . $eachrelevantProduct['product_name'] . '</a>
									</h2>
									<div class="price-box">
										<span class="product-price">' . $GLOBALS['CURRENCY'] . " " . $eachrelevantProduct['product_price'] . '</span>
									</div>
									<div class="product-grid-action">

                                    <form method="post" action="" class="product-grid-action">
                                    <input type="hidden" name="cart_product_id" value="' .  $eachrelevantProduct['id'] . '"/>
                                    <input type="hidden" name="cart_product_quantity" value="1"/>
                                    <button type="submit" name="add_to_cart" class="btn-icon"  title="Add to Cart">
                                
                                    <i class="bx bx-cart-add box-icon" ></i>
                                    </button>
                                    <a href="product?id=' .  $eachrelevantProduct['id'] . '" >
                                    <i class="bx bx-show box-icon" ></i>
                                    </a>
                                </form>

							
									
									
									
									</div>
								</div>
							</div>
							';
							}
							?>

                        </div>
                    </div>
            

            </div>
</main>