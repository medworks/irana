<?php
	session_start();	
	//$_SESSION = array();
	include_once("./lib/jsmin.php");
	include("./lib/captcha/simple-php-captcha.php");	
	include_once("inc/header.php");
	//echo $_POST["cap"],"=",$_SESSION['captcha']['code'],"<br/>";
	$jsmsg="";
	if ($_POST["mark"]=="posting")
	{		
		if (strtolower($_POST["cap"])!=strtolower($_SESSION['captcha']['code']))
		{		

			//header('location:index.php');			
		}
		else
		{
			header('location:main.php?tel='.$_POST["tel"].'&do=ok');
		}
	}
	
	$_SESSION['captcha'] = simple_php_captcha();
	$capcha = strtolower($_SESSION['captcha']['code']);
	
$jsmsg =<<<cd
<script type='text/javascript'>
$(document).ready(function(){  
	  $('form#frmtel').submit(function(e) {
		if ($('#cap').val().toLowerCase() != '{$capcha}' )
		{
			alert('کد امنیتی را اشتباه وارد کرده اید!');
		//	window.location="index.php";
			e.preventDefault();
			//return false;
		}
	  });
		
	  });
</script>
cd;
$jsmsg = JSMin::minify($jsmsg);
?>
		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slider">
					<div id="slider" class="nivoSlider" style="display: block; position: relative; height: 350px;">
						<!-- <img src="images/slides/slide1.jpg" alt="" title="#htmlcaption" style="display: none;"> -->
						<!-- <img src="images/slides/slide2.jpg" alt="" style="display: none;"> -->
						<img src="images/slides/slide3.jpg" alt="" title="#htmlcaption2" style="display: none;"> 
					</div>
					<div class="loader" style="display: none;"></div>
				</div>
				<div class="container_gamma slogan" style="background-color:#DE5328">
					<div class="search">
						<form id="frmtel" name="frmtel" action="" method="POST">
							<input type="text" id="tel" autocomplete="off" onpaste="return false" name="tel" style="color:#000;width:220px;height:25px;font-size:25px;line-height:32px;margin-right:5px"  class="ltr" placeholder="5138555560"  maxlength="10"  onkeypress="return isNumber(event);">
							<input type="text" id="cap" name="cap" style="color:#000;width:150px;height:25px;font-size:25px;line-height:32px;margin-right:5px"  class="ltr" placeholder="کد امنیتی"  maxlength="6"  >
							<img id="captcha" src=<?php echo $_SESSION['captcha']['image_src'] ?> style="width:150px;height:47px;float:left;margin-right:5px;border-radius:5px"  alt="کد امنیتی" />
							<input type="submit" name="submit" value="مرحله بعد" style="color:#000;width:100px;height:47px;font-size:25px;"/>
							<input type="hidden" name="mark" value="posting" />
						</form>
					</div>
					<h2 class="rtl" style="margin-top:8px;text-shadow:none;color:#000">
						شماره خط:
					</h2>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<img src="images/info_button.png" style="width:75px" class="alignright" alt="irana attention" />
					<h1 class="rtl" style="font-size:18px;">
						تمامي كالاها و خدمات اين فروشگاه، حسب مورد داراي مجوزهاي لازم از مراجع مربوطه مي‌باشند و فعاليت‌هاي اين سايت تابع قوانين و مقررات جمهوري اسلامي ايران است.
					</h1>
				</div>
			</div>
			<!-- /True containers (keep the content inside containers!) -->
    	</div>
    	<div class="endmain png_bg"></div>
		<!-- /Main content alpha -->
		<script type='text/javascript'>
		function isNumber(evt) {	
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if ($('#tel').val()=="" && charCode == 48)
			{
				alert("لطفا کد را بدون صفر وارد نمایید");
				return false;
			}
			else
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			
			return true;
      }	
      
	  $(document).ready(function(){  
	  $('form#frmtel').submit(function(e) {
			if ($('#tel').val().length < 10)
			{
				alert('لطفا شماره تلفن را بصورت 10 رقم ثبت نمایید(5138555560)');
				e.preventDefault();
//				return false;
			}	 
	  });
		
	  });
  
	</script>
<?php

    echo $jsmsg;
	include_once("inc/footer.php");
?>