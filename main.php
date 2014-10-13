<?php
	include_once("config.php");
	include_once("classes/session.php");
    include_once("classes/database.php");
    include_once("classes/messages.php");
	include_once("classes/functions.php");	
	include_once("lib/persiandate.php");
	include_once("./lib/jsmin.php");
    
	$sess = Session::GetSesstion();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	include_once("inc/header.php");	
	
	$isclientexist = false;	
	$javas="";
$postform=<<<cd
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
			
	</script>
cd;
$postform = JSMin::minify($postform);	
echo $postform;

	if ($_GET["act"]=="neword")
	{
		$tel4neword = "  <strong style='font-size:18px;padding:0 5px 5px;display:block'>".
		              " تلفن </strong><input name='tel' style='width:30%;font-size:18px;color:#000;background-color:#ddd' type='text' placeholder='تلفن' /> ";
		$tel = $_POST["tel"];
		
		$kind = 3; // order from price page
		$giga =0; // order from price page
		$planid = $_GET["planid"]; // order from price page
		
		$javas =<<<cd
		<script type='text/javascript'>
		$(document).ready(function(){
		  $("#rbsharj").removeAttr('checked');
		  $("#rbtamdid").removeAttr('checked');
		  $("#rbtaghir").attr('checked', 'checked');
          $(".toggler div.act").css("display","none");		  
          $(".toggler #taghir").css('display',"block");		  
		  $("input[id='rbsharj']").attr('disabled',true);
		  $("input[id='rbtamdid']").attr('disabled',true);
		  $("#cbplans").val({$_GET[planid]});
		  $("#cbplans").change(function(){	
		        				
			    $.ajax({
				type: "GET",
				url: "manager/ajaxcommand.php",
				data: 'planid= {$_GET[planid]}',
				dataType: "json",
				success: function (data) {				    		            
					$('#gig').html(data[3]*data[2]+" گیگابایت ");
					$('#month').html(data[2]+" ماهه ");	
					$('#percent').html(data[7].toString()+" % ");
					
					$('#price').html(data[11].replace(/\B(?=(\d{3})+(?!\d))/g, ','));
														
					toman = data[11] - ((data[11]*data[7])/100);
					$('#lastprice').html(toman.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
					$('input[name=orderprice]').val(toman.toString());
				}
			        });
										
			});	
			$("#cbplans").change();
		});
		</script>
cd;
	}
	//else
	//{
		if ($_GET["act"]=="neword")
		{
			$tel = $_POST["tel"]; 
			$plancode ="";
		}	
		else	
			$tel = $_GET["tel"]; 
		
		//$javas="";
		$row=NULL;
        if (isset($tel))
		   $row = $db->Select("properties", "*", "tel = "."'{$tel}'");	
		//echo $db->cmd;
		if ($row)
		{	  
		  $isclientexist = true;
		  $plan = $db->Select("plans", "*", "id = "."'{$row["planid"]}'");	
		  $plangig = $plan[gig]*$plan[month];
		  //echo $db->cmd;
		  $plancode = " <h5 style='margin-bottom:10px;'>طرح فعلی  : <b>{$plan[pname]}</b></h5>";
		}
		else
		{ $row["planid"]= -1; $plancode = "";}
	//}
	
	$plans = $db->SelectAll("plans","*",NULL,"ID");	
	$cbplans = DbSelectOptionTag("cbplans",$plans,"pname",NULL,NULL,NULL,"width:220px;height:28px;border-radius:8px;color:#b24824");
		
	if ($_POST["mark"] =="order" )
	{
	   $date = date('Y-m-d H:i:s');	
	   	   
	   if (!$isclientexist)
	   {
			$fields = array("`fullname`","`tel`","`mobile`","`email`","`planid`");	
			$values = array("'{$_POST[fullname]}'","'{$tel}'","'{$_POST[mobile]}'","'{$_POST[email]}'","{$_POST["cbplans"]}");	
			if ($db->InsertQuery('properties',$fields,$values)) 
			{		    
				$lastid = $db->InsertId();
				$msgs = $msg->ShowSuccess("ثبت اطلاعات با موفقیت انجام شد");		
			} 	
			else 
			{  	
				$msgs = $msg->ShowError("ثبت اطلاعات با مشکل مواجه شد");							
			}
	   }
       else
	     $lastid = $row["id"];
		 
		 $sess->Set("person_id",$lastid);		
			
		if ($_POST["plan"] =="sharg")
		{
			$planid =$row["planid"];
			$kind = 0;
			$giga = $_POST["gigabyte"];
		}
		else
		if ($_POST["plan"] =="tamdid")
		{
			$planid = $row["planid"];
			$kind = 1;
			$giga = 0;
		}	
		else	
		if ($_POST["plan"] =="taghir")
		{
			$planid=$_POST["cbplans"];
			$kind = 2;
			$giga = 0;
			// change recent plan -------------------------------------------------
			if ($isclientexist)
			{
				$values = array("`planid`"=>"'{$planid}'");		
				$db->UpdateQuery("properties",$values,array("id='{$row["id"]}'"));
			}	
			//---------------------------------------------------------------------
		}		
		if ($_GET["act"]=="neword")
		{
			$kind = 3; // order from price page
			$giga =0; // order from price page
			$planid = $_GET["planid"]; // order from price page
		}
		
		// kind noe sefaresh -> sharj, tamdid,taghir, sefaresh
		// status -> default is 1,when confirm updated to 2
		$fields = array("`propid`","`planid`","`orderdate`","`kind`","`status`","`gig`","`price`");	 
		$values = array("'{$lastid}'","'{$planid}'","'{$date}'","'{$kind}'","'1'","'{$giga}'","'{$_POST[orderprice]}'");
		
		$db->InsertQuery('orders',$fields,$values);
		//echo $db->cmd;
		$lastid = $db->InsertId();
		
		$sess->Set("order_id",$lastid);
		
// pay here ==================
	try 
	{ 
		$client = new soapclient('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
	} 
	catch (Exception $e) 
	{ 
		die($e->getMessage()); 
	}	

	$now = getdate();
	$now["mon"] =  ($now["mon"]<10)?"0".$now["mon"] :$now["mon"];
	$todaydate = $now["year"].$now["mon"].$now["mday"];
	$todaytime = $now["hours"].$now["minutes"].$now["seconds"];	
	
	$terminalId =  GetSettingValue('Bank_Terminal_ID',1);
	$userName =  GetSettingValue('Bank_User_Name',1);
	$userPassword =  GetSettingValue('Bank_Pass_Word',1);
	$orderId = rand() * time();//uniqid(rand(), false);		
	$amount = $_POST['orderprice'];				
	$localDate = $todaydate;
	$localTime = $todaytime;
	$additionalData = "خدمات اینترنت مخابرات";
	$callBackUrl = "http://www.ir2020.ir/callback.php";
	$payerId = 0;
	//echo "price is  ",$_POST['orderprice'];
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
	//var_dump($result);
	$array = get_object_vars($result);
	$resultStr = $array["return"];
	$res = explode (',',$resultStr);	
	
	if(is_array($res))
	{	
		$ResCode = $res[0];
		if ($ResCode == "0") 
		{
			$date = date('Y-m-d H:i:s');
			//$lastid = $db->InsertId();
			$order_id =$sess->Get("order_id");
			
			$fields = array("`oid`","`refid`","`regdate`","`errcode`");		
			$values = array("'{$order_id}'","'{$res[1]}'","'{$date}'","'{$ResCode}'");	
			if (!$db->InsertQuery('payment',$fields,$values)) 
			{			
			//header('location:payment.php');			
			} 	
			else 
			{  										
			//	header('location:payment.php');
				$lastid = $db->InsertId();		
				$sess->Set("payment_id",$lastid);
			}  		
			// Update table, Save RefId
			echo "<script language='javascript' type='text/javascript'>postRefId('" . $res[1] . "');</script>";
		} 
		else 
		{
			// log error in app						
		}
	}
	
	
	//header('location:main.php');			   
	}

$Extra_Tax = GetSettingValue('Extra_Tax',0);

$js =<<<cd
<script type="text/javascript">
						$(document).ready(function(){
							$('div.action input').click(function(){
								var cureentAct= $(this).val();
								$(".toggler div.act").css("display","none");
								if (cureentAct=="sharg"){
									$(".toggler #sharg").css('display',"block");
									//$("#rbsharj").removeAttr('checked');
									$("#rbtamdid").removeAttr('checked');
									$("#rbtaghir").removeAttr('checked');
									$('#price').html("0");
								    $('#lastprice').html("0");
									$('input[name=orderprice]').val("0");
									$.get('manager/ajaxcommand.php?kind=percent',function(data) {
						               $('#percent').html(data);
				                    });									 
								}
								if (cureentAct=="tamdid"){
								$("#rbsharj").removeAttr('checked');
								//$("#rbtamdid").removeAttr('checked');
								$("#rbtaghir").removeAttr('checked');
									$(".toggler #tamdid").css('display',"block");
								$('#price').html("0");
								$('#lastprice').html("0");
								$.ajax({
									type: "GET",
									url: "manager/ajaxcommand.php",
									data: 'planid= {$row[planid]}',
									dataType: "json",
									success: function (data) {				    
											  $('#percent').html(data[7].toString()+" % ");
   										      $('#price').html(data[11].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
											  toman = data[11] - ((data[11]*data[7])/100);				
											  $('#lastprice').html(toman.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
											  $('input[name=orderprice]').val(toman.toString());
									}
										});									
								}
								if (cureentAct=="taghir"){
								    $("#rbsharj").removeAttr('checked');
									$("#rbtamdid").removeAttr('checked');
									//$("#rbtaghir").removeAttr('checked');
									$(".toggler #taghir").css('display',"block");
									$('#price').html("0");
									$('input[name=orderprice]').val("0");
									$('#lastprice').html("0");
									//	$.get('manager/ajaxcommand.php?kind=percent',function(data) {
						         //      $('#percent').html(data);
				                  //  });
								}
							});
						});
					</script>	
cd;

$js_minifiyed_part1 = JSMin::minify($js);	

$js=<<<cd
<script type="text/javascript">
		function submitform()
		{
		  if($('#fullname').val() == '')
		  {
			alert('لطفا نام خود را وارد نمایید');
			return false;
		  }
		  if($('#mobile').val() == '')
		  {
			alert('لطفا شماره موبایل خود را وارد نمایید');
			return false;
		  }
		  if($('#email').val() == '')
		  {
			alert('لطفا ایمیل خود را وارد نمایید');
			return false;
		  }
		  if($('#tel').val() == '')
		  {
			alert('لطفا شماره تلفن خود را وارد نمایید');
			return false;
		  }
		  	  		
		if ($("input[name='plan']#rbtamdid").is(":checked"))
		{
			if ($("span#recplanname").text()=="")
			{
				alert('نام طرح خالی است، لطفا از گزینه تغییر حساب استفاده نمایید');
				return false;
			}
        }
		else
		if ($("input[name='plan']#rbsharj").is(":checked"))
		{
			
			if ($("#gigabyte").val()=="")
			{				
				alert('لطفا مقدار حجم را وارد نمایید!');
				return false;
			}
        }
		else
		if ($("input[name='plan']#rbtaghir").is(":checked"))
		{
			
			if ($("#cbplans").val()=="-1")
			{				
				alert('لطفا از لیست  طرح مورد نظر را انتخاب نمایید');
				return false;
			}
        }
	
		  
          $("#gigabyte").keyup();
		  document.getElementById("frmorder").submit();
		}
		function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }		
	</script>
	
	<script type='text/javascript'>
		$(document).ready(function(){
			var toman;
            var nodot;		
            var retdata			
			$( "#gigabyte" ).keyup(function() {			
			$.ajax({
				type: "GET",
				url: "manager/ajaxcommand.php",
				data: 'gig=' + $('#gigabyte').val()	,
				dataType: "json",
				success: function (data) {		
				 //retdata = jQuery.parseJSON(data);                   
					$('#percent').html(data[0].toString()+" % ");
					
					$('#price').html(data[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
																			
					$('#lastprice').html(data[2].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));					
					$('#lastprice').html(data[2].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));					
					$('input[name=orderprice]').val(data[2].toString());
				}
			        });

			});
		       $("#gigabyte").keyup();
			   
			$("#cbplans").change(function(){	
               	if ($(this).val() != -1)
				{
					$.ajax({
					type: "GET",
					url: "manager/ajaxcommand.php",
					data: 'planid=' + $(this).val(),
					dataType: "json",
					success: function (data) {				    
						$('#gig').html(data[3]*data[2]+" گیگابایت ");
						$('#month').html(data[2]+" ماهه ");	
						$('#percent').html(data[7].toString()+" % ");
						
						$('#price').html(data[11].replace(/\B(?=(\d{3})+(?!\d))/g, ','));				
											
						toman = data[11] - ((data[11]*data[7])/100);
						$('#lastprice').html(toman.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
						$('input[name=orderprice]').val(toman.toString());
					}
						});
				}	
										
			});	
			$("#cbplans").change();
				
    });
	
	
	</script>
cd;

$js_minifiyed_part2 = JSMin::minify($js);

$javas = JSMin::minify($javas);

$html =<<<cd
		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slogan">
					<h1>شارژ و تمدید حساب</h1>
				</div>
				<div class="container_gamma slogan">
				<div name="message">
					{$msgs}
				</div>
					<h3>
						1) لطفاً ایمیل و تلفن همراه معتبر وارد نمائید. در صورت پرداخت بصورت اینترنتی، اطلاعات خرید به این ایمیل و تلفن ارسال می شود.
					</h3></br>
					<style>
					 h5 b{
						font-size:20px;
						font-weight:normal;
					 }
					</style>
					<form name="frmorder" id="frmorder"action="" method="post">
					<h5>شماره خط : <b>{$_GET['tel']}</b></h5>
					{$plancode}
					<div style="direction:rtl">
					        {$tel4neword}
							<strong style="font-size:18px;padding:0 5px 5px;display:block">نام و نام خانوادگی</strong><input id="fullname" name="fullname" style="width:30%;font-size:18px;color:#000;background-color:#ddd" type="text" placeholder="نام و نام خانوادگی" value="{$row[fullname]}">
							<strong style="font-size:18px;padding:0 5px 5px;display:block">شماره همراه</strong><input id="mobile" name="mobile" style="width:30%;font-size:18px;color:#000;background-color:#ddd" class="ltr latin-font" type="text" placeholder="09123456789" maxlength="11" value="{$row[mobile]}" onkeypress="return isNumber(event);">
							<strong style="font-size:18px;padding:0 5px px;display:block">ایمیل</strong><input id="email" name="email" style="width:30%;font-size:18px;color:#000;background-color:#ddd" class="ltr latin-font" type="text" placeholder="name@domain.com" value="{$row[email]}">													
					</div>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<h3>
						2) مشترک گرامی در صورت انتخاب گزینه تمدید، طرح درخواستی شما از زمان پرداخت فعال شده و میزان حجم و زمان به مانده قبلی شما اضافه خواهد شد، در غیر اینصورت از گزینه شارژ استفاده نمایید.
					</h3></br>					
					<div class="action" name="selector" id="selector" style="direction:rtl;width:150px;float:right">							
						<strong  style="font-size:18px;padding:0 5px 15px;float:right">شارژ حساب</strong><input id="rbsharj"  style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0;" type="radio" checked name="plan" value="sharg">
						<p class="clear"></p>
						<strong  style="font-size:18px;padding:0 5px 15px;float:right">تمدید حساب فعلی</strong><input id="rbtamdid"  style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0" class="ltr latin-font" type="radio" name="plan" value="tamdid">
						<p class="clear"></p>
						<strong  style="font-size:18px;padding:0 5px 15px;float:right">تغییر حساب</strong><input id="rbtaghir"  style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0" class="ltr" type="radio" name="plan" value="taghir">	
					</div>
					{$js_minifiyed_part1}						
					<div class="toggler open" style="direction:rtl;width:700px;float:left;padding-bottom:70px;">
						<div style="float:right;width:550px;">
							<!-- Sharj hesab -->
							<div id="sharg" class='act'>
								<h3>شارژ حساب</h3>						
									<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">حجم به گیگابایت (بین 1 تا 99)</strong>
									<input name="gigabyte" id="gigabyte" style="width:30%;font-size:15px;color:#000" class="ltr latin-font" type="text" placeholder="1-99" maxlength="2"  onkeypress="return isNumber(event);">
							</div>
							<!-- tamdid hesab feli -->
							<div id="tamdid" class='act activity'>
								<h3>تمدید حساب فعلی</h3>								
								<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">طرح: <span id="recplanname" style="color:#b24824">{$plan[pname]}</span></strong>
								<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">حجم: <span id="recplangig" style="color:#b24824">{$plangig} گیگابایت</span></strong>
								<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">زمان: <span id="recplanmonth"style="color:#b24824">{$plan[month]} ماهه</span></strong>							
							</div>
							<!-- taghir hesab -->
							<div id="taghir" class='act activity'>
								<h3>تغییر حساب</h3>		
									<strong style="font-size:18px;padding:0 5px 5px;display:inline-block;color:#000">طرح: </strong>
										{$cbplans}
									<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">حجم: <span style="color:#b24824" id="gig">0 گیگابایت</span></strong>
									<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">زمان: <span style="color:#b24824" id="month">0 ماهه</span></strong>
							</div>
							<h4>پرداخت اینترنتی از طریق کلیه کارت های عضو شبکه شتاب امکان پذیر می باشد.</h4>
							<ul class="banks">
								<li><a title="بانک کشاورزی"><img src="images/banks/bankkeshavarzi.png" alt="بانک کشاورزی" /></a></li>
								<li><a title="بانک ملی"><img src="images/banks/bank-melli.png" alt="بانک ملی"  /></a></li>
								<li><a title="بانک پاسارگاد"><img src="images/banks/bankpasargad.png" alt="بانک پاسارگاد" /></a></li>
								<li><a title="بانک توسعه صادرات"><img src="images/banks/bank-tose-saderat.png" alt="توسعه صادرات"  /></a></li>
								<li><a title="بانک اقتصاد نوین"><img src="images/banks/enbank.png" alt="بانک اقتصاد نوین" /></a></li>
								<li><a title="بانک ملت"><img src="images/banks/mellat.png" alt="بانک ملت" /></a></li>
								<li><a title="بانک پارسیان"><img src="images/banks/parsian.png" alt="بانک پارسیان" /></a></li>
								<li><a title="بانک صادرات"><img src="images/banks/saderat.png" alt="بانک صادرات" /></a></li>
								<li><a title="بانک سامان"><img src="images/banks/saman.png" alt="بانک سامان" /></a></li>
								<li><a title="بانک صنعت و معدن"><img src="images/banks/sanato-maedan.png" alt="بانک صنعت و معدن" /></a></li>
								<li><a title="بانک سینا"><img src="images/banks/sina.png" alt="بانک سینا" /></a></li>
							</ul>
							<div class="clear"></div>
							<h3 style="color:#b24824">تذکر:</h3>
							<h4 style="margin-bottom:10px">1-کاربر گرامی با توجه به اینکه شارژ خریداری شده بلافاصله به حساب شما اضافه شده و قابل استفاده خواهد بود، امکان برگشت خرید انجام شده وجود ندارد.</h4>
							<h4>2-کاربر گرامی قیمت ارائه شده مطابق مصوبات سازمان تنظیم مقررات ارتباطات رادیوئی و شرکت مخابرات ایران می باشد و تنها با ابلاغ مصوبه جدید از سوی سازمان مذکور تغییر خواهد کرد.</h4>
						</div>
						<div class="price">
							<div class="box">
								<div>
									<h3 style="padding-top:3px">هزینه سرویس</h3>
									<h2 id="price" style="font-size:26px;margin-top:20px">0</h2>
									<strong style="font-size:23px;margin-right:58px;display:inline-block;margin-top:-7px">ریال</strong>
									<div class="specs" style="padding-top:7px;"><p style="font-size:22px;display:inline-block;margin-right:38px;"> تخفیف </p><p id="percent" style="margin-top:17px;font-size:22px;padding-top:10px;display:inline-block;"> 0% </p></div>
								</div>
							</div>
							<div class="box1">
								<div>
									<h3>قابل پرداخت</h3>
									<h2 id="lastprice" name="lastprice" style="font-size:26px;margin-top:5px">0</h2>
									<strong style="font-size:23px;margin-right:59px;display:inline-block;margin-top:4px">ریال</strong>
								</div>
							</div>
							<div class="buyme" style="margin-right:33px"><p>
							<a href="javascript:void(0);" onclick ="javascript:submitform();" style="font-size:18px" class="superbutton">پرداخت</a></p></div>	
						</div>
					</div>
				</div>
			</div>
			   <input type='hidden' name='mark' value='order' />
			   <input type='hidden' name='orderprice' value='' />
			</form>
			<!-- /True containers (keep the content inside containers!) -->
    	</div>
    	<div class="endmain png_bg"></div>
		<!-- /Main content alpha -->
		
		{$javas} 
		{$js_minifiyed_part2}
	
  	<!--! end of #container -->	
cd;
    echo $html;
	include_once("inc/footer.php");
?>