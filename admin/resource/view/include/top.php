<!DOCTYPE html>
<html lang="en">
<head>

    <?php
	$pageName = basename($_SERVER['PHP_SELF']);
	$pageName = str_replace('.php', '', $pageName);

	if ($pageName === 'index') {
		$pageTitle = ucwords('Productive Families');
	} else {
		$strReplace =  str_replace('-', ' ', $pageName);
		$pageTitle = ucwords($strReplace);
	}
	?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?php echo $pageTitle ?> </title>
    <link href="../public/assets/css/admin/index.css" rel="stylesheet">
</head>

<body>

    <?php
include("app/Controllers/Lang.php");

?>
    <section>



        <!-- navbar -->
        <nav class="navbar">
            <a href="dashboard">
                <div class="logo_item">
                    <i class="bx bx-menu" id="sidebarOpen"></i>
                    <h1 class="name-website"><?php echo $GLOBALS['NameWebsite']?></h1>
                </div>
            </a>
            <!-- <form class="search_bar" action="" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="<?php echo $t('Search-here') ?>" />
            </form> -->

            <div class="navbar_content">
                <i class="bi bi-grid"></i>

                <h3 class="name-user"> <?php echo $_SESSION['SMC_login_admin_name']; ?> </h3>
                <img src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $_SESSION['SMC_login_admin_image']; ?>" alt=""
                    class="profile" />
            </div>
        </nav>
        <!-- sidebar -->
        <nav class="sidebar">
            <div class="bottom_content">
                <div class="bottom  expand_sidebar">
                    
                    <i class='bx bx-log-in'></i>
                </div>
                <div class="bottom  collapse_sidebar">
                   
                    <i class='bx bx-log-out'></i>
                </div>
            </div>

            <div class="menu_content">
                <ul class="menu_items">
                    <div class="menu_title menu_dahsboard"></div>
                    <li class="item">
                        <a href="dashboard" class="nav_link">
                            <span class="navlink_icon">
                                <i class="bx bx-home-alt"></i>
                            </span>
                            <span class="navlink"><?php $t('dashboard')?></span>
                        </a>
                    </li>

                    <?php
				
					if ($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator") {
						echo '
						<li class="item">
							<div href="#" class="nav_link submenu_item">
								<span class="navlink_icon">
								<i class="bx bx-id-card"></i>
								</span>
								<span class="navlink">'. $t('Manage-Admin',1)  .' </span>
								<i class="bx bx-chevron-right arrow-left"></i>
							</div>
							<ul class="menu_items submenu">
								<a href="create-admin" class="nav_link sublink">'. $t('Create-Admin', 1).'</a>
								<a href="list-admin" class="nav_link sublink">'. $t('List-Admin',1).'</a>
							</ul>
						</li>';
						
					}



					if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")
					{

						echo '
						<li class="item">
							<div href="#" class="nav_link submenu_item">
								<span class="navlink_icon">
								<i class="bx bxs-user"></i>
								</span>
								<span class="navlink">'. $t('Manage-Customer',1) .' </span>
								<i class="bx bx-chevron-right arrow-left"></i>
							</div>
							<ul class="menu_items submenu">
								<a href="list-customer" class="nav_link sublink">'. $t('Customer-List', 1).'</a>
								<a href="review" class="nav_link sublink">'. $t('Customer-Overview',1).'</a>
							</ul>
						</li>';

					
					}


					if ($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator") {
						echo '
								<li class="item">
								<div href="#" class="nav_link submenu_item">
								  <span class="navlink_icon">
								  <i class="bx bx-customize"></i>
								  </span>
								  </span>
								  <span class="navlink">
								  ';
									$t('Manage-Category');
							  echo '</span>
								  
								  <i class="bx bx-chevron-right arrow-left"></i>
								</div>
								<ul class="menu_items submenu">
								  <a href="create-category"  class="nav_link sublink">'. $t('Create-Category',1).'</a>
								  <a href="list-category" class="nav_link sublink">'. $t('List-Category',1).' </a>
								</ul>
							  </li>

							
								';
					}

					if ($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator") {
						echo '
							<li class="item">
							<div href="#" class="nav_link submenu_item">
							  <span class="navlink_icon">
							  <i class="bx bx-list-minus"></i>
							  </span>
							  <span class="navlink">'. $t('Manage-Sub-Category',1).'</span>
							  <i class="bx bx-chevron-right arrow-left"></i>
							</div>
							<ul class="menu_items submenu">
							  <a href="create-subcategory"  class="nav_link sublink">'. $t('Create-Sub-Category',1).'</a>
							  <a href="list-subcategory" class="nav_link sublink">'. $t('Sub-Category-List',1).'  </a>
							</ul>
						  </li>

						
							';
					}
					if ($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Content Manager") {
						echo '
						<li class="item">
						<div href="#" class="nav_link submenu_item">
						  <span class="navlink_icon">
						  <i class="bx bxl-product-hunt" ></i>
						  </span>
						  <span class="navlink">'.  $t('Manage-Products',1) .'</span>
						  <i class="bx bx-chevron-right arrow-left"></i>
						</div>
						<ul class="menu_items submenu">
						  <a href="create-product"  class="nav_link sublink">'.$t('create-product', 1).'</a>
						  <a href="list-product" class="nav_link sublink">'.$t('list-product', 1).' </a>
						</ul>
					  </li>

					
						';
					}

					if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager"){
						echo '
						<li class="item">
						<div href="#" class="nav_link submenu_item">
						  <span class="navlink_icon">
						  <i class="bx bxs-cart-alt"></i>
						  </span>
						  <span class="navlink">'.  $t('Manage-Orders',1) .'</span>
						  <i class="bx bx-chevron-right arrow-left"></i>
						</div>
						<ul class="menu_items submenu">
						  <a href="list-order"  class="nav_link sublink">'.$t('Orders-List', 1).'</a>
						  <a href="invoice-list" class="nav_link sublink">'.$t('Invoice-List', 1).' </a>
						</ul>
					  </li>

					
						';
					}

					?>



                </ul>
                <ul class="menu_items">
                    <div class="menu_title menu_setting"></div>
                    <li class="item">
                        <div href="#" class="nav_link submenu_item">
                            <span class="navlink_icon">
                                <i class="bx bx-world"></i>
                            </span>
                            <span class="navlink"><?php $t('language')?></span>
                            <i class="bx bx-chevron-right arrow-left"></i>
                        </div>
                        <ul class="menu_items submenu">
                            <a href="?lang=en" class="nav_link sublink sublink-icon"><img
                                    src="../public/assets/images/favicon/en.png">
                                <div><?php $t('English')?></div>
                            </a>
                            <a href="?lang=ar" class="nav_link sublink sublink-icon"><img
                                    src="../public/assets/images/favicon/ar.png" style="	height: 13px; ">
                                <div>Arabic</div>
                            </a>
                        </ul>
                    </li>
                    <li class="item">
                        <a href="?exit=yes" class="nav_link">
                            <span class="navlink_icon">
                                <i class="bx bx-log-out-circle"></i>
                            </span>
                            <span class="navlink"><?php $t('Logout')?></span>
                        </a>
                    </li>

                </ul>

            </div>
        </nav>
        <div class="main">
		<div id="toast" class="hidden1">
        <div id="toast-content"></div>
    </div>
			