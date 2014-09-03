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
	
	
	
$html=<<<cd
    <!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                   لیست پرداختی های بانک
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
cd;

$rows = $db->SelectAll("payment","*",$where,"id Desc");

$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	  
			<th style="width:70px"><a href="#">تاریخ پرداخت</a></th>		
            <th style="width:68px"><a href="#">نام مشتری</a></th>
			<th style="width:50px"><a href="#">تلفن</a></th>
			<th style="width:50px"><a href="#">موبایل</a></th>			
            <th style="width:90px"><a href="#">کد سفارش</a></th>
            <th style="width:65px"><a href="#">شماره پیگیری</a></th>
            <th style="width:30px"><a href="#">وضعیت پرداخت</a></th>	
        </tr>
    </thead>
	<tbody style="display: none;">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["regdate"] = ToJalali($rows[$i]["regdate"]," l d F  Y ");
 $order = $db->Select("orders","propid","id ='{$rows[$i]["oid"]}'");
 $person = $db->Select("properties","*","id ='{$order[0]}'");
 
 if ($rows[$i]["confirm"]==1) 
	$rows[$i]["confirm"]= "قطعی";
 else
	$rows[$i]["confirm"]="معلق";
	
if (($i+1)%11 == 0)	
	$table.=<<<cd
	</tbody>
		<tbody style="display: table-row-group;">
cd;

$table .=<<<cd
        <tr>		
		    <td>{$rows[$i]["regdate"]}</td>	
			<td>{$person[fullname]}</td>
			<td>{$person[tel]}</td>
            <td>{$person[mobile]}</td>
			<td>{$rows[$i]["selorder"]}</td>
			<td>{$rows[$i]["pegiri"]}</td>						
            <td>{$rows[$i]["confirm"]}</td>                       
cd;
$table .= "</tr>";
}
$table.="</tbody> </table>";

$html.=<<<cd
                    {$table}
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->
cd;
  echo $html;
  include_once("inc/footer.php")
?>