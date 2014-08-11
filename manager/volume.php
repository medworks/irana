<?php 
    include_once("inc/header.php");
	include_once("../config.php");
	include_once("../classes/functions.php");
	include_once("../classes/database.php");	
	include_once("../classes/messages.php");	
	include_once("../lib/persiandate.php");	
	include_once("../classes/session.php");	
	include_once("../classes/login.php");
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	 {
		header("Location: ../index.php");
		die(); // solve a security bug
	 }
	$db = Database::GetDatabase();
    
    if ($_POST["mark"]=="savevol")
	{	      
		$fields = array("`fvol`","`tvol`","`price`","`percent`");		
		$values = array("'{$_POST[fvol]}'","'{$_POST[tvol]}'","'{$_POST[price]}'","'{$_POST[percent]}'");
		
		if (!$db->InsertQuery('volumes',$fields,$values)) 
		{			
			header('location:volume.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:volume.php?act=new&msg=1');												
		}  				 
	}
	else
	if ($_POST["mark"]=="editvol")
	{			    
		$values = array("`fvol`"=>"'{$_POST[fvol]}'",
		                 "`tvol`"=>"'{$_POST[tvol]}'",
						 "`price`"=>"'{$_POST[price]}'",
						 "`percent`"=>"'{$_POST[percent]}'");
        $db->UpdateQuery("volumes",$values,array("id='{$_GET[vid]}'"));		
		header('location:volume.php?act=edit&msg=2');
	}	
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ثبت'/></p>
						<input type='hidden' name='mark' value='savevol' />  ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("plans","*","id='{$_GET["pid"]}'",NULL);
		$nightchecked=($row['night'])?"checked":"";
		$modemchecked=($row['modem'])?"checked":"";
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ویرایش'/></p>
						<input type='hidden' name='mark' value='editvol' />  ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("volumes"," id",$_GET["vid"]);		
		header('location:volume.php');	
	}	
//$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                    تعرفه حجم ها
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
					<form class="plans" action="" method="post">
                        <p><span>از حجم</span><input type="text" name="fvol" placeholder="از حجم"/></p>
                        <p><span>تا حجم</span><input type="text" name="tvol" placeholder="تا حجم"/></p>
                        <p><span>قیمت (ریال)</span><input type="text" name="price" placeholder="قیمت (ریال)"/></p>
                        <p><span>درصد تخفیف</span><input type="text" name="percent" placeholder="1-100"/></p>
						{$insertoredit}
					</form>
                    <div class="clear"></div>
                    <hr>
cd;

$html.=<<<cd
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->
cd;
echo $html;
include_once("inc/footer.php");
?>