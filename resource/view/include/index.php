<?php

include_once("app/Controllers/Controller.php");
include_once('app/Controllers/Lang.php');
include_once('common/Helper.php');

$eloquent = new Helper;

include_once("app/Controllers/PageController.php");
include_once("common/breadcrumb.php");
$control = new Controller;
$pageControl = new PageController;

include_once("common/showToast.php");

if (isset($_POST['add_to_cart'])) {

	if ($_SESSION['ADD_TO_CART_RESULT'] > 0) {

		showToast($t('added-to-cart-successfully', 1));
	} else {
		showToast($t('register-an-account-first', 1));
	}
}