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

if ($_POST['ResCode'] == "17") // when user click on cancel paying payment page
{
	header('location:index.php');
}

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
	<div id="msg"><p>عملیات پرداخت با موفقیت انجام شد</p></div>
cd;
}
else
if ($paymentdone==0)
{	
$msg=<<<cd
	<div id="msg"><p>عملیات پرداخت با مشکل مواجه شد</p></div>
cd;
}
$html=<<<cd
	<style>
		.inner_main input[type=submit]{
			width:10%;
			height:45px;
			font-size:17px;
			color:#000;
		}
		.inner_main p{
			font-size:18px;
		}
		.inner_main p span{
			color:#000;
		}
		#msg p{
			color:#DE5328;
		}
	</style>
		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main" style="min-height:380px;">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slogan">
					<h1>مشخصات پرداخت</h1>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<form id="frmpay" runat="server" method="post" action="">
						<p>رفرنس: <span class="latin-font">{$_POST['RefId']}</span></p>
						<input type="hidden" name="RefId" value="{$_POST['RefId']}" />
						<p>کد سفارش: <span class="latin-font">{$_POST['SaleOrderId']}</span></p>
						<input type="hidden" name="SaleOrderId" value="{$_POST['SaleOrderId']}" />
						<p>کد پیگیری: <span class="latin-font">{$_POST['SaleReferenceId']}</span></p>
						<input type="hidden" name="SaleReferenceId" value="{$_POST['SaleReferenceId']}" />
						<p>{$confirmButton}</p>
    				</form>
    				{$msg}
				</div>
			</div>
		<!-- /Main content alpha -->
		</div>
		<div class="endmain png_bg"></div>
cd;

echo $html;
	include_once("inc/footer.php");


?>