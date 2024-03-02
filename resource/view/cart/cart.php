<?php

use function PHPSTORM_META\type;

include_once('resource/view/include/index.php');
if(isset($_POST['update_cart']))
{
	$columnValue = $tableName = $whereValue = null;
	$tableName = "shopcarts";
	$columnValue["quantity"] = $_POST['quantity'];
	$whereValue["id"] = $_POST['cart_id'];
	$updateCartItem = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}

if(isset($_POST['remove_cart']))
{
	$tableName = $whereValue = null;
	$tableName = "shopcarts";
	$whereValue["id"] = $_POST['remove_id'];
	$deleteCart = $eloquent->deleteData($tableName, @$whereValue);
}



$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = $paginate = null;
$columnName["1"] = "shopcarts.quantity";
$columnName["2"] = "shopcarts.id";
$columnName["3"] = "products.product_name";
$columnName["4"] = "products.product_price";
$columnName["5"] = "products.product_master_image";
$tableName["MAIN"] = "shopcarts";
$joinType = "INNER";
$tableName["1"] = "products";
$onCondition["1"] = ["shopcarts.product_id", "products.id"];
$whereValue["shopcarts.customer_id"] = @$_SESSION['SSCF_login_id'];
$formatBy["DESC"] = "shopcarts.id";
$myShopcartItems = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);

if(isset($_POST['fob']))
{
	if(@$_SESSION['SSCF_login_id'] > 0)
	{
	
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "deliveries";
		$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
		$availibilityCharge = $eloquent->selectData($columnName, $tableName, @$whereValue);
		
	
		if(!empty($availibilityCharge))
		{
			$columnValue = $tableName = $whereValue = null;
			$tableName = "deliveries";
			$columnValue["created_at"] = date("Y-m-d H:i:s");
			$columnValue["shipping_charge"] = $_POST['shipping_method'];
			$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$updateCharge = $eloquent->updateData($tableName, $columnValue, @$whereValue);
		}
		

		else
		{
			$columnValue = $tableName = null;
			$tableName = "deliveries";
			$columnValue["created_at"] = date("Y-m-d H:i:s");
			$columnValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$columnValue["shipping_charge"] = $_POST['shipping_method'];
			$insertCharge = $eloquent->insertData($tableName, $columnValue, @$whereValue);
		}
	}
}

$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "deliveries";
$deliveryCharge = $eloquent->selectData($columnName, $tableName, @$whereValue);

@$fobCost = $deliveryCharge[0]['shipping_charge'];
if (is_null($fobCost)) {
    $buttonStatus = 'disabled';
    $buttonClass = 'btn-disabled'; // Add a CSS class for the disabled state
} else {
    $buttonStatus = '';
    $buttonClass = 'btn-primary'; // Use the default button class
}
@$_SESSION['SSCF_DISCOUNT_AMOUNT'] =0;
?>

