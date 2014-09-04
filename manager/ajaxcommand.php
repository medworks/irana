<?php
	include_once("../config.php");
	include_once("../classes/session.php");
    include_once("../classes/database.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");	
	include_once("../lib/class.phpmailer.php");
	include_once('../lib/sms/sms.class.php');
	
	$sess = Session::GetSesstion();
	$db = Database::GetDatabase();

 
 if (isset($_GET["planid"]))
{   
    //$Extra_Tax = GetSettingValue('Extra_Tax',0);
    $row = array();
	$db->cmd = " SELECT *,(SELECT `value` FROM settings
				 WHERE `key` = 'Extra_Tax')* price/100+price as tax FROM plans
				 WHERE id ={$_GET[planid]}";
	$res = $db->RunSQL();    
    if ($res)
	    $row =  mysqli_fetch_array($res);
	//$row = $db->Select("plans","*","id={$_GET[planid]}");
	//$row[6]=$row[6]+($row[6]*($Extra_Tax/100));	
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
	//$Percent_Off = GetSettingValue('Percent_Off',0);	
	$Percent_Off = $db->Select("volumes","percent","`tvol`='5'");
	echo $Percent_Off[0],"%";
}
if (isset($_GET["kind"]) and ($_GET["kind"]=="percent2"))
{   
	//$Percent_Off = GetSettingValue('Percent_Off',0);		
	$Percent_Off = $db->Select("volumes","percent","`tvol`='5'");
	echo $Percent_Off[0];
}
      
	  $Extra_Tax = GetSettingValue('Extra_Tax',0);	
      $gig = $_GET["gig"];
	  $volprice1 = $db->Select("volumes","price","`tvol`='5'");
	  $volprice2 = $db->Select("volumes","price","`tvol`='10'");
	  $volprice3 = $db->Select("volumes","price","`tvol`='99'");
	  $Percent_Off = $db->Select("volumes","percent","`tvol`='5'");
	  $rows = array();
 if (isset($_GET["gig"]))
{         
      
	  $num =(int)($gig / 5);
	  if ($num == 0) 
	  {
		 $price = ($gig*$volprice1[0]); 
		 $price = $price+($price*($Extra_Tax/100));
		 $prcprice = $price- (($price*$Percent_Off[0])/100);
		 //$rows=array("0"=>$Percent_Off,"1"=>$price,"2"=>$prcprice);
		 //$rows=array($Percent_Off,$price,$prcprice);
		 $rows[0] = $Percent_Off[0];
		 $rows[1] = $price;
		 $rows[2] = $prcprice;
	  }	 
	  else
      if ($num ==1)
      {
		$price = 5*$volprice1[0];
		$price = $price +($gig % 5)*$volprice2[0];
		$price = $price+($price*($Extra_Tax/100));
		$prcprice = $price- (($price*$Percent_Off[0])/100);
		//$rows=array($Percent_Off,$price,$prcprice);
		$rows[0] = $Percent_Off[0];
		$rows[1] = $price;
		$rows[2] = $prcprice;
      }
      else	
      if ($num >= 2)	  
	  {
	    $price = 5*$volprice1[0];
		$price = $price + (5 * $volprice2[0]);
		$price = $price + ($gig - 10)*$volprice3[0];
		$price = $price+($price*($Extra_Tax/100));
		$prcprice = $price- (($price*$Percent_Off[0])/100);
		//$rows=array($Percent_Off,$price,$prcprice);
		$rows[0] = $Percent_Off[0];
		$rows[1] = $price;
		$rows[2] = $prcprice;
	  }
    //setlocale(LC_MONETARY, 'fa-IR');
	//echo money_format("%i", $price);
	//$pattern = "/(\d)(?=(\d\d\d)+(?!\d))/";
	//echo preg_replace($pattern,"$1,", $price);
	//echo $volprice1[0];
	echo json_encode($rows);
}

