<?php
include_once('resource/view/include/index.php');
if (isset($_REQUEST['subcategoryid'])) {

$_SESSION['category_subcategory_id'] = $_REQUEST['subcategoryid'];
$categoryDetails = $pageControl->fetchData('products', 'subcategory_id', $_SESSION['category_subcategory_id']);
$columnName = $tableName = $whereValue = null;
$columnName["1"] = "categories.id";
$columnName["2"] = "categories.category_name";
$columnName["3"] = "subcategories.subcategory_name";
$columnName["4"] = "subcategories.subcategory_banner";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$whereValue["subcategories.id"] = $_SESSION['category_subcategory_id'];
$categoryResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);

$links = [
	['url' => 'index', 'label' => $t('home', 1)],
	['url' => 'sub-catagory?id='.@$categoryResult[0]['id'], 'label' => $t(@$categoryResult[0]['category_name'], 1)],
	['url' => '', 'label' => $t($categoryResult[0]['subcategory_name'], 1)],
];

}else if (isset($_REQUEST['catagoryid'])) {
$_SESSION['category_id'] = $_REQUEST['catagoryid'];
$categoryDetails = $pageControl->fetchData('products', 'category_id', $_SESSION['category_id']);
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "categories";
$whereValue["categories.id"] = $_SESSION['category_id'];
$categoryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);

$links = [
	['url' => 'index', 'label' => $t('home', 1)],
	['url' => '', 'label' => $t(@$categoryResult[0]['category_name'], 1)],
];
}

// if (empty($_SESSION['category_subcategory_id'])) {

// if (empty($_SESSION['category_id'])) {
// 	$_SESSION['category_subcategory_id'] = 1;
// }
	
// }

?>

<main class="main">



    <div class="cart">

    </div>


    <?php

	echo BreadcrumbGenerator::generateBreadcrumb($links);
	?>

    <div class="container">

        <?php include_once('resource/view/include/search-filter.php'); ?>



        <div class="row products-body">
            <div class="main-content">

                <?php

				if (empty($categoryDetails)) {
					echo '
					<div class="flex-col">
<h1 style="color: var(--main-color);">PRODUCT IS UNAVAILABLE</h1>
<img src="public/assets/images/sorry.png" height="300px" width="300px" alt="">
</div>
					';
				}
				?>

                <div class="category-grid">

                    <?php

					if (!empty($categoryDetails)) {
						foreach ($categoryDetails as $eachCategory) {

							if (empty($eachCategory['product_master_image'])) {
								$productImage = "<img src='public/assets/images/no-product-found.png'>";
							} else {
								$productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachCategory['product_master_image'];
							}

							echo '
									<div>
										<div class="grid-product">
											<figure class="product-image-container">
												<a href="product?id=' . $eachCategory['id'] . '" class="categoryflexgrid-image">
													<img src="' . $productImage . '" alt="product">
												</a>
											
											</figure>
											<div class="product-details">
										
												<h2 class="product-title" >
													<a style="color:var(--main-color);" href="product?id=' . $eachCategory['id'] . '">' . $eachCategory['product_name'] . '</a>
												</h2>
												<div class="price-box">
													<span class="product-price">' . $GLOBALS['CURRENCY'] . " " . $eachCategory['product_price'] . '</span>
												</div>
												<div class=" d-flex justify-content-center">
													<form method="post" action="" class="product-grid-action">
														<input type="hidden" name="cart_product_id" value="' . $eachCategory['id'] . '"/>
														<input type="hidden" name="cart_product_quantity" value="1"/>
														<button type="submit" name="add_to_cart" class="btn-icon"  title="Add to Cart">
													
														<i class="bx bx-cart-add box-icon" ></i>
														</button>
														<a href="product?id=' . $eachCategory['id'] . '" >
														<i class="bx bx-show box-icon" ></i>
														</a>
													</form>
													
												</div>
											</div>
										</div>
									</div>
									';
						}
					}
					?>

                </div>






            </div>





        </div>
    </div>
    </div>

</main>