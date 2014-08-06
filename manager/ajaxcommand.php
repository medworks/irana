<?php
	include_once("../config.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");	
	
	$db = Database::GetDatabase();

 if (isset($_GET["planid"]))
{   $row = array();
	$row = $db->Select("plans","*","id={$_GET[planid]}");	
	echo json_encode($row);
}

 if (isset($_GET["recplan"]))
{   $row = array();
	//$row = $db->Select("properties","planid","tel={$_GET[recplan]}");
	$row = $db->Select("plans","price","id='{$_GET[recplan]}'");
	//echo $db->cmd;
	echo ($row[0]);
}


?>