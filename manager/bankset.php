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
	
	
	$Bank_Terminal_ID = GetSettingValue('Bank_Terminal_ID',0);
	$Bank_User_Name = GetSettingValue('Bank_User_Name',0);
	$Bank_Pass_Word = GetSettingValue('Bank_Pass_Word',0);
	$SmsText = GetSettingValue('SmsText',0);
	
	
    if ($_POST["mark"]==editsetting)
	{
	    SetSettingValue("Bank_Terminal_ID",$_POST["Bank_Terminal_ID"]);		
		SetSettingValue("Bank_User_Name",$_POST["Bank_User_Name"]);
		SetSettingValue("Bank_Pass_Word",$_POST["Bank_Pass_Word"]);		
		header('location:bankset.php');
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
					    <p><span style="display:block;margin-bottom:5px;">ترمینال</span><input type="text" name="Bank_Terminal_ID" class="ltr" value="{$Bank_Terminal_ID}" /></p>
					    <p><span style="display:block;margin-bottom:5px;">نام کاربری</span><input type="text" name="Bank_User_Name" class="ltr" value="{$Bank_User_Name}" /></p>
						<p><span style="display:block;margin-bottom:5px;">رمز عبور</span><input type="password" name="Bank_Pass_Word" class="ltr" value="{$Bank_Pass_Word}" /></p>
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