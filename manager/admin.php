<?php
    include_once("inc/header.php");
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php");  
    include_once('../lib/sms/sms.class.php');	
	
	$login = Login::GetLogin();	
	$db = Database::GetDatabase();	
	
	$smsuser = GetSettingValue('SmsUserName',0);
	$smspass = GetSettingValue('SmsPassWord',0);
	$smslinenumber = GetSettingValue('SmsLineNumber',0);
	$smstext = GetSettingValue('SmsText',1);
	 
	$gate = new sms_soap($smsuser, $smspass);
	$smsbalance = $gate->GetUserBalance();
	
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); //solve security bug
	}	
	$mes = Message::GetMessage();
	if ($_GET["act"] == "logout")
   {
	   if ($login->LogOut())
			header("Location: ../index.php");
	   else
		    echo $mes->ShowError("عملیات خروج با خطا مواجه شد، لطفا مجددا سعی نمایید.");
   }
   
   if ($_GET['act']=="del")
  {
	  $db->Delete("orders"," id",$_GET["oid"]);		
	  if ($_GET["state"]=="ord")	
		header("location:admin.php?act=ord");	
	 else	
	    header("location:admin.php?act=confirmed");	
  }	
  if ($_GET['act']=="confirm")
  {
	 $values = array("`status`"=>"'2'");
     $db->UpdateQuery("orders",$values,array("id='{$_GET[oid]}'"));		

     $row = $db->Select("orders","*","id ='{$_GET[oid]}'");
	 $mobile = $db->Select("properties","mobile","id ='{$row[propid]}'");
	 $tel = $db->Select("properties","tel","id ='{$row[propid]}'");
	 $user = $db->Select("properties","fullname","id ='{$row[propid]}'");
	 $mobile = $mobile[0];		
	 if ($row[kind]==0)
	 {
		$orderinfo = "شارژ ".$row[gig]." GB";
	 }
	 else
	 if ($row[kind]==1)
	 {
	    $plan = $db->Select("plans","pname","id ='{$row[planid]}'");
		$orderinfo = "تمدید طرح ".$plan[0];
	 }
	 else
	 if ($row[kind]==2)
	 {
	    $plan = $db->Select("plans","pname","id ='{$row[planid]}'");
		$orderinfo = "تغییر طرح به ".$plan[0];
	 }
	// if ($smsbalance > 10 )
	 // {
	 
	 if (isset($mobile) and (strlen($mobile)==11))
	 {
		$smstext = str_replace("{user}", $user[0], $smstext);
		$smstext = str_replace("{tel}", $tel[0], $smstext);	 
		$smstext = str_replace("{order_info}", $orderinfo, $smstext);	 
		$rep =  $gate->SendSMS("{$smstext}","{$smslinenumber}","{$mobile}", 'normal');	 
	 }	 
	 
	 if ($_GET["act"]=="ord")	
		header("location:admin.php?act=ord");	
	 else	
	    header("location:admin.php?act=confirmed&oid={$_GET[oid]}");	
  }	
	
	if ($_GET["act"]=="ord")
    { 	
		$where = "Status = 1 AND paystatus = 1";
		$title = "لیست سفارشات";
		$titr = " <th style='width:55px'><a href='#'>عملیات</a></th> ";	
	}	
	else	
	if ($_GET["act"]=="confirmed")	
	{
		$where = "Status = 2 AND paystatus = 1";
		$title = "لیست  تایید شده";
		$titr  = "";
		
	    //header("location:admin.php?act=confirmed");
	}	
	
$html=<<<cd
    <!-- Main Section -->
	
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                   {$title}
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
cd;

$rows = $db->SelectAll("orders","*",$where,"id Desc");
$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	  
			<th style="width:60px"><a href="#">تاریخ سفارش</a></th>		
            <th><a href="#">نام مشتری</a></th>
			<th style="width:68px"><a href="#">تلفن</a></th>
			<th style="width:68px"><a href="#">موبایل</a></th>
			<th style="width:150px"><a href="#">ایمیل</a></th>
			<th style="width:35px"><a href="#">نوع سفارش</a></th>
            <th><a href="#">نام طرح</a></th>            
            <th style="width:35px"><a href="#">وضعیت سفارش</a></th>
			<th style="width:35px"><a href="#">وضعیت پرداخت</a></th>
			<!-- <th style="width:20px"><a href="#">حجم</a></th>  -->
			{$titr}
        </tr>
    </thead>
	<tbody style="display: none;">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["orderdate"] = ToJalali($rows[$i]["orderdate"]," l d F  Y ");
  
 $tel = $db->Select("properties","tel","id = ".$rows[$i]["propid"])[0];
 $mobile = $db->Select("properties","mobile","id = ".$rows[$i]["propid"])[0];
 $email = $db->Select("properties","email","id = ".$rows[$i]["propid"])[0];
 $rows[$i]["propid"] = $db->Select("properties","fullname","id = ".$rows[$i]["propid"])[0]; 
 
 $rows[$i]["planid"] = $db->Select("plans","pname","id = ".$rows[$i]["planid"])[0];
 
 if($rows[$i]["kind"]==0)
 {
	$rows[$i]["kind"] = "شارژ حساب";
	$rows[$i]["planid"] = $rows[$i]["gig"]."GB"; 
 }
 else
 if ($rows[$i]["kind"]==1) 
	$rows[$i]["kind"] = "تمدید حساب فعلی";
 else	
 if ($rows[$i]["kind"]==2) 
	$rows[$i]["kind"] = "تغییر حساب"; 
else	
 if ($rows[$i]["kind"]==3) 	
	$rows[$i]["kind"] = "سفارش طرح"; 
	
if ($rows[$i]["status"]==1) 
	$rows[$i]["status"] = "تایید نشده";
else	
	$rows[$i]["status"] = "تایید شده";

if ($rows[$i]["paystatus"]==1)
	$rows[$i]["paystatus"] = "پرداخت شده";
else
	$rows[$i]["paystatus"] = "معلق";	
	
	
if (($i+1)%11 == 0)	
	$table.=<<<cd
	</tbody>
		<tbody style="display: table-row-group;">
cd;

$table .=<<<cd
        <tr>		
		    <td>{$rows[$i]["orderdate"]}</td>
            <td>{$rows[$i]["propid"]}</td>
			<td>{$tel}</td>			
			<td>{$mobile}</td>			
			<td style="font-size:12px;">{$email}</td>
			<td>{$rows[$i]["kind"]}</td>
            <td>{$rows[$i]["planid"]}</td>
            <td>{$rows[$i]["status"]}</td>
			<td>{$rows[$i]["paystatus"]}</td>
            <!-- <td>{$rows[$i]["gig"]}</td>  -->
cd;
if ($_GET["act"]=="ord")
{
$table.=<<<cd
		<td>
                <ul class="action-buttons">
                    <li><a href="?act=confirm&state=ord&oid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
                    <li><a id="del" href="?act=del&state=ord&oid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="bin"></span></a></li>
                </ul>
        </td>
cd;
}
$table .= "</tr>";
}
$table.="</tbody> </table>";

$html.=<<<cd
                    {$table}
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->
	
<script type='text/javascript'>
		$(document).ready(function(){	
		  $("span.bin").click(function() 
		  {
				if(confirm("از حذف این رکورد مطمئن هستید؟"))
				{					
				}
				else
				{
					return false;
				}
		  });
	    });
		</script>	
		
cd;
  echo $html;
  include_once("inc/footer.php")
?>