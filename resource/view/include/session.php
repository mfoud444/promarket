<?php
if(@$_REQUEST['exit'] == "yes")
{
	session_start() ;
	session_destroy() ;
	header("Location: index");
}
?>