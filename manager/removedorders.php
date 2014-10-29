<?php    
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
	 $db->Delete("orders"," id",$_GET["oid"]);
	 header("location:removedorders.php?act=new");		 
  }		
   if ($_GET['act']=="return")
  {	
	 $values = array("`remove`"=>"'0'");
     $db->UpdateQuery("orders",$values,array("id='{$_GET[oid]}'"));			  	 
	  header("location:removedorders.php?act=new");		 
  }		
$html=<<<cd
    <!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                   لیست سفارشات حذف شده
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6" style="width:780px">
cd;

$rows = $db->SelectAll("orders","*"," remove = 1 And paystatus = 1","id Desc");

$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	  
			<th style="width:70px"><a href="#">تاریخ سفارش</a></th>			
            <th style="width:80px" ><a href="#">نام مشتری</a></th>
			<th style="width:68px"><a href="#">تلفن</a></th>
			<th style="width:70px"><a href="#">موبایل</a></th>
			<!-- <th style="width:150px"><a href="#">ایمیل</a></th> -->
			<th style="width:35px"><a href="#">نوع سفارش</a></th>
            <th style="width:70px"><a href="#">نام طرح</a></th> 
			<th style="width:70px"><a href="#">مبلغ</a></th> 			
            <th style="width:35px"><a href="#">وضعیت سفارش</a></th>
			<th style="width:35px"><a href="#">وضعیت پرداخت</a></th>
			<th style="width:80px"><a href="#">کد پیگیری</a></th> 			
			<th style='width:55px'><a href='#'>عملیات</a></th>
        </tr>
    </thead>
	<tbody style="display: none;">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["orderdate"] = ToJalali($rows[$i]["orderdate"],"Y/m/d H:i");
 $tel = $db->Select("properties","tel","id = ".$rows[$i]["propid"])[0];
 $mobile = $db->Select("properties","mobile","id = ".$rows[$i]["propid"])[0];
 $email = $db->Select("properties","email","id = ".$rows[$i]["propid"])[0];
 $rows[$i]["propid"] = $db->Select("properties","fullname","id = ".$rows[$i]["propid"])[0]; 
 
 $rows[$i]["planid"] = $db->Select("plans","pname","id = ".$rows[$i]["planid"])[0];

 $peygiri_code =$db->Select("payment","pegiri","oid = ".$rows[$i]["id"])[0]; 
 if($rows[$i]["kind"]==0)
 {
	$rows[$i]["kind"] = "شارژ حساب";
	$rows[$i]["planid"] = $rows[$i]["gig"]."GB"; 
 }
 else
 if ($rows[$i]["kind"]==1) 
	$rows[$i]["kind"] = "تمدید حساب فعلی";
 else	
 if ($rows[$i]["kind"]==2) 
	$rows[$i]["kind"] = "تغییر حساب"; 
else	
 if ($rows[$i]["kind"]==3) 	
	$rows[$i]["kind"] = "سفارش طرح"; 
	
if ($rows[$i]["status"]==1) 
	$rows[$i]["status"] = "تایید نشده";
else	
	$rows[$i]["status"] = "تایید شده";

if ($rows[$i]["paystatus"]==1)
	$rows[$i]["paystatus"] = "پرداخت شده";
else
	$rows[$i]["paystatus"] = "معلق";	
	
	
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
			<td>{$mobile}</td>			
			<!-- <td style="font-size:12px;">{$email}</td> -->
			<td>{$rows[$i]["kind"]}</td>
            <td>{$rows[$i]["planid"]}</td>
			<td>{$rows[$i]["price"]}</td>
            <td>{$rows[$i]["status"]}</td>
			<td>{$rows[$i]["paystatus"]}</td>
			<td>{$peygiri_code}</td>
            <!-- <td>{$rows[$i]["gig"]}</td>  -->
			<td>
                <ul class="action-buttons">
                    <li><a href="?act=return&oid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
                    <li><a id="del" href="?act=del&oid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="bin"></span></a></li> 
                </ul>
        </td>
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
  include_once("inc/header.php");
  echo $html;
  include_once("inc/footer.php")
?>