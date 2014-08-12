<?php
	include_once("inc/header.php");
	
	include_once("config.php");
    include_once("classes/database.php");
    include_once("classes/messages.php");
	include_once("classes/functions.php");
	include_once("/lib/persiandate.php");
  
    $db = Database::GetDatabase();
	$msg = Message::GetMessage();
	$isclientexist = false;
	$row = $db->Select("properties", "*", "tel = "."'{$_GET[tel]}'");	
	if ($row)
	{	  
	  $isclientexist = true;
	  $plan = $db->Select("plans", "*", "id = "."'{$row["planid"]}'");	
	  $plangig = $plan[gig]*$plan[month];
	  //echo $db->cmd;
	  $plancode = " <h5 style='margin-bottom:10px;'>طرح فعلی  : <b>{$plan[pname]}</b></h5>";
	}
	
	$plans = $db->SelectAll("plans","*",NULL,"ID");	
	$cbplans = DbSelectOptionTag("cbplans",$plans,"pname",NULL,NULL,NULL,"width:220px;height:28px;border-radius:8px;color:#b24824");
	
	
	if ($_POST["mark"] =="order" )
	{
	   $date = date('Y-m-d H:i:s');	
	   //ToJalali($rows[$i]["regdate"]," l d F  Y ");
	   
	   if (!$isclientexist)
	   {
			$fields = array("`fullname`","`tel`","`mobile`","`email`","`planid`");	
			$values = array("'{$_POST[fullname]}'","'{$_GET[tel]}'","'{$_POST[mobile]}'","'{$_POST[email]}'","{$_POST["cbplans"]}");	
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
		
		$fields = array("`propid`","`planid`","`orderdate`","`kind`","`status`","`gig`");	
			
		if ($_POST["plan"] =="sharg")
		{
			$planid = -1;
			$kind = 0;
			$giga = $_POST["gigabyte"];
		}
		else
		if ($_POST["plan"] =="tamdid")
		{
			$planid = -1;
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
		
		$values = array("'{$lastid}'","'{$planid}'","'{$date}'","'{$kind}'","'1'","'{$giga}'");
		
		$db->InsertQuery('orders',$fields,$values);
	   
	}
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
					<form name="frmorder" id="frmorder"action="" method="post">
					<h5>شماره خط : <b>{$_GET['tel']}</b></h5>
					{$plancode}
					<div style="direction:rtl">
							<strong style="font-size:18px;padding:0 5px 5px;display:block">نام و نام خانوادگی</strong><input name="fullname" style="width:30%;font-size:15px;color:#000;" type="text" placeholder="نام و نام خانوادگی" value="{$row[fullname]}">
							<strong style="font-size:18px;padding:0 5px 5px;display:block">شماره همراه</strong><input name="mobile" style="width:30%;font-size:15px;color:#000;" class="ltr latin-font" type="text" placeholder="09123456789" value="{$row[mobile]}">
							<strong style="font-size:18px;padding:0 5px px;display:block">ایمیل</strong><input name="email" style="width:30%;font-size:15px;color:#000;" class="ltr" type="text" placeholder="name@domain.com" value="{$row[email]}">													
					</div>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<h3>
						2) مشترک گرامی در صورت انتخاب گزینه تمدید، طرح درخواستی شما از زمان پرداخت فعال شده و میزان حجم و زمان به مانده قبلی شما اضافه خواهد شد، در غیر اینصورت از گزینه شارژ استفاده نمایید.
					</h3></br>					
					<div class="action" name="selector" id="selector" style="direction:rtl;width:150px;float:right">							
						<strong style="font-size:18px;padding:0 5px 15px;float:right">شارژ حساب</strong><input style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0;" type="radio" checked name="plan" value="sharg">
						<p class="clear"></p>
						<strong style="font-size:18px;padding:0 5px 15px;float:right">تمدید حساب فعلی</strong><input style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0" class="ltr latin-font" type="radio" name="plan" value="tamdid">
						<p class="clear"></p>
						<strong style="font-size:18px;padding:0 5px 15px;float:right">تغییر حساب</strong><input style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0" class="ltr" type="radio" name="plan" value="taghir">	
					</div>

					<script>
						$(document).ready(function(){
							$('div.action input').click(function(){
							//alert("test")
								var cureentAct= $(this).val();
								$(".toggler div.act").css("display","none");
								if (cureentAct=="sharg"){
									$(".toggler #sharg").css('display',"block");
									$('#price').html("0");
								}
								if (cureentAct=="tamdid"){
									$(".toggler #tamdid").css('display',"block");
									$.get('manager/ajaxcommand.php?recplan={$row[planid]}',function(data) {
						               $('#price').html(data);
				                    });								
								}
								if (cureentAct=="taghir"){
									$(".toggler #taghir").css('display',"block");
									$('#price').html("0");
								}
							});
						});
					</script>
					<div class="toggler open" style="direction:rtl;width:700px;float:left;padding-bottom:70px;">
						<div style="float:right;width:550px;">
							<!-- Sharj hesab -->
							<div id="sharg" class='act'>
								<h3>شارژ حساب</h3>						
									<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">حجم به گیگابایت (بین 1 تا 99)</strong><input name="gigabyte" id="gigabyte" style="width:30%;font-size:15px;color:#000" class="ltr latin-font" type="text" placeholder="1-99" maxlength="2"  onkeypress="return isNumber(event);">
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
									<h3>مبلغ قابل پرداخت</h3>
									<h2 id="price" style="font-size:26px;margin-top:5px">0</h2>
									<strong style="font-size:23px;margin-right:53px;display:inline-block;margin-top:10px">ریال</strong>
									<div class="specs" style="margin-top:25px"><p style="font-size:18px;margin-top:10px;">هزینه سرویس</p><p style="font-size:18px;">5000 تومان</p></div>
									<div class="specs"><p style="font-size:18px;padding-top:10px;">5% تخفیف</p></div>
									<div class="specs"><p style="font-size:18px"><img src="images/check.png" alt=""> مبلغ قابل پرداخت</p><p style="font-size:18px">0 ریال</p></div>
									<div class="buyme" style="margin-right:30px"><p><a href="#" onclick ="javascript:submitform();" style="font-size:18px" class="superbutton">پرداخت</a></p></div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			   <input type='hidden' name='mark' value='order' />
			</form>
			<!-- /True containers (keep the content inside containers!) -->
    	</div>
    	<div class="endmain png_bg"></div>
		<!-- /Main content alpha -->
	<script type="text/javascript">
		function submitform()
		{
		  document.getElementById("frmorder").submit();
		}
	</script>
	<script type='text/javascript'>
		$(document).ready(function(){
			
			$( "#gigabyte" ).keyup(function() {
			  var volgig = $('#gigabyte').val()			 
				$.get('manager/ajaxcommand.php?gig= '+$('#gigabyte').val(),function(data) {
						$('#price').html(data);
				  });	
			});
		
			$("#cbplans").change(function(){			   
			    $.ajax({
				type: "GET",
				url: "manager/ajaxcommand.php",
				data: 'planid=' + $(this).val(),
				dataType: "json",
				success: function (data) {				    
					$('#gig').html(data[3]*data[2]+" گیگابایت ");
					$('#month').html(data[2]+" ماهه ");
					$('#price').html(data[5]);
				}
			        });
			});	
			
			
			
		
    });
	
	function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
	</script>
  	<!--! end of #container -->
cd;
    echo $html;
	include_once("inc/footer.php");
?>
  	