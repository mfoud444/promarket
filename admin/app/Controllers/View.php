<?php
session_start();
include("config/site.php");
include("../config/server.php");
include("../config/database.php");
class View
{
	public function loadContent($directory, $page_name)
	{
		include("resource/view/".$directory."/".$page_name.".php");
		
		
	}
}
?>