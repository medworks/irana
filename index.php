<?php
	include_once("inc/header.php");
?>
		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slider">
					<div id="slider" class="nivoSlider" style="display: block; position: relative; height: 350px;">
						<img src="images/slides/slide1.jpg" alt="" title="#htmlcaption" style="display: none;">
						<img src="images/slides/slide2.jpg" alt="" style="display: none;">
						<img src="images/slides/slide3.jpg" alt="" title="#htmlcaption2" style="display: none;">
						<img src="images/slides/slide4.jpg" alt="" style="display: none;">
						<img src="images/slides/slide5.jpg" alt="" style="display: none;">
						<img src="images/slides/slide6.jpg" alt="" style="display: none;">
					</div>
					<div class="loader" style="display: none;"></div>
				</div>
				<div class="container_gamma slogan">
					<div class="search">
						<form action="main.php" method="get">
							<input type="text" name="tel" style="color:#000;" id="tel" class="ltr latin-font" placeholder="5118555560">
						</form>
					</div>
					<h2 class="rtl">
						شماره خط مورد نظر خود را مانند شماره روبرو وارد نمایید و سپس اینتر نمایید:
					</h2>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<img src="images/info_button.png" class="alignright" alt="">
					<h1 class="rtl">
						تمامي كالاها و خدمات اين فروشگاه، حسب مورد داراي مجوزهاي لازم از مراجع مربوطه مي‌باشند و فعاليت‌هاي اين سايت تابع قوانين و مقررات جمهوري اسلامي ايران است.
					</h1>
				</div>
			</div>
			<!-- /True containers (keep the content inside containers!) -->
    	</div>
    	<div class="endmain png_bg"></div>
		<!-- /Main content alpha -->
<?php
	include_once("inc/footer.php");
?>