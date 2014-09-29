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
    include_once('../lib/sms/sms.class.php');	
	
	$login = Login::GetLogin();	
	$db = Database::GetDatabase();	
	
	
  if ($_GET['act']=="del")
  {
	 $db->Delete("plans"," id",$_GET["pid"]);
	 header("location:removeplans.php?act=new");		 
  }		
   if ($_GET['act']=="return")
  {	
	 $values = array("`remove`"=>"'0'");
     $db->UpdateQuery("plans",$values,array("id='{$_GET[pid]}'"));			  	 
	  header("location:removeplans.php?act=new");		 
  }		
$html=<<<cd
    <!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                   لیست طرح های حذف شده
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6" style="width:780px">
cd;

$rows = $db->SelectAll("plans","*"," remove = 1","id ASC");

$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	        
            <th><a href="#">نام طرح</a></th>
            <th><a href="#">مدت زمان</a></th>
            <th><a href="#">حجم طرح</a></th>
            <th><a href="#">شبانه </a></th>
            <th><a href="#">مودم</a></th>
			<th><a href="#">هزینه طرح</a></th>
			<th><a href="#">درصد تخفیف</a></th>
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
                    <li><a href="?act=return&pid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
                    <li><a href="?act=del&pid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="bin"></span></a></li>
                </ul>
            </td>
        </tr>
	
cd;
}
$table.="</tbody> </table>";

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
				if(confirm("لطفا دقت نمایید! این بار با حذف ، این رکورد دیگر قابلیت برگشت ندارد. از حذف این رکورد مطمئن هستید؟"))
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
  echo $html;
  include_once("inc/footer.php")
?>