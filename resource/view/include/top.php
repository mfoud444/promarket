<!DOCTYPE html>
<html lang="en">

<head>

    <?php
	$pageName = basename($_SERVER['PHP_SELF']);
	$pageName = str_replace('.php', '', $pageName);

	if ($pageName === 'index') {
		$pageTitle = ucwords($GLOBALS['NameWebsite']);
	} else {
		$strReplace =  str_replace('-', ' ', $pageName);
		$pageTitle = ucwords($strReplace);
	}
	?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $pageTitle ?> </title>
    <link rel="stylesheet" href="public/assets/css/client/index.css">
   
</head>

<body>
    <?php
	include_once("common/Helper.php");

	$eloquent = new Helper;
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "categories";
	$whereValue['category_status'] = "Active";
	$categoryMenu = $eloquent->selectData($columnName, $tableName, @$whereValue);
	if (isset($_POST['add_to_cart'])) {
		if (@$_SESSION['SSCF_login_id'] > 0) {
			$columnName = $tableName = $whereValue = null;
			$columnName = "*";
			$tableName = "shopcarts";
			$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$whereValue["product_id"] = $_POST['cart_product_id'];
			$availabilityInCart = $eloquent->selectData($columnName, $tableName, @$whereValue);
			if (!empty($availabilityInCart)) {
				$columnName = $tableName = $whereValue = null;
				$tableName = "shopcarts";
				$columnValue["quantity"] = $_POST['cart_product_quantity'] + $availabilityInCart[0]['quantity'];
				$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
				$whereValue["product_id"] = $_POST['cart_product_id'];
				$updateCartResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);
				$_SESSION['ADD_TO_CART_RESULT'] = $updateCartResult;
			} else {

				$columnValue = $tableName = null;
				$tableName = "shopcarts";
				$columnValue["customer_id"] = @$_SESSION['SSCF_login_id'];
				$columnValue["product_id"] = $_POST['cart_product_id'];
				$columnValue["quantity"] = $_POST['cart_product_quantity'];
				$columnValue["created_at"] = date("Y-m-d H:i:s");
				$addToCartResult = $eloquent->insertData($tableName, $columnValue);
				$_SESSION['ADD_TO_CART_RESULT'] = $addToCartResult;
			}
		} else {
			$_SESSION['ADD_TO_CART_RESULT'] = 0;
		}
	}
	$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = null;
	$columnName["1"] = "shopcarts.quantity";
	$columnName["2"] = "products.id";
	$columnName["3"] = "products.product_name";
	$columnName["4"] = "products.product_price";
	$columnName["5"] = "products.product_master_image";
	$tableName["MAIN"] = "shopcarts";
	$joinType = "INNER";
	$tableName["1"] = "products";
	$onCondition["1"] = ["shopcarts.product_id", "products.id"];
	$whereValue["shopcarts.customer_id"] = @$_SESSION['SSCF_login_id'];
	$formatBy["DESC"] = "shopcarts.id";
	$myaddcartItems = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);
	include_once("common/Translation.php");
$selectedLang = isset($_GET['lang']) ? $_GET['lang'] : $_SESSION['LANG'] ?? $GLOBALS['LANG'];
$selectedLang = in_array($selectedLang, $GLOBALS['SUPPORTED_LANG']) ? $selectedLang : $GLOBALS['LANG'];
$_SESSION['LANG'] = $selectedLang;
$lang = $_SESSION['LANG'];
$translationFile = "resource/lang/{$lang}/language.php";
Translation::loadTranslations($translationFile);
$currentLangName = ($lang === 'en') ? 'ENGLISH' : 'العربية';
$currentLangIcon = ($lang === 'en') ? 'public/assets/images/favicon/en.png' : 'public/assets/images/favicon/ar.png';
$t = $GLOBALS['t'];


	?>
 

		<header id="header-id">


<nav>
	<div class="container-id">
		<div class="logo">
			<img src="./img/logo.png" alt="" />
		</div>

		<div class="links">
			<ul>
				<li>
					<a href="index"><?php $t('home') ?></a>
				</li>
			
				<?php if (@$_SESSION['SSCF_login_id'] > 0) { ?>

				  <li>
					<a href="dashboard"><?php $t('My-Account')?></a>
				</li>
			  <li><a href="cart"><?php $t('My-Cart')?></a></li>
			  <li>
					<a href="contact"><?php $t('Contact-Us')?></a>
				</li>
				
	  <li><a href="?exit=yes"><?php $t('Logout')?></a></li>
				<?php } else {
	?>

<li>
					<a href="contact"><?php $t('Contact-Us')?></a>
				</li>

				<li>
					<a href="login" class="active" style="color:#fff"><?php $t('Login')?></a>
				</li>
				<?php    }  ?>

			</ul>
		</div>

		<div class="hamburger-menu">
			<div class="bar"></div>
		</div>
	</div>
</nav>

</header>

	
		<div id="toast" class="hidden1">
        <div id="toast-content"></div>
    </div>





		