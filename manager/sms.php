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
	$SmsText = GetSettingValue('SmsText',0);
	
    if ($_POST["mark"]==editsetting)
	{
	    SetSettingValue("SmsUserName",$_POST["smsuser"]);		
		SetSettingValue("SmsPassWord",$_POST["smspassword"]);		
		SetSettingValue("SmsText",$_POST["smstext"]);
		header('location:sms.php');
	}
$html=<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                    تنظیمات اس ام اس
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
					<form class="setting" action="" method="post">
					    <p><span style="display:block;margin-bottom:5px;">نام کاربری اس ام اس</span><input type="text" name="smsuser" placeholder="نام کاربری" value="{$SmsUserName}"  /></p>
					    <p><span style="display:block;margin-bottom:5px;">رمز عبور اس ام اس</span><input type="password" name="smspassword" placeholder="رمز عبور" value="{$SmsPassWord}" /></p>					    
						<p><span style="display:block;margin-bottom:5px;">متن پیام اس ام اس</span><textarea name="smstext">{$SmsText}</textarea></p>
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