<?php
	include_once("inc/header.php");
	
	include_once("config.php");
    include_once("classes/database.php");
    include_once("classes/messages.php");
	include_once("classes/functions.php");
	include_once("/lib/persiandate.php");

$paymentdone = -1;	
$confirmButton =<<<cd
<tr class="HeaderTr">
	<td colspan="2" align="center">
		<input type="submit" name="Verify" value="تایید پرداخت"/>
		<input type="hidden" name="mark" value="savepay"/>
	</td>
 </tr>
cd;
if ($_POST["mark"]=="savepay")
{
	$confirmButton = "";
	if($_POST['ResCode']==0)
	{
	try 
	{ 
		$client = new SoapClient('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
	} 
	catch (Exception $e) 
	{ 
		die($e->getMessage()); 
	} 

	$namespace='http://interfaces.core.sw.bps.com/';

	$terminalId =  GetSettingValue('Bank_Terminal_ID',1);
	$userName =  GetSettingValue('Bank_User_Name',1);
	$userPassword =  GetSettingValue('Bank_Pass_Word',1);


	$parameters = array(
	'terminalId' => $terminalId,
	'userName' => $userName,
	'userPassword' => $userPassword,
	'orderId' => $_POST['SaleOrderId'],
	'saleOrderId' => $_POST['SaleOrderId'],
	'saleReferenceId' => $_POST['SaleReferenceId']);

	$result = $client->bpVerifyRequest($parameters, $namespace);

	$array = get_object_vars($result);
	$resultStr = $array["return"];

	$res = explode (',',$resultStr);
	if(is_array($res))
	{	
		$ResCode = $res[0];
		if ($ResCode == "0") 
		{			
			$resultsettle = $client->bpSettleRequest($parameters, $namespace);
			$array = get_object_vars($result);
			$resultStr = $array["return"];
			$ressettle = explode (',',$resultStr);
			$ResCodesettle = $ressettle[0];
			if ($ResCodesettle == "0") 
			{
				$paymentdone=1;
			}
			else
			{
				$paymentdone=0;
			}
		} 
		else 
		{
			$paymentdone=0;
			// log error in app
			// Update table, log the error
			// Show proper message to user
		}
	}
}
	
	
	$db = Database::GetDatabase();
	//$lastid = $db->InsertId();	
	$date = date('Y-m-d H:i:s');				 
	$values = array("`refid`"=>"'{$_POST['RefId']}'",
					"`pegiri`"=>"'{$_POST['SaleReferenceId']}'",
	                "`selorder`"=>"'{$_POST['SaleOrderId']}'",
					"`regdate`"=>"'{$date}'",
					"`errcode`"=>"'{$_POST['ResCode']}'",
					"`confirm`"=>"'{$paymentdone}'");
    $id = $db->MaxOfAll("id", "payment");
    $db->UpdateQuery("payment",$values,array("id='{$id}'"));		
}	
$msg = "";
if ($paymentdone==1)
{		
$msg=<<<cd
<div id="msg">عملیات پرداخت با موفقیت انجام شد</div>
cd;
}
else
if ($paymentdone==0)
{	
$msg=<<<cd
 <div id="msg">عملیات پرداخت با مشکل مواجه شد</div>
cd;
}
$html=<<<cd

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>پرداخت هزینه </title>
    <link href="Css/Style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <form id="frmpay" runat="server" method="post" action="">
    <table width="100%" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td>
                <table class="MainTable" cellspacing="5" cellpadding="1" align="center">
                    <tr class="HeaderTr">
                        <td colspan="2" align="center" height="25">
                            <span class="HeaderText">مشخصات پرداخت</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>رفرنس</span>
                        </td>
                        <td>
                            <span>{$_POST['RefId']}</span>
							<input type="hidden" name="RefId" value="{$_POST['RefId']}" />
                        </td>
                    </tr>                    
                    <tr>
                        <td class="LabelTd">
                            <span>کد سفارش</span>
                        </td>
                        <td>
                            <span>{$_POST['SaleOrderId']}</span>
							<input type="hidden" name="SaleOrderId" value="{$_POST['SaleOrderId']}" />
                        </td>
                    </tr>
                    <tr>
                        <td class="LabelTd">
                            <span>کد پیگیری</span>
                        </td>
                        <td>
                            <span>{$_POST['SaleReferenceId']}</span>
							<input type="hidden" name="SaleReferenceId" value="{$_POST['SaleReferenceId']}" />
                        </td>
                    </tr>
					{$confirmButton}
                </table>
				
            </td>
        </tr>
    </table>
	{$msg}
    </form>
</body>
</html>	
cd;

echo $html;

?>	

