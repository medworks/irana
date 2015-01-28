<?php
	session_start();
	include_once("config.php");
	include_once("classes/session.php");
	
	//$sess = Session::GetSesstion();	
	
    include_once("classes/database.php");
    include_once("classes/messages.php");
	include_once("lib/persiandate.php");
	include_once("lib/class.phpmailer.php");
	include_once("classes/functions.php");
	
	$db = Database::GetDatabase();
	
	
$paymentdone = -1;	
$javas = "";
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
	//$maxid = $db->MaxOfAll("id","orders");
	//$order_id = $sess->Get("order_id");
	//$order_id = $_SESSION["order_id"];
	$saleorder = $_POST['SaleOrderId'];
	$row = $db->Select("orders", "*", "selorder = "."'{$saleorder}'");
	$order_id = $row["id"];
	$order = $db->Select("orders", "*", "id = "."'{$order_id}'");	
	//echo $db->cmd;
	//$person = $db->Select("properties", "*", "id = "."'{$order[propid]}'");	
	//$db->Delete("orders"," Id",$order_id);
	$values = array("`remove`"=>"'1'");
    $db->UpdateQuery("orders",$values,array("id='{$order_id}'"));	
	
	$oldMax = $db->MaxOf("id","orders","propid='{$order[propid]}' AND remove = 0 ");	
	$oldplan = $db->Select("orders", "planid", "id = "."'{$oldMax}'");		
	
	$values = array("`planid`"=>"'{$oldplan[0]}'");
	$db->UpdateQuery("properties",$values,array("id='{$order[propid]}'"));
	
	header('location:index.php');
}	
//if ($_POST["mark"]=="savepay")
//{
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
			$ResCode = $ressettle[0];
			if ($ResCodesettle == "0" Or $ResCodesettle=="45") 
			{
				$paymentdone=1;
				$saleorder = $_POST['SaleOrderId'];
				$row = $db->Select("orders", "*", "selorder = "."'{$saleorder}'");	
				//$person_id = $_SESSION["person_id"];
				$person_id = $row["propid"];
				
$javas=<<<cd
		<script type='text/javascript'>
		 $(document).ready(function(){		 
		 $.get('manager/ajaxcommand.php?order_infos=send&pid={$person_id}',function(data) {		     
				   $('#msg2').html(data);			
				});
		});
		</script>
cd;

			}
			else
			{
				$paymentdone=0;
				$result = $client->bpReversalRequest($parameters, $namespace);
			}
		} 
		else 
		{
			$paymentdone=0;
			$result = $client->bpReversalRequest($parameters, $namespace);			
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
					"`errcode`"=>"'{$_POST['ResCode']} - {$ResCode}'",
					"`confirm`"=>"'{$paymentdone}'");
    //$id = $db->MaxOfAll("id", "payment");
	//$id = $sess->Get("payment_id");
	//$id = $_SESSION["payment_id"];
	$saleorder = $_POST['SaleOrderId'];
    $db->UpdateQuery("payment",$values,array("selorder='{$saleorder}'"));
	
	//$order_id = $sess->Get("order_id");
	//$order_id = $_SESSION["order_id"];
	$saleorder = $_POST['SaleOrderId'];
	$row = $db->Select("orders", "*", "selorder = "."'{$saleorder}'");
	$order_id = $row["id"];
    $fields = array("`oid`","`refid`","`pegiri`","`selorder`","`regdate`","`errcode`","`confirm`");		
	$values = array("'{$order_id}'","'{$_POST[RefId]}'","'{$_POST[SaleReferenceId]}'","'{$_POST[SaleOrderId]}'","'{$date}'","'{$_POST[ResCode]} - {$ResCode}'","'{$paymentdone}'");
    $db->InsertQuery('debtpayment',$fields,$values);	
//}	
$msg = "";
if ($paymentdone==1)
{		
//$order_id = $sess->Get("order_id");				
//$order_id = $_SESSION["order_id"];
	$saleorder = $_POST['SaleOrderId'];
	$row = $db->Select("orders", "*", "selorder = "."'{$saleorder}'");
	$order_id = $row["id"];
	$values = array("`paystatus`"=>"'1'");
	$db->UpdateQuery("orders",$values,array("id='{$order_id}'"));

$msg=<<<cd
	<div id="msg"><p>عملیات پرداخت با موفقیت انجام شد</p></div>
cd;
}
else
if ($paymentdone == 0 or $paymentdone == -1)
{	
$msg=<<<cd
	<div id="msg"><p>عملیات پرداخت با مشکل مواجه شد</p></div>
cd;
}
include_once("inc/header.php");
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
		#msg p,
		#msg2{
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
						<p>رسید دیجیتال بانکی: <span class="latin-font">{$_POST['RefId']}</span></p>
						<input type="hidden" name="RefId" value="{$_POST['RefId']}" />
						<p>کد سفارش: <span class="latin-font">{$_POST['SaleOrderId']}</span></p>
						<input type="hidden" name="SaleOrderId" value="{$_POST['SaleOrderId']}" />
						<p>کد پیگیری: <span class="latin-font">{$_POST['SaleReferenceId']}</span></p>
						<input type="hidden" name="SaleReferenceId" value="{$_POST['SaleReferenceId']}" />
						<p>{$confirmButton}</p>
    				</form>
    				{$msg}
					<p id='msg2'></p>
				</div>
			</div>
		<!-- /Main content alpha -->
		</div>
		<div class="endmain png_bg"></div>
		{$javas}
cd;

echo $html;
//echo "email ->",$issend;
	include_once("inc/footer.php");
?>