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

 if (isset($_GET["gig"]))
{   
      $gig = $_GET["gig"];
	  $num =(int)($gig / 5);
	  if ($num == 0) 
	  {
		 $price = ($gig*3600); 
		 $price = $price+($price*0.08);
	  }	 
	  else
      if ($num ==1)
      {
		$price = 5*3600;
		$price = $price +($gig % 5)*2600;
		$price = $price+($price*0.08);
      }
      else	
      if ($num >= 2)	  
	  {
	    $price = 5*3600;
		$price = $price + (5 * 2600);
		$price = $price + ($gig - 10)*1600;
		$price = $price+($price*0.08);
	  }
  
	echo ($price);
}


?>