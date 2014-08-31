<?php 
	include_once("inc/header.php"); 
	include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	
	
	$SmsUserName = GetSettingValue('SmsUserName',0);
	$SmsPassWord = GetSettingValue('SmsPassWord',0);
	$SmsLineNumber = GetSettingValue('SmsLineNumber',0);
	$SmsText = GetSettingValue('SmsText',0);
	
	
    if ($_POST["mark"]==editsetting)
	{
	    SetSettingValue("SmsUserName",$_POST["smsuser"]);		
		SetSettingValue("SmsPassWord",$_POST["smspassword"]);
		SetSettingValue("SmsLineNumber",$_POST["smslinenumber"]);
		SetSettingValue("SmsText",$_POST["smstext"]);
		header('location:sms.php');
	}
$html=<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                    تنظیمات درگاه بانک
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
					<form class="setting" action="" method="post">
					    <p><span style="display:block;margin-bottom:5px;">ترمینال</span><input type="text" name="bankter" class="ltr" /></p>
					    <p><span style="display:block;margin-bottom:5px;">نام کاربری</span><input type="text" name="bankuser" class="ltr" /></p>
						<p><span style="display:block;margin-bottom:5px;">رمز عبور</span><input type="password" name="bankpass" class="ltr" /></p>
						<p><input type="submit" style="width:70px;height:35px" value="ثبت"/></p>
						<input type='hidden' name='mark' value='editsetting' />
					</form>
                    <div class="clear"></div>
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->
cd;
echo $html;
include_once("inc/footer.php"); 
?>