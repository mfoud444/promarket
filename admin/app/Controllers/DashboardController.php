<?php
	class DashboardController extends Controller
	{
	
		
		
		public function dateData($table, $column)
		{
			$sql = 'SELECT * FROM '. $table .' WHERE '. $column .' BETWEEN';
			$sql .= " ' " . date("Y-m-" . "1", strtotime("-30 day")) . " ' AND ' " . date("Y-m-" . "1", strtotime("-0 day")) . " ' ";
			
			$query = $this->connection->prepare($sql);
			$query->execute();
			$getResult = $query->fetchAll(PDO::FETCH_ASSOC);
			
			return $getResult;
		}		
		
		
		public function sumByDate($table, $column1, $column2)
		{
			$sql = 'SELECT SUM('.$column1.') FROM '. $table .' WHERE '. $column2 .' BETWEEN';
			$sql .= " ' " . date("Y-m-" . "1", strtotime("-30 day")) . " ' AND ' " . date("Y-m-" . "1", strtotime("-0 day")) . " ' ";
			
			$query = $this->connection->prepare($sql);
			$query->execute();
			$getResult = $query->fetchAll(PDO::FETCH_ASSOC);
			
			return $getResult;
		}		
		
		
		public function sumResult($table, $column)
		{
			$sql = 'SELECT SUM('.$column.') FROM '.$table;
			
			$query = $this->connection->prepare($sql);
			$query->execute();
			$getResult = $query->fetchAll(PDO::FETCH_ASSOC);
			
			return $getResult;
		}		
		
		
		public function getData($table, $column, $value)
		{
			$sql = 'SELECT * FROM '. $table .' WHERE '. $column .' = "'. $value .'"';
			
			$query = $this->connection->prepare($sql);
			$query->execute();
			$getResult = $query->fetchAll(PDO::FETCH_ASSOC);
			
			return $getResult;
		}
	}
?>