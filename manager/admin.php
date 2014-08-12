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

$rows = $db->SelectAll("orders","*",null,"id dec");
$table=<<<cd
<table class="datatable sortable full">
    <thead class="rtl">
        <tr>	        
            <th><a href="#">نام مشتری</a></th>
            <th><a href="#">نام طرح</a></th>
            <th><a href="#">نوع سفارش</a></th>
            <th><a href="#">وضضعیت سفارش </a></th>            
			<th><a href="#">حجم(گیگابایت) </a></th>            
			<th style="width:70px"><a href="#">عملیات</a></th>	
        </tr>
    </thead>
	<tbody class="rtl">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["propid"] = $db->Select("properties","fullname","id = ".$rows[$i]["propid"]);
 $rows[$i]["planid"] = $db->Select("plans","pname","id = ".$rows[$i]["planid"]);
 
if (($i+1)%10 == 0)
	
	$table.=<<<cd
	</tbody>
<tbody style="display: table-row-group;">
cd;

$table .=<<<cd
        <tr>		
            <td>{$rows[$i]["propid"]}</td>
            <td>{$rows[$i]["planid"]}</td>
            <td>{$rows[$i]["kind"]}</td>
            <td>{$rows[$i]["status"]}</td>            
			<td>{$rows[$i]["gig"]}</td>            
			<td>
                <ul class="action-buttons">
                    <li><a href="?act=edit&oid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
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