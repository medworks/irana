<?php 	
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
	
	if ($_POST["mark"]==editsetting)
	{
	    SetSettingValue("Extra_Tax",$_POST["extratax"]);
		SetSettingValue("Email_Text",$_POST["emailtext"]);
		SetSettingValue("About_System",$_POST["about"]);		
		SetSettingValue("Site_Title",$_POST["title"]);
		SetSettingValue("Site_KeyWords",$_POST["keywords"]);
		SetSettingValue("Site_Describtion",$_POST["detail"]);
		SetSettingValue("Contact_Email",$_POST["email"]);
		SetSettingValue("Tell_Number",$_POST["tel"]);
		SetSettingValue("Fax_Number",$_POST["fax"]);
		SetSettingValue("Address",$_POST["address"]);
		SetSettingValue("Is_Send_Order_Sms_For_Admin",$_POST["Is_Send_Order_Sms_For_Admin"]);
		SetSettingValue("Admin_Mobile_Number",$_POST["Admin_Mobile_Number"]);
				
		header('location:setting.php');
	}
	
    $Extra_Tax = GetSettingValue('Extra_Tax',0);
	$Email_Text = GetSettingValue('Email_Text',0);
	$About_System = GetSettingValue('About_System',0);
	$Site_Title = GetSettingValue('Site_Title',0);
	$Site_KeyWords = GetSettingValue('Site_KeyWords',0);
	$Site_Describtion = GetSettingValue('Site_Describtion',0);
	$Contact_Email = GetSettingValue('Contact_Email',0);
	$Tell_Number = GetSettingValue('Tell_Number',0);
	$Fax_Number = GetSettingValue('Fax_Number',0);
	$Address = GetSettingValue('Address',0);	
	$Is_Send_Order_Sms_For_Admin = GetSettingValue('Is_Send_Order_Sms_For_Admin',0);
	$Admin_Mobile_Number = GetSettingValue('Admin_Mobile_Number',0);
	$Is_Send_Order_Sms_For_Admin_Ok=($Is_Send_Order_Sms_For_Admin==1)?"checked":"";
	
	
$html=<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                    تنظیمات
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
					<form class="setting" action="" method="post">
					     <p style="padding-top:10px"><span>ارسال اس ام اس سفارش برای مدیریت</span><input type="checkbox" name="Is_Send_Order_Sms_For_Admin" value="1" {$Is_Send_Order_Sms_For_Admin_Ok}/></p>
					     <p><span style="display:block;margin-bottom:5px;"> شماره موبایل مدیریت جهت دریافت اس ام اس سفارش</span><input class="ltr" type="text" name="Admin_Mobile_Number" placeholder="091 ..." value="{$Admin_Mobile_Number}" /></p>
					    <p><span style="display:block;margin-bottom:5px;">مالیات بر ارزش افزوده (درصد)</span><input type="text" name="extratax" placeholder="1-100" value="{$Extra_Tax}" /></p>
						<p><span style="display:block;margin-bottom:5px;">متن تایدیه ایمیل </span><textarea name="emailtext">{$Email_Text}</textarea></p>
						<p><span style="display:block;margin-bottom:5px;">درباره ما</span><textarea name="about">{$About_System}</textarea></p>
                        <p><span>عنوان سایت</span><input type="text" name="title" placeholder="عنوان سایت" value="{$Site_Title}" /></p>
                        <p><span>کلمات کلیدی</span><input type="text" name="keywords" style="width:450px" placeholder="کلمات کلیدی" value="{$Site_KeyWords}" /></p>
                        <p><span>توضیحات سایت در موتورهای جستجو</span><input type="text" name="detail" style="width:500px" placeholder="توضیحات سایت در موتورهای جستجو" value="{$Site_Describtion}" /></p>
						<p><span>ایمیل</span><input type="text" name="email" class="ltr" style="width:250px" placeholder="name@domain.com" value="{$Contact_Email}" /></p>
						<p><span>تلفن</span><input type="text" name="tel" class="ltr" placeholder="51-38555560" value="{$Tell_Number}" /></p>
                        <p><span>فاکس</span><input type="text" name="fax" class="ltr" placeholder="51-38555560" value="{$Fax_Number}" /></p>
                        <p><span style="display:block;margin-bottom:5px;">آدرس</span><textarea name="address">{$Address}</textarea></p>
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
include_once("inc/header.php"); 
echo $html;
include_once("inc/footer.php"); 
?>