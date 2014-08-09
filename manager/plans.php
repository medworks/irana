<?php 
	include_once("inc/header.php");
    
	//ob_start(); 	
	//$table = include_once("inc/table.php");
	//ob_end_clean();

if ($_POST["mark"]=="saveplan")
	{						   				
		$fields = array("`pname`","`month`","`gig`","`night`","`modem`","`price`","`percent`");		
		$values = array("'{$_POST[plan]}'","'{$_POST[month]}'","'{$_POST[volume]}'",
						"'{$_POST[night]}'","'{$_POST[modem]}'","'{$_POST[price]}'","'{$_POST[percent]}'");	
		if (!$db->InsertQuery('plans',$fields,$values)) 
		{			
			header('location:plans.html?msg=2');
		} 	
		else 
		{  										
			header('location:plans.html?msg=1');									
		}  				 
	}
	else
	if ($_POST["mark"]=="editplan")
	{		
	    $_POST["detail"] = addslashes($_POST["detail"]);
		$values = array("`pname`"=>"'{$_POST[plan]}'",
		                 "`month`"=>"'{$_POST[month]}'",
						 "`gig`"=>"'{$_POST[volume]}'",
						 "`night`"=>"'{$_POST[night]}'",
						 "`modem`"=>"'{$_POST[modem]}'",
						 "`price`"=>"'{$_POST[price]}'",
						 "`percent`"=>"'{$_POST[percent]}'");
        $db->UpdateQuery("plans",$values,array("id='{$_GET[pid]}'"));		
		header('location:plans.html?msg=2');
	}	
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ثبت'/></p>
						<input type='hidden' name='mark' value='saveplan' />  ";
	}
	if ($_GET['act']=="edit")
	{
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ویرایش'/></p>
						<input type='hidden' name='mark' value='saveplan' />  ";
	}

$html =<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                    تعرفه طرح ها
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
					<form class="plans">
						<p><span>نام طرح</span><input type="text" name="plan" placeholder="طلایی - 3 گیگابایت - 3 ماهه" /></p>
						<p><span>مدت زمان (ماه)</span><input type="text" name="month" placeholder="1-12"/></p>
						<p><span>حجم (گیگابایت)</span><input type="text" name="volume" placeholder="1-99"/></p>
						<p style="padding-top:10px"><span>شبانه دارد</span><input type="checkbox" name="night" value="" /></p>
						<p style="padding-top:10px"><span>مودم دارد</span><input type="checkbox" name="modem" value="" /></p>
						<p class="clear"></p>
                        <p><span>درصد تخفیف</span><input type="text" name="percent" placeholder="1-100" /></p>
						{$insertoredit}						
					</form>
                    <div class="clear"></div>
                    <hr>
cd;
echo $html;
include_once("inc/table.php");
$html=<<<cd
                    {$table}
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->
cd;
echo $html;
include_once("inc/footer.php"); 
?>