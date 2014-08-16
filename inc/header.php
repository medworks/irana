<?php
    header('Content-Type: text/html; charset=UTF-8');
	include_once("./config.php");
	include_once("./classes/database.php");
	include_once("./classes/functions.php");
	
	$Site_Title = GetSettingValue('Site_Title',0);
	$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
	$Site_Describtion = GetSettingValue('Site_Describtion',0);
	$Contact_Email = GetSettingValue('Contact_Email',0);				
	$Tell_Number = GetSettingValue('Tell_Number',0);	
?>
<!doctype html>

<!--[if lt IE 7 ]> <html lang="fa" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="fa" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="fa" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="fa" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<html lang="fa" class="no-js"><!--<![endif]--><head>
	<title><?php echo $Site_Title?></title>
	<meta charset="utf-8">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
	   Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="author" content="Mediateq.ir">
	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
	<meta http-equiv="Content-Language"  content="Fa">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<!-- CSS : implied media="all" -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/rainbow.css" type="text/css">
	
  	<script src="js/jquery.min.js"></script>
	
</head>
<body>
  	<div id="container">
		<!-- Header -->
	    <div id="header">
			<div id="logo">
				<!-- <img src="images/logo.png" alt=""> -->
				<h1 style="color:#DE5328;text-shadow:2px 1px 2px #DE5328">گروه بازرگانی ایرانا<span>نماینده رسمی تمدید و ثبت محصولات مخابرات</h1>
			</div>
			<div id="personal_data">
				<p>تلفن: <span style="display:inline-block;direction:ltr !important"><?php echo $Tell_Number?></span></p>
				<p>ایمیل: <span><a href="mailto:info@irana.ir" class="latin-font"><?php echo $Contact_Email?></a></span></p>
			</div>
		</div>
		<div id="menu" class="png_bg ltr">
			<ul>
				<li>
					<a href="index.html">صفحه اصلی</a>
				</li>
				<li>
					<a href="aboutus.html" class="">درباره ما</a>
				</li>
				<li>
					<a href="price.html" class="">تعرفه ها</a>
				</li>
				<li>
					<a href="contact.html">تماس با ما</a>
				</li>
			</ul>
		</div>
		<div class="clear"></div>
    	<!-- /Header -->