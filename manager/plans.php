<?php 	
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
    
	//ob_start(); 	
	//$table = include_once("inc/table.php");
	//ob_end_clean();


$night = isset($_POST["night"]);
$modem = isset($_POST["modem"]);
$special = isset($_POST["special"]);
$offer = isset($_POST["offer"]);

	if ($_POST["mark"]=="saveplan")
	{	      
		$fields = array("`pname`","`month`","`gig`","`night`","`modem`","`price`","`percent`","`special`","`position`","`hispecial`");
		$values = array("'{$_POST[plan]}'","'{$_POST[month]}'","'{$_POST[volume]}'","'{$night}'","'{$modem}'","'{$_POST[price]}'","'{$_POST[percent]}'","'{$special}'","'{$_POST[position]}'","'{$offer}'");	
		if (!$db->InsertQuery('plans',$fields,$values)) 
		{			
			header('location:plans.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:plans.php?act=new&msg=1');
		}  				 
	}
	else
	if ($_POST["mark"]=="editplan")
	{			    
		$values = array("`pname`"=>"'{$_POST[plan]}'",
		                 "`month`"=>"'{$_POST[month]}'",
						 "`gig`"=>"'{$_POST[volume]}'",
						 "`night`"=>"'{$_POST[night]}'",
						 "`modem`"=>"'{$_POST[modem]}'",
						 "`price`"=>"'{$_POST[price]}'",
						 "`percent`"=>"'{$_POST[percent]}'",
						 "`special`"=>"'{$_POST[special]}'",
						 "`position`"=>"'{$_POST[position]}'",
						 "`hispecial`"=>"'{$_POST[offer]}'");
        $db->UpdateQuery("plans",$values,array("id='{$_GET[pid]}'"));		
		header('location:plans.php?act=new&msg=1');
	}	
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ثبت'/></p>
						<input type='hidden' name='mark' value='saveplan' />  ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("plans","*","id='{$_GET["pid"]}'",NULL);
		$nightchecked=($row['night'])?"checked":"";
		$modemchecked=($row['modem'])?"checked":"";
		$special=($row['special'])?"checked":"";
		$offer=($row['hispecial'])?"checked":"";
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ویرایش'/></p>
						<input type='hidden' name='mark' value='editplan' />  ";
	}
	if ($_GET['act']=="del")
	{
	//	$db->Delete("plans"," id",$_GET["pid"]);		
	//	header('location:plans.php?act=new');	
	 $values = array("`remove`"=>"'1'");
     $db->UpdateQuery("plans",$values,array("id='{$_GET[pid]}'"));	
	 header('location:plans.php?act=new');	
	}	
$msgs = GetMessage($_GET['msg']);
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
				  <div id="message">{$msgs}</div>
					<form class="plans" action="" method="post">
						<p><span>نام طرح</span><input type="text" name="plan" placeholder="طلایی - 3 گیگابایت - 3 ماهه" value='{$row[pname]}' /></p>
						<p><span>مدت زمان (ماه)</span><input type="text" name="month" placeholder="1-12" value='{$row[month]}' /></p>
						<p><span>حجم (گیگابایت)</span><input type="text" name="volume" placeholder="1-99" value='{$row[gig]}' /></p>
						<p><span>قیمت (ریال)</span><input type="text" name="price"  placeholder="قیمت (ریال)" value='{$row[price]}'/></p>
						<p style="padding-top:10px"><span>شبانه دارد</span><input type="checkbox" name="night" value="1" {$nightchecked} /></p>
						<p style="padding-top:10px"><span>مودم دارد</span><input type="checkbox" name="modem" value="1" {$modemchecked}/></p>
						<p class="clear"></p>
                        <p><span>درصد تخفیف</span><input type="text" name="percent" placeholder="1-100" value='{$row[percent]}'/></p>
						<p><span>شماره ایندکس جهت ترتیب نمایش</span><input type="text" name="position" placeholder="a Number" value='{$row[position]}'/></p>
						<p style="padding-top:10px;clear:both"><span>طرح ویژه</span><input type="checkbox" name="special" value="1" {$special}/></p>
						<p style="padding-top:10px"><span> طرح خاص</span><input type="checkbox" name="offer" value="1" {$offer}/></p>
						{$insertoredit}						
					</form>
                    <div class="clear"></div>
                    <hr>
cd;

$rows = $db->SelectAll("plans","*"," remove = 0 ","position ASC");
$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	        
            <th style="width:200px"><a href="#">نام طرح</a></th>
            <th style="width:40px"><a href="#">مدت زمان</a></th>
            <th style="width:50px"><a href="#">حجم طرح</a></th>
            <th style="width:30px"><a href="#">شبانه </a></th>
            <th style="width:30px"><a href="#">مودم</a></th>
			<th style="width:50px"><a href="#">هزینه طرح</a></th>
			<th style="width:30px"><a href="#">درصد تخفیف</a></th>
			<th style="width:70px"><a href="#">عملیات</a></th>	
        </tr>
    </thead>
	<tbody style="display: none;">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["month"] = ($rows[$i]["month"])." ماهه ";
 $rows[$i]["gig"] = ($rows[$i]["gig"])." گیگابایت ";
 $rows[$i]["night"] = ($rows[$i]["night"])?"دارد" :"ندارد";
 $rows[$i]["modem"] = ($rows[$i]["modem"])?"دارد" :"ندارد";

if (($i+1)%10 == 0)
	
	$table.=<<<cd
	</tbody>
<tbody style="display: table-row-group;">
cd;

if ($rows[$i]["special"])
 {
  $class= "spec";
 }
else
 {
   $class = "";
 }
$table .=<<<cd
        <tr class="$class">		
            <td>{$rows[$i]["pname"]}</td>
            <td>{$rows[$i]["month"]}</td>
            <td>{$rows[$i]["gig"]}</td>
            <td>{$rows[$i]["night"]}</td>
            <td>{$rows[$i]["modem"]}</td>
			<td>{$rows[$i]["price"]}</td>
			<td>{$rows[$i]["percent"]}</td>
			<td>
                <ul class="action-buttons">
                    <li><a href="?act=edit&pid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
                    <li><a href="?act=del&pid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="bin"></span></a></li>
                </ul>
            </td>
        </tr>
	
cd;
}
$table.="</tbody> </table>";
//include_once("inc/table.php");
$html.=<<<cd
                    {$table}
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->
	<script type='text/javascript'>
		$(document).ready(function(){	
		  $("span.bin").click(function() 
		  {
				if(confirm("از حذف این رکورد مطمئن هستید؟"))
				{					
				}
				else
				{
					return false;
				}
		  });
	    });
		</script>	
		
cd;
include_once("inc/header.php");
echo $html;
include_once("inc/footer.php"); 
?>