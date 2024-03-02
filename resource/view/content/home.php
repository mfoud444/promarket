<?php
include_once('resource/view/include/index.php');

$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "categories";
$whereValue['category_status'] = "Active";
$categoryMenu = $eloquent->selectData($columnName, $tableName, @$whereValue);
?>


<main class="main">

<?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
	
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
  include_once('resource/view/include/search-filter.php'); 

		?>
    <div class="card-animation-cont">

        <?php

    foreach ($categoryMenu as $eachCategory) {
 
   
     
  
        # GET SUBCATEGORIES DATA FOR SUB MENU BASED ON MAIN CATEGORIES
        $columnName = $tableName = $whereValue = null;
        $columnName = "*";
        $tableName = "subcategories";
        $whereValue['category_id'] = $eachCategory['id'];
  
        $subcategoryMenu = $eloquent->selectData($columnName, $tableName, @$whereValue);
          if (count($subcategoryMenu) > 0 ){
            $link = "sub-catagory?id=" . $eachCategory['id'];
          }else{
            $link = "category?catagoryid=" . $eachCategory['id'];
          }
        


     echo ' 
     <div class="card">
     <a   href="' .  $link . '"> 
     <img src="' . $GLOBALS['CATEGORY_DIRECTORY'] . $eachCategory['category_image'] . '" class="img-rounded" height="40px" width="180px" />
   </a>

       <a href="' .  $link . '"><strong class="title-section">' . $eachCategory['category_name'] . '</strong></a>
         
         <a class="btn" href="' .  $link . '">' . $t('Browser-Section', 1) . '</a>
     </div>

';
    }; ?>




</main>