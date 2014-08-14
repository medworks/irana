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
{   	
	$row = $db->Select("plans","price","id='{$_GET[recplan]}'");	
	$row = ($row[0])?$row[0]:"0";
	echo ($row);
}

if (isset($_GET["kind"]) and ($_GET["kind"]=="percent"))
{   
	$Percent_Off = GetSettingValue('Percent_Off',0);	
	echo " تخفیف ",$Percent_Off," % ";
}
if (isset($_GET["kind"]) and ($_GET["kind"]=="percent2"))
{   
	$Percent_Off = GetSettingValue('Percent_Off',0);	
	echo $Percent_Off;
}

 if (isset($_GET["gig"]))
{         
      $gig = $_GET["gig"];
	  $num =(int)($gig / 5);
	  if ($num == 0) 
	  {
		 $price = ($gig*36000); 
		 $price = $price+($price*0.08);
	  }	 
	  else
      if ($num ==1)
      {
		$price = 5*36000;
		$price = $price +($gig % 5)*26000;
		$price = $price+($price*0.08);
      }
      else	
      if ($num >= 2)	  
	  {
	    $price = 5*36000;
		$price = $price + (5 * 26000);
		$price = $price + ($gig - 10)*16000;
		$price = $price+($price*0.08);
	  }
    //setlocale(LC_MONETARY, 'fa-IR');
	//echo money_format("%i", $price);
	$pattern = "/(\d)(?=(\d\d\d)+(?!\d))/";
	echo preg_replace($pattern,"$1,", $price);
}

if($_GET["contact"]=="reg"){

	$admin = GetSettingValue('Contact_Email',0);

	$name    = $_POST['name'];
	$email   = $_POST['email'];
	$text = $_POST['comments'];
    $subject = "contact"
	$message = "$text";

	if( strlen($name)>=1 && checkEmail($email) && strlen($text)>=1 ){
		if( @mail (
				$admin,
				"$subject",
				$message,
				"From:$name $email" )
		){
			echo "<div class='notification_ok rtl medium'>پیام شما با موفقیت ارسال شد.</div>";

		}else{
			echo "<div class='notification_error rtl'>خطا! پیام شما ارسال نشد لطفا مجددا تلاش نمایید.</div>";

		}
	}else{
		echo "<div class='notification_error rtl'>خطا! لطفا فیلدها را بررسی نمایید و مجددا ارسال کنید!</div>";
	}

}

?>