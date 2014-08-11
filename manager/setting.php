<?php 
	include_once("inc/header.php"); 
	include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../lib/persiandate.php");	
	include_once("../classes/login.php");
	
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	 {
		header("Location: ../index.php");
		die(); // solve a security bug
	 }
	$db = Database::GetDatabase();
	if ($_POST["editsetting"])
	{
		SetSettingValue("About_System",$_POST["about"]);
		SetSettingValue("Site_Title",$_POST["title"]);
		SetSettingValue("Site_KeyWords",$_POST["keywords"]);
		SetSettingValue("Site_Describtion",$_POST["detail"]);
		SetSettingValue("Contact_Email",$_POST["email"]);
		SetSettingValue("Tell_Number",$_POST["tel"]);
		SetSettingValue("Fax_Number",$_POST["fax"]);
		SetSettingValue("Address",$_POST["Address"]);
	}
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
						<p><span style="display:block;margin-bottom:5px;">درباره ما</span><textarea name="about">درباره ما</textarea></p>
                        <p><span>عنوان سایت</span><input type="text" name="title" placeholder="عنوان سایت"/></p>
                        <p><span>کلمات کلیدی</span><input type="text" name="keywords" style="width:450px" placeholder="کلمات کلیدی"/></p>
                        <p><span>توضیحات سایت در موتورهای جستجو</span><input type="text" name="detail" style="width:500px" placeholder="توضیحات سایت در موتورهای جستجو"/></p>
						<p><span>ایمیل</span><input type="text" name="email" class="ltr" style="width:250px" placeholder="name@domain.com"/></p>
						<p><span>تلفن</span><input type="text" name="tel" class="ltr" placeholder="51-38555560"/></p>
                        <p><span>فاکس</span><input type="text" name="fax" class="ltr" placeholder="51-38555560" /></p>
                        <p><span style="display:block;margin-bottom:5px;">آدرس</span><textarea name="address">آدرس</textarea></p>
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