if($_GET["contact"]=="reg"){

	$admin = GetSettingValue('Contact_Email',0);

	$name    = $_POST['name'];
	$email   = $_POST['email'];
	$text = $_POST['comments'];
    $subject = "contact";
	$message = $text;

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

if($_GET["order_infos"]=="send"){
//============================ SMS Login =========================
    $smsuser = GetSettingValue('SmsUserName',0);
	$smspass = GetSettingValue('SmsPassWord',0);
	$smslinenumber = GetSettingValue('SmsLineNumber',0);
	$smstext = GetSettingValue('SmsText',1);
	 
	$gate = new sms_soap($smsuser, $smspass);
	$smsbalance = $gate->GetUserBalance();
//=================================================================
    $person_id = $_GET["pid"];//$sess->Get("person_id");
	$order_id =$sess->Get("order_id");
		
	$Contact_Email = GetSettingValue('Contact_Email',0);
	$Email_Text = GetSettingValue('Email_Text',0);	
	
	$order_infos = $db->Select("orders","*","id ='{$order_id}'");	
	if ($order_infos["kind"]==0)
	{
		$order_info = " شارژ (*".$order_infos["gig"]." GB )*";
	}
	else
	if ($order_infos["kind"]==1)
	 {
	    $plan = $db->Select("plans","pname","id ='{$order_infos[planid]}'");
		$orderinfo = "تمدید طرح ".$plan[0];
	 }
	 else
	 if ($row["kind"]==2)
	 {
	    $plan = $db->Select("plans","pname","id ='{$order_infos[planid]}'");
		$orderinfo = "تغییر طرح به ".$plan[0];
	 }
	 else
	 if ($row["kind"]==3)
	 {
	    $plan = $db->Select("plans","pname","id ='{$order_infos[planid]}'");
		$orderinfo = "سفارش طرح ".$plan[0];
	 }
	
	
	$peigiri_code = $db->Select("payment","pegiri","oid ='{$order_id}'");	
	
	$mobile = $db->Select("properties","mobile","id ='{$person_id}'");	
	$tel = $db->Select("properties","tel","id ='{$person_id}'");
	$user = $db->Select("properties","fullname","id ='{$person_id}'");
	$email = $db->Select("properties","email","id ='{$person_id}'");
	$tel = $tel[0];
	$user = $user[0];
	$email = $email[0];
	$mobile = $mobile[0];
	$Email_Text = str_replace("{user}", $user, $Email_Text);
	$Email_Text = str_replace("{tel}", $tel, $Email_Text);
	$Email_Text = str_replace("{mobile}", $mobile, $Email_Text);
	$Email_Text = str_replace("{order_info}", $order_info, $Email_Text);
	$today = ToJalali(date("Y-m-d")," l d F  Y ");
	$Email_Text = str_replace("{date}", $today, $Email_Text);
	$Email_Text = str_replace("{payment_code}", $peigiri_code[0], $Email_Text);

	$name    = "گروه بازرگانی ایرانا";
    $subject = "رسید سفارش";
	$message = $Email_Text;
 //   echo $db->cmd," ",$person_id," ",$name," ",$email," ",$subject," ",$message;
	/*
	//if( strlen($name)>=1 && checkEmail($email[0]) && strlen($message)>=1 )
	//{
		if(@mail($email,$subject,$message,"From:$name $Contact_Email"))
		{
			echo "<div class='notification_ok rtl medium'>فاکتور خردید شما به ایمیلتان ارسال شد</div>";

		}else{
			echo "<div class='notification_error rtl'>خطا در ارسال فاکتور!</div>";

		}
	//}else{
	//	echo "<div class='notification_error rtl'>خطا! لطفا فیلدها را بررسی نمایید و مجددا ارسال کنید!</div>";
	//}
     */
	 $issend=SendEmail($Contact_Email,"گروه بازرگانی ایرانا", array($email), "رسید سفارش", $message);
	 if ($issend)
		echo "<div class='notification_ok rtl medium'>فاکتور خرید به ایمیلتان ارسال شد</div>";
	 else
		echo "<div class='notification_error rtl'>خطا در ارسال فاکتور!</div>";
//====================================== Send SMS =========================
	if (isset($mobile) and (strlen($mobile)==11))
	 {
		$smstext = str_replace("{user}", $user, $smstext);
		$smstext = str_replace("{tel}", $tel, $smstext);	 
		$smstext = str_replace("{order_info}", $$order_info, $smstext);	 
		$rep =  $gate->SendSMS("{$smstext}","{$smslinenumber}","{$mobile}", 'normal');	 
	 }	 
	 
	
}

?>