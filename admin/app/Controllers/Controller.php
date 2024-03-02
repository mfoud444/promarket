<?php 
	class Controller
	{
		public $connection;
		
	
		public function __construct()
		{
			$this->connection = new PDO('mysql:host='.$GLOBALS['DBHOST'].';dbname='.$GLOBALS['DBNAME'].';charset=utf8', $GLOBALS['DBUSER'], $GLOBALS['DBPASS']);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
		
	
		public function sqlInjCheck($value)
		{
		
			$value = urldecode($value);
			
		
			if (get_magic_quotes_gpc())
			{
				$value = stripslashes($value);
			}
		
			if (!is_numeric($value))
			{
				@$value = strip_tags(mysql_real_escape_string($value));
			}
			
	
			$value = trim($value);
			
			return @$value;
		}
		
	
		public function letNumCheck($value)
		{
			$value = urldecode($value); 
			if (!preg_match('/[^a-z A-Z 0-9\s]/i', $value))
			{
				return $value;
			} 
			else 
			{
				return '';
			}
		}
		
		
		public function alphaCheck($value)
		{
			$value = urldecode($value); 
			if (!preg_match('/[^a-z A-Z\s]/i', $value))
			{
				return $value;
			} 
			else 
			{
				return '';
			}
		}
		
		
		public function passCheck($value)
		{
			$value = trim($value);
			
			if(preg_match('/[$%^()+=\\[\]\';,\/{}|":<>?~\\\\]/', $value) == 0)
			return $value;
			else
			return '';
		}
		
		
		public function mailCheck($value)
		{
			$value = trim($value);
			
			if(preg_match('/[#$%^&*()+=\\[\]\';,\/{}|":<>?~\\\\]/', $value) == 0)
			return $value;
			else
			return '';
		}
		
		
		
		public function checkImage($fileType, $fileSize, $fileError)
		{
		
			if ((($fileType == "image/gif")
			|| ($fileType == "image/jpeg")
			|| ($fileType == "image/jpg")
			|| ($fileType == "image/pjpeg")
			|| ($fileType == "image/x-png")
			|| ($fileType == "image/png"))
			&& ($fileSize < 52428800)
			&& ($fileError <= 0))
			{
				return 1;
			}
			else 
			return 0;
		}
		
	
		public function makePass() 
		{
			$alphabet = "56789abcdefghijklmnopqrstuwxyz@#%#@ABCDEFGHIJKLMNOPQRSTUWXYZ01234";
			$pass = array(); 
			$alphaLength = strlen($alphabet) - 1; 
			for ($i = 0; $i < 8; $i++) 
			{
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			return implode($pass); 
		}
		
	
	
	

		
	
		
	
	}
?>