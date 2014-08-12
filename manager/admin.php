<?php
    include_once("inc/header.php");
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php");  	
	
	$login = Login::GetLogin();	
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); //solve security bug
	}	
	$mes = Message::GetMessage();
	if ($_GET["act"] == "logout")
   {
	   if ($login->LogOut())
			header("Location: ../index.php");
	   else
		    echo $mes->ShowError("عملیات خروج با خطا مواجه شد، لطفا مجددا سعی نمایید.");
   }
	
?>
    
    <!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                   لیست سفارشات
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
                    <?php include_once('inc/table.php') ?>
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->
        
<?php
    include_once("inc/footer.php")
?>