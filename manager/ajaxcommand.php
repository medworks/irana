<?php
	include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");	
	
	$db = Database::GetDatabase();

 if (isset($_GET["planid"]))
{   $rows = array();
	$rows = $db->Select("plans","*","id={$_GET[planid]}","id ASC");	
	echo json_encode($rows);
}


?>