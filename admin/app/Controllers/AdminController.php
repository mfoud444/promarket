<?php
	class AdminController extends Controller
{
	
	public function tryLogin($username, $password)
	{
		$sql_code = "SELECT * FROM `admins` WHERE `admin_email`=:VALUE1 AND `admin_password`=:VALUE2";
		$query = $this->connection->prepare($sql_code);
		
		$values = array(
			':VALUE1' => $username,
			':VALUE2' => $password
			);
		$query->execute($values);
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}	
	
	

	public function createAdminData($admin_name, $admin_email, $admin_image, $admin_password, $admin_type, $admin_status)
	{
		
		$sql_code = "
		INSERT INTO `admins` (`admin_name`, `admin_email`, `admin_image`, `admin_password`, `admin_type`, `admin_status`, `created_at`) 
		VALUES (:ADMIN_NAME, :ADMIN_EMAIL, :ADMIN_IMAGE, :ADMIN_PASSWORD, :ADMIN_TYPE, :ADMIN_STATUS, :CREATED_AT)
		";
		
		$query = $this->connection->prepare($sql_code);		

		
		$values = array(
			':ADMIN_NAME'			=> $admin_name, 
			':ADMIN_EMAIL' 			=> $admin_email, 
			':ADMIN_IMAGE'			=> $admin_image, 
			':ADMIN_PASSWORD'	=> $admin_password,
			':ADMIN_TYPE' 				=> $admin_type,
			':ADMIN_STATUS'			=> $admin_status,
			':CREATED_AT'				=> date("Y-m-d H:i:s")
		);
		
		$query->execute($values);										
		$totalRowInserted = $query->rowCount();				
		$lastInsertId = $this->connection->lastInsertId();		

			return $totalRowInserted;
	}
	
	

	public function listAdminData()
	{
		$sql_code = "SELECT * FROM `admins`";
		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	

	public function editAdminData($id, $admin_name, $admin_email, $admin_image, $admin_type, $admin_status)
	{
		
		$sql_code = "
			UPDATE `admins` 
			SET `admin_name`=:ADMIN_NAME,
				`admin_email`=:ADMIN_EMAIL,
				`admin_image`=:ADMIN_IMAGE,
				`admin_type`=:ADMIN_TYPE,
				`admin_status`=:ADMIN_STATUS
			WHERE `id` = :ID
		";

		$query = $this->connection->prepare($sql_code);
		$values = array(	
				':ADMIN_NAME'	=> $admin_name,
				':ADMIN_EMAIL'	=> $admin_email,
				':ADMIN_IMAGE'	=> $admin_image,
				':ADMIN_TYPE'		=> $admin_type,
				':ADMIN_STATUS'	=> $admin_status,
				':ID'						=> $id
		);
		
		$query->execute($values);
		$totalRowUpdated = $query->rowCount();
		
			return $totalRowUpdated;
	}	
	
	public function updateAdminData($id, $admin_name, $admin_email, $admin_type, $admin_status)
	{
		
		$sql_code = "
			UPDATE `admins` 
			SET `admin_name`=:ADMIN_NAME,
				`admin_email`=:ADMIN_EMAIL,
				`admin_type`=:ADMIN_TYPE,
				`admin_status`=:ADMIN_STATUS
			WHERE `id` = :ID
		";


		$query = $this->connection->prepare($sql_code);

		$values = array(
			':ADMIN_NAME' => $admin_name,
			':ADMIN_EMAIL' => $admin_email,
			':ADMIN_TYPE' => $admin_type,
			':ADMIN_STATUS' => $admin_status,
			':ID' => $id
		);

	
		$query->execute($values);

		$totalRowUpdated = $query->rowCount();
		
		return $totalRowUpdated;
	}
	

	public function deleteAdminData($admin_id)
	{
		$sql_code = "DELETE FROM `admins` WHERE id=:ID";
		$query = $this->connection->prepare($sql_code);
		$values = array( ':ID' => $admin_id );
		$query->execute($values);
		$deletedRowNumber = $query->rowCount();
		
			return $deletedRowNumber;
	}
	
	

	public function changeAdminStatus($admin_id, $current_status)
	{
		
		if($current_status == "Active")
			$sql_code = "UPDATE `admins` SET `admin_status`='Inactive' WHERE `id` = :ID";	
		else if($current_status == "Inactive")
			$sql_code = "UPDATE `admins` SET `admin_status`='Active' WHERE `id` = :ID";

		$query = $this->connection->prepare($sql_code);
		$values = array( ':ID' => $admin_id );
		$query->execute($values);
		$totalRowUpdated = $query->rowCount();
		
			return $totalRowUpdated;
	}
	
	
	
	public function getAdminData($admin_id)
	{
		$sql_code = "SELECT * FROM `admins` WHERE `id`=:ID";
		$query = $this->connection->prepare($sql_code);
		
		$values = array( ':ID' => $admin_id );
		$query->execute($values);
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	
}
?>