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

$rows = $db->SelectAll("orders","*",$where,"id Desc");
$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	  
			<th style="width:60px"><a href="#">تاریخ پرداخت</a></th>		
            <th><a href="#">نام مشتری</a></th>
			<th style="width:68px"><a href="#">تلفن</a></th>
			<th style="width:68px"><a href="#">موبایل</a></th>
			<th style="width:150px"><a href="#">ایمیل</a></th>
            <th><a href="#">کد پرداخت</a></th>
            <th style="width:35px"><a href="#">شماره پیگیری</a></th>
            <th style="width:35px"><a href="#">وضعیت پرداخت</a></th>          
			{$titr}
        </tr>
    </thead>
	<tbody style="display: none;">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 

$table .=<<<cd
        <tr>		
		    <td></td>
            <td></td>
			<td></td>			
			<td></td>			
			<td style="font-size:12px;"></td>			
            <td></td>
            <td></td>
            <td></td>            
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