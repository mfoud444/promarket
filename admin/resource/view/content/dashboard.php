<?php
include("resource/view/include/index.php");
$saleResult = $dashboard->sumResult('orders', 'grand_total');
$totalSale = ceil($saleResult[0]['SUM(grand_total)']);	


$monthResult = $dashboard->sumByDate('orders', 'grand_total', 'order_date');
$monthSale = ceil($monthResult[0]['SUM(grand_total)']);


$newResult = $dashboard->dateData('products', 'created_at');
$newProduct = count($newResult);	

$taxResult = $dashboard->sumResult('orders', 'tax');
$totalTax = ceil($taxResult[0]['SUM(tax)']);	


$orderResult = $dashboard->getData('orders', 'order_item_status', 'Pending');
$totalOrder = count($orderResult);


$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "products";
$productResult = $eloquent->selectData($columnName, $tableName);
$totalProduct = count($productResult);	





#== CUSTOMER STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "customers";
$customerResult = $eloquent->selectData($columnName, $tableName);
$totalCustomer = count($customerResult);

?>

<div class="dashboard">
<div class="overview-boxes">
    
        <div class="box">
          <div class="right-side">
            <div class="box-topic"><?= $t('Total-Sales')?></div>
            <div class="number"><?= $totalSale ?></div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
		<div class="box">
          <div class="right-side">
            <div class="box-topic"><?= $t('New-Order')?></div>
            <div class="number"><?= $totalOrder ?></div>
          </div>
          <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic"><?= $t('Total-Tax')?></div>
            <div class="number"><?= $totalTax ?></div>
          </div>
		  <i class='bx bxs-badge-dollar cart three'></i>
       
        </div>
    
    



	
    
	<div class="box">
	  <div class="right-side">
		<div class="box-topic"><?= $t('New-Products-Added')?></div>
		<div class="number"><?= $newProduct ?> </div>
	  </div>
	  <i class='bx bxs-add-to-queue cart two'></i>
	 
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic"><?= $t('Total-Products')?></div>
		<div class="number"><?= $totalProduct ?></div>
	  </div>
	  <i class='bx bxs-box cart'></i>
	
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic"><?= $t('Register-Customer')?></div>
		<div class="number"><?= $totalCustomer ?> </div>
	  </div>
	  <i class='bx bxs-user cart three'></i>
	 
	</div>
	<div class="box">
	  <div class="right-side">
		<div class="box-topic"><?= $t('Sales-This-Month')?></div>
		<div class="number"><?= $monthSale ?></div>
	  </div>
	  <i class='bx bxs-cart-download cart' ></i>
	</div>
  </div>

  
  </div>
  