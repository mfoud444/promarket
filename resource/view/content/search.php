<?php
include_once('resource/view/include/index.php');
include("app/Controllers/SearchController.php");

$searchCtrl = new SearchController;

if(isset($_POST['keywords']))
$_SESSION['search_keywords'] = strip_tags($_POST['keywords']);

$brandFilter = isset($_POST['brand-filter']) ? $_POST['brand-filter'] : 'all';
$priceFilter = isset($_POST['price-filter']) ? $_POST['price-filter'] : 'all';

// Search for products with filters
$searchedProductList = $searchCtrl->searchProduct($_SESSION['search_keywords'], $brandFilter, $priceFilter);

// $searchedProductList = $searchCtrl->searchProduct($_SESSION['search_keywords']);


?>

<main class="main">



	<?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
			['url' => 'search', 'label' => $t('Search', 1)],

		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);

		include_once('resource/view/include/search-filter.php');
		?>

	<div class="container">
		<div class="alert alert-success">
			Showing search result against: <strong><?php echo @$_SESSION['search_keywords']; ?></strong>
		</div>
		
			<div class="row products-body">
				<div class=" main-content">
					
					<?php 
					
						if(empty($searchedProductList))
						{
							echo '<div class="flex">
										<img src="public/assets/images/sorry.png" style="width: auto; height:400px;"/>
									</div>';
						}
					?>
					
					<div class="row row-sm category-grid">
						
						<?php
						
							if(!empty($searchedProductList))
							{
								foreach($searchedProductList AS $eachProduct)
								{	
								
									if(empty($eachProduct['product_master_image'])) {
										$productImage = "public/assets/images/sorry.png";
										} else {
										$productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
									}
									echo '
								
										<div class="grid-product">
											<figure class="product-image-container">
												<a href="product?id='.$eachProduct['id'].'" class="categoryflexgrid-image">
													<img src="'. $productImage .'" alt="product">
												</a>
												
											</figure>
											<div class="product-details">
												<div class="ratings-container">
													<div class="product-ratings">
														<span class="ratings" style="width:80%"></span>
													</div>
												</div>
												<h2 class="product-title">
													<a href="product?id='.$eachProduct['id'].'">'. $eachProduct['product_name'] .'</a>
												</h2>
												<div class="price-box">
													<span class="product-price">'. $eachProduct['product_price'] .'</span>
												</div>
												
													<form class="product-grid-action" method="post" action="">
													<button name="add_to_cart" class="btn-icon" type="submit" title="Add to Cart">
													<input type="hidden" name="cart_product_id" value=" '. $eachProduct['id'] .'">
													<input type="hidden" name="cart_product_quantity" value="1">
													
													<i class="bx bx-cart-add box-icon" ></i>
												</button>
													<a href="product?id='.$eachProduct['id'].'" >
													<i class="bx bx-show box-icon" ></i>
													</a>
													
													</form>
											
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