<main class="main">



								
						                  
					
    <?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
			['url' => '#', 'label' => $t('Shopping-Cart', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
    
		?>

	<div class="container">
		<div class="flex" style="justify-content: space-around; flex-wrap: wrap;">
		
				
				<?php 
					
					if(isset($_POST['remove_cart']))
					{
						if($deleteCart > 0)

						{
							showToast($t('The Cart Item is deleted successfully', 1));
						
						} 
				
					}
					
					
					
				?>
				
				<div class="cart-table-container">
					<table class="table table-cart">
						<thead>
							<tr>
							<th class="product-col"><?= $t('Product')?></th>
        <th class="price-col"><?= $t('Price')?></th>
        <th class="qty-col"><?= $t('Qty')?></th>
        <th class="price-col"><?= $t('Total')?></th>
								<th ><?= $t('Action')?></th>
							</tr>
						</thead>
						<tbody>
							
							<?php
							
								#== DYNAMIC CART PRODUCT LIST
								foreach($myShopcartItems AS $eachCartItems)
								{
									echo '
									<form method="post" action="">
										<tr class="product-row">
											<td class="product-col">
												<figure class="product-image-container">
													<a href="product?id='. $eachCartItems['id'].'" class="shopcart-image">
														<img  src="' . $GLOBALS['PRODUCT_DIRECTORY'] . $eachCartItems['product_master_image']. '" alt="product" >
													</a>
												</figure>
												<h2 class="product-title">
													<a href="product?id='. $eachCartItems['id'].'">'.$eachCartItems['product_name'].'</a>
												</h2>
											</td>
											<td>' . $GLOBALS['CURRENCY'] . " " . $eachCartItems['product_price']. '</td>


											<td>
												<input  name="quantity" class="form-control quantity-number" type="number" min="1" value="'.@$eachCartItems['quantity'].'">
											</td>


											<td ><div class="price-table">' . $GLOBALS['CURRENCY'] . " " . ($eachCartItems['product_price'] * $eachCartItems['quantity']) . '</div></td>
											<td class="bb">
												<div class="d-flex checkout-steps-action">
													<input type="hidden" name="cart_id" value=" ' . $eachCartItems['id'] . ' " />


													<button name="update_cart" type="submit" class="btn-switch btn-action-table" >
													<i class="bx bx-refresh bx-sm"></i>
													</button>


													<input type="hidden" name="remove_id" value=" ' . $eachCartItems['id'] . ' " />
													<button name="remove_cart" type="submit" class="btn-switch btn-action-table"  >
													<img src="public/assets/images/delete.svg" class="hero-icon delete" alt="Remove">
													</button>
												
												</div>
											</td>
										</tr>
									</form>
									';
								}
							?>
							
						</tbody>

					</table>
			
			</div>


<div class="cart-table-container">



			<div class="step2-order">


		


				<div class="cart-summary">

				<div>
				<h2><?= $t('Shipping Methods') ?></h2>
        <form class="form-horizontal" style="gap:10px;" action="" method="post">
            <div class="input-group">
                <div style="color: red; font-size: 1rem; padding-bottom:0.6rem;">
                    <?= $t('Please choose a shipping method') ?>
                </div>
                <select class="form-control" name="shipping_method">
                    <option><?= $t('select shipping method') ?></option>
                    <option value="50" selected><?= $t('Receiving the order') ?></option>
                </select>
            </div>
            <div class="input-group-append">
                <button name="fob" class="btn btn-sm btn-info" style="width: 100%;" type="submit">
                    <?= $t('Confirm Shipping') ?>
                </button>
            </div>
        </form>
    </div>

    <h2><?= $t('Summary') ?></h2>
    <table class="table table-totals">
        <tbody>
            <tr>
                <td><?= $t('Subtotal') ?></td>
                <td>
                    <?php 
                        #== SUBTOTAL PRICE SUMMATION
                        $cartSubtotal = 0;
                        foreach ($myShopcartItems AS $eachSubtotal)
                        {
                            $cartSubtotal += ($eachSubtotal['quantity'] * $eachSubtotal['product_price']);
                        }
                        echo $GLOBALS['CURRENCY'] . " " . $cartSubtotal;
                    ?>
                </td>
            </tr>
            <tr>
                <td><?= $t('Tax') ?></td>
                <td><?= $GLOBALS['CURRENCY'] . " " . $tax = ($cartSubtotal * $GLOBALS['TAX']) / 100; ?></td>
            </tr>
            <tr>
                <td><?= $t('Delivery Charge') ?></td>
                <td>
                    <?= $GLOBALS['CURRENCY'] . " "; ?>
                    <span id="charge">
                        <?php 
                            if(@$fobCost <= 0)
                            {
                                echo 0;
                            }
                            else 
                            {
                                echo @$fobCost; 
                            }
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td><?= $t('Discount Amount') ?></td>
                <td><?= $GLOBALS['CURRENCY'] . " "; ?><?= @$_SESSION['SSCF_DISCOUNT_AMOUNT'];?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td><?= $t('Order Total') ?></td>
                <td>
                    <?= $GLOBALS['CURRENCY'] . " " . $grandTotal = round((($cartSubtotal + $tax) - @$_SESSION['SSCF_DISCOUNT_AMOUNT']) + $fobCost); ?>
                </td>
            </tr>
        </tfoot>
    </table>
			
					<div class="checkout-methods">
						
						<?php
							if(!empty(@$fobCost))
							{
						?>
							
						<form action="order" method="post">
								
						<?php 
							}
						?>
							<input type="hidden" name="cartsub_total" value="<?php echo $cartSubtotal; ?>">
							<input type="hidden" name="tax_total" value="<?php echo $tax; ?>">
							<input type="hidden" name="discount_amount" value="<?php echo @$_SESSION['SSCF_DISCOUNT_AMOUNT']; ?>">
							<input type="hidden" name="delivery_charge" value="<?php echo @$fobCost; ?>">
							<input type="hidden" name="grand_total" value="<?php echo $grandTotal; ?>">
							<button name="submit_order" id="fEvent" class="btn <?php echo $buttonClass; ?> btn-action-table" style="width: 100%; " <?php echo $buttonStatus; ?>><?php echo $t("Proceed-to-Order") ?></button>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
		
			
			
		</div>
	</div>

</main>
<!--=*= CART SECTION START =*=-->

<!--=*= ORDER PLACED FORM CART =*=-->
<script type="text/javascript">
	$(document).ready(function(){
		var data = $('#charge').html();
		$('#fEvent').click(function(){
			if(data == 0){
				$('#message').show();
			}
		});
	});
</script>
<!--=*= ORDER PLACED FORM END =*=-->