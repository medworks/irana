<?php
	include_once("inc/header.php");
	
	include_once("config.php");
    include_once("classes/database.php");
    include_once("classes/messages.php");
	include_once("classes/functions.php");
	include_once("/lib/persiandate.php");
  
    $db = Database::GetDatabase();
	$msg = Message::GetMessage();
	
	$Contact_Email = GetSettingValue('Contact_Email',0);				
	$Tell_Number = GetSettingValue('Tell_Number',0);
	$Fax_Number = GetSettingValue('Fax_Number',0);
	$Address = GetSettingValue('Address',0);
	
$html =<<<cd

<script>	
		$(document).ready(function(){
			$("#frmcontact").submit(function(){               
			    $.ajax({
				    type: "POST",
				    url: "./manager/ajaxcommand.php?contact=reg",
				    data: $("#frmcontact").serialize(),
					    success: function(msg)
						{
							$("#note-contact").ajaxComplete(function(event, request, settings){				
								$(this).hide();
								$(this).html(msg).slideDown("slow");
								$(this).html(msg);
							});
						}
			    });
				return false;
			});
		});
	</script>
		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slogan">
					<h1>تماس با ما</h1>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<div class="gs_4">
						<p style="font-size:17px;">
							<strong>ایمیل:</strong> <a href="mailto:{$Contact_Email}">{$Contact_Email}</a>
						</p>
					</div>
					<div class="gs_4">
						<p style="font-size:17px;">
							<strong>تلفن:</strong><span class="ltr" style="display:inline-block"> 051-{$Tell_Number}</span>
							<br><strong>فاکس:</strong><span class="ltr" style="display:inline-block"> 051-{$Fax_Number}</span><br><strong>
						</p>
					</div>
					<div class="gs_4 omega">
						<p style="font-size:17px;">
							<strong>آدرس:</strong><br>{$Address}
						</p>
					</div>
					<div class="hr"></div>
					<div class="gs_6 omega" style="margin-left:15px;padding-left:17px">
						<h3>تماس با ما</h3>
						<!-- Contact form starts -->
						<form method="post" action="" id="frmcontact">
							<div id="form_container">		
								<div id="form_main">
									<input type="text" name="name" id="name" placeholder="نام و نام خانوادگی" title="Name">
									<input type="text" name="email" id="email" placeholder="ایمیل" title="Email">
									<textarea name="comments" id="comments" rows="4" cols="4" placeholder="پیام" placeholder="Message"></textarea>
									<p>
										<input type="submit" name="submit1" id="submit1" value="ارسال!" class="superbutton">
										<!-- <img src="images/ajax-loader.gif" class="loaderIcon" alt="Loading..." style="display: none;"> -->
									</p>
									<ul id="form_response">
										<li></li>
									</ul>
								</div>
							</div>
						</form>
						<div class="clear"></div>
						<div id="note-contact" style="font-size:22px;color:#DE5328"></div>
					</div>
					<!-- Contact form Ends -->
					<div class="gs_6 omega">
						<h3>آدرس ما</h3>
						<div class="add_border" style="width: 428px;">
						<img src="images/map.png" alt="" class="border_magic" style="display: block;"></div>
					</div>
					<div class="clearfix"></div>
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
  	