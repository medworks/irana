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
	$db = Database::GetDatabase();
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
if ($_GET["act"]=="ord")	
	$where = "Status = 1";
else	
if ($_GET["act"]=="confirm")	
	$where = "Status = 2";
	
$html=<<<cd
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
cd;

$rows = $db->SelectAll("orders","*",$where,"id Desc");
$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	  
			<th><a href="#">تاریخ سفارش</a></th>		
            <th><a href="#">نام مشتری</a></th>
			<th><a href="#">تلفن مشتری</a></th>
            <th><a href="#">نام طرح</a></th>
            <th><a href="#">نوع سفارش</a></th>
            <th><a href="#">وضضعیت سفارش </a></th>            
			<th><a href="#">حجم(گیگابایت) </a></th>            
			<th style="width:70px"><a href="#">عملیات</a></th>	
        </tr>
    </thead>
	<tbody style="display: none;">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["orderdate"] = ToJalali($rows[$i]["sdate"]," l d F  Y ");
  
 $tel = $db->Select("properties","tel","id = ".$rows[$i]["propid"])[0];
 $rows[$i]["propid"] = $db->Select("properties","fullname","id = ".$rows[$i]["propid"])[0]; 
 
 $rows[$i]["planid"] = $db->Select("plans","pname","id = ".$rows[$i]["planid"])[0];
 
 if($rows[$i]["kind"]==0)
	$rows[$i]["kind"] = "شارژ حساب";
 else
 if ($rows[$i]["kind"]==1) 
	$rows[$i]["kind"] = "تمدید حساب فعلی";
 else	
 if ($rows[$i]["kind"]==2) 
	$rows[$i]["kind"] = "تغییر حساب"; 
	
if (($i+1)%11 == 0)	
	$table.=<<<cd
	</tbody>
		<tbody style="display: table-row-group;">
cd;

$table .=<<<cd
        <tr>		
		    <td>{$rows[$i]["orderdate"]}</td>
            <td>{$rows[$i]["propid"]}</td>
			<td>{$tel}</td>			
            <td>{$rows[$i]["planid"]}</td>
            <td>{$rows[$i]["kind"]}</td>
            <td>{$rows[$i]["status"]}</td>            
			<td>{$rows[$i]["gig"]}</td>            
			<td>
                <ul class="action-buttons">
                    <li><a href="?act=confirm&oid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
                    <li><a href="?act=del&oid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="bin"></span></a></li>
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
cd;
  echo $html;
  include_once("inc/footer.php")
?>