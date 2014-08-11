<?php
	include_once("inc/header.php");
	
	include_once("config.php");
    include_once("classes/database.php");
    include_once("classes/messages.php");
	include_once("classes/functions.php");
	include_once("/lib/persiandate.php");
  
    $db = Database::GetDatabase();
	$msg = Message::GetMessage();
$html =<<<cd
		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slogan">
					<h1>درباره ما</h1>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<h2 style="font-size:20px;">گروه بازرگانی ایرانا فعال در زمینه</h2>
				</div>
			</div>
		</div>
		<!-- /True containers (keep the content inside containers!) -->
    	<div class="endmain png_bg"></div>
		<!-- /Main content alpha -->
	
cd;
    echo $html;
	include_once("inc/footer.php");
?>
  	