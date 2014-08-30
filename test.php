<?php
include_once("inc/header.php");
	
	include_once("config.php");
    
	require_once("./lib/soap/nusoap.php");	
$java=<<<cd
<html>
<body>
<script language='javascript' type='text/javascript'>
function postRefId (refIdValue) {
			var form = document.createElement("form");
			form.setAttribute("method", "POST");
			form.setAttribute("action", " https://bpm.shaparak.ir/pgwchannel/startpay.mellat");         
			form.setAttribute("target", "_self");
			var hiddenField = document.createElement("input");              
			hiddenField.setAttribute("name", "RefId");
			hiddenField.setAttribute("value", refIdValue);
			form.appendChild(hiddenField);

			document.body.appendChild(form);         
			form.submit();
			document.body.removeChild(form);
		}
		
	//postRefId("AB454241");
	</script>
	</body>
	</html>
cd;
echo $java;
// pay here ==================
try { 
$client = new soapclient('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
} catch (Exception $e) { 
die($e->getMessage()); 
}
//=================================================================================	
		$now = getdate();
		$now["mon"] =  ($now["mon"]<10)?"0".$now["mon"] :$now["mon"];
		$todaydate = $now["year"].$now["mon"].$now["mday"];
		$todaytime = $now["hours"].$now["minutes"].$now["seconds"];
		
		$terminalId = 1144896;
		$userName = 'irana';
		$userPassword = '41833070';
		$orderId = rand() * time();//uniqid(rand(), false);		
		$amount = 100;				
		$localDate = $todaydate;
		$localTime = $todaytime;
		$additionalData = "test";
		$callBackUrl = "http://www.ir2020.ir/main.php";
		$payerId = 0;
		$namespace='http://interfaces.core.sw.bps.com/';
		        
		$parameters = array(
			'terminalId' => $terminalId,
			'userName' => $userName,
			'userPassword' => $userPassword,
			'orderId' => $orderId,
			'amount' => $amount,
			'localDate' => $localDate,
			'localTime' => $localTime,
			'additionalData' => $additionalData,
			'callBackUrl' => $callBackUrl,
			'payerId' => $payerId);
	
    
$result =  $client->bpPayRequest($parameters,$namespace);

$array = get_object_vars($result);
$resultStr = $array["return"];
$res = explode (',',$resultStr);
echo "<br/> res is :",$array["return"];
	if(is_array($res))
	{

		//echo "<script>alert('Pay Response is : " . $resultStr . "');</script>";
		//echo "Pay Response is : " . $resultStr;
		$ResCode = $res[0];

		if ($ResCode == "0") 
		{
			// Update table, Save RefId
			echo "<script language='javascript' type='text/javascript'>postRefId('" . $res[1] . "');</script>";
		} 
		else 
		{
			// log error in app
			// Update table, log the error
			// Show proper message to user
			echo $res[0];
		}
	}
	
		
include_once("inc/footer.php");		
?>