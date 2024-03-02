<?php
include_once('resource/view/include/index.php');

if (isset($_REQUEST['id'])) {

	$_SESSION['category_subcategory_id'] = $_REQUEST['id'];
}

if (empty($_SESSION['category_subcategory_id'])) {
	
	$_SESSION['category_subcategory_id'] = 1;
}
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "categories";
// $whereValue['category_status'] = "Active";
$whereValue['id'] = $_SESSION['category_subcategory_id'];
$categoryMenu = $eloquent->selectData($columnName, $tableName, @$whereValue);

?>

<main class="main">

<?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
			['url' => '#', 'label' => $t(@$categoryMenu[0]['category_name'], 1)],
			
	
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		include_once('resource/view/include/search-filter.php'); 
		?>


    <div class="card-animation-cont">

        <?php
		#== CREATE DYNAMIC MAIN MENU FROM CATEGORIES
		foreach ($categoryMenu as $eachCategory) {

			# GET SUBCATEGORIES DATA FOR SUB MENU BASED ON MAIN CATEGORIES
			$columnName = $tableName = $whereValue = null;
			$columnName = "*";
			$tableName = "subcategories";
			$whereValue['category_id'] = $eachCategory['id'];

			$subcategoryMenu = $eloquent->selectData($columnName, $tableName, @$whereValue);
        if (count($subcategoryMenu) > 0 ){
			foreach ($subcategoryMenu as $eachSubcategory) {


				echo ' 

                <div class="card">
				<a  href="category?subcategoryid=' . $eachSubcategory['id'] . '"> 
				<img src="' . $GLOBALS['BANNER_DIRECTORY'] . $eachSubcategory['subcategory_banner'] . '" class="img-rounded" height="40px" width="180px" />
			</a>

                
                   
                   
                  
                        <a  href="category?subcategoryid=' . $eachSubcategory['id'] . '"> <strong class="title-section">' . $eachSubcategory['subcategory_name'] . '</strong></a>
                   
						<a class="btn-visit" href="category?subcategoryid=' . $eachSubcategory['id'] . '">' . $t('Browser-Section', 1) . '</a>
                
                </div>
          
          ';
			}
		}else{
			echo '<a href="category?categoryid=' . $eachCategory['id'] . '"></a>';
			echo '
				<script>
					document.addEventListener("DOMContentLoaded", function () {
						document.querySelector("a[href=\'category?categoryid=' . $eachCategory['id'] . '\']").click();
					});
				</script>
			';
		
			// echo '<a  href="category?catagoryid=' . $eachCategory['id'] . '">pp</a>';
		}
		}; ?>




</main>