<?php
class SearchController extends Controller
{public function searchProduct($htmlKeywords, $brandFilter = 'all', $priceFilter = 'all')
	{
		$arrayKeywords = explode(" ", $htmlKeywords);
	
		$sql1 = $sql2 = null;
		$sql1 = "SELECT * FROM products WHERE ";
	
		foreach ($arrayKeywords as $eachKey) {
			$sql2 .= "product_tags LIKE '%" . $eachKey . "%' OR ";
		}
		$sql2 = rtrim($sql2, " OR ");
	
		try {
			if ($brandFilter !== 'all') {
				$sql1 .= "brand_id = :brand_id AND ";
			}
	
			$sql_code = $sql1 . $sql2;
	
			if ($priceFilter === 'price') {
				$sql_code .= "ORDER BY product_price ASC ";
			} elseif ($priceFilter === 'price-desc') {
				$sql_code .= "ORDER BY product_price DESC ";
			}
	
			// Prepare and execute the query with parameters
			$query = $this->connection->prepare($sql_code);
	
			if ($brandFilter !== 'all') {
				$query->bindParam(':brand_id', $brandFilter, PDO::PARAM_INT);
			}
	
			$query->execute();
	
			$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
			$totalRowSelected = $query->rowCount();
	
			if ($totalRowSelected > 0) {
				return $dataList;
			} else {
				return 0;
			}
		} catch (PDOException $e) {
	
			echo $e->getMessage();
			throw new Exception("Database error: " . $e->getMessage());
		}
	
	}
	



	public function searchProductLimit($htmlKeywords, $start, $end)
	{
		$arrayKeywords = explode(" ", $htmlKeywords);

		$sql1 = $sql2 = null;
		$sql1 = "
			SELECT * 
			FROM products 
			WHERE 
		";
		foreach ($arrayKeywords as $eachKey) {
			$sql2 .= "product_tags LIKE '%" . $eachKey . "%' OR ";
		}
		$sql2 = rtrim($sql2, " OR");
		$sql3 = " LIMIT {$start}, {$end} ";

		$sql_code = $sql1 . $sql2 . $sql3;

		$query = $this->connection->prepare($sql_code);

		$query->execute();

		$pageList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if ($totalRowSelected > 0)
			return $pageList;
		else
			return 0;
	}
}
