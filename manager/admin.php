<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php");  
	    
	//error_reporting(E_ALL);
	//ini_set('display_errors', 0);
	
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
  
   
  if ($_GET['act']=="del")
  {
	  //$db->Delete("orders"," id",$_GET["oid"]);
	  echo "delete";
	 $values = array("`remove`"=>"'1'");
     $db->UpdateQuery("orders",$values,array("id='{$_GET[oid]}'"));			  
	//  if ($_GET["state"]=="ord")	
	//	header("location:admin.php?act=ord");	
	// else	
	  //  header("location:admin.php?act=confirmed");	
  }	
  if ($_GET['act']=="confirm")
  {
	 $values = array("`status`"=>"'2'");
     $db->UpdateQuery("orders",$values,array("id='{$_GET[oid]}'"));		

	 if ($_GET["act"]=="ord")	
		header("location:admin.php?act=ord");	
	 else	
	    header("location:admin.php?act=confirmed&oid={$_GET[oid]}");
   // echo "<br/>".$_GET["act"]."<br/>";
  }	
	
	if ($_GET["act"]=="ord")
    { 	
		$where = "Status = 1 AND paystatus = 1 AND remove = 0 ";
		$title = "لیست سفارشات";		
	}	
	else	
	if ($_GET["act"]=="confirmed")	
	{
		$where = " Status = 2 AND paystatus = 1 AND remove = 0 ";
		$title = "لیست  تایید شده";	
		
	    //header("location:admin.php?act=confirmed");
	}	

	
$list = array("propid"=>"نام مشتری",
			  "orderdate"=>"تاریخ سفارش",	
			  "tel"=>"تلفن",
			  "pegiri"=>"کد پیگیری");
$combobox = SelectOptionTag("cbsearch",$list,"propid");
$search=<<<srh
                    <div class="Top">                       
						<center>
							<form action="" method="post" id="frmsrh" name="frmsrh">
								<p class="search-form" style="font-size:18px">جستجو بر اساس {$combobox}
									<input type="text" id="date_input_1" name="txtsrh" style="font-size:17px" class="search-form" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}"  /> 						
							        <a href="admin.php?act={$_GET['act']}" name="srhsubmit" id="srhsubmit" class="button" style="font-size:18px"> جستجو</a>
									<a href="admin.php?act={$_GET['act']}&rec=all" name="retall" id="retall" class="button" style="font-size:18px"> کلیه اطلاعات</a>
								</p>
								<input type="hidden" name="mark" value="srhorders" /> 
								{$msgs}							
															
							</form>
					   </center>
					</div>
<script type='text/javascript'>
	$(document).ready(function(){	   			
		$('#srhsubmit').click(function(){	
			$('#frmsrh').submit();
			return false;
		});
		$('#cbsearch').change(function(){
			$("select option:selected").each(function(){
	            if($(this).val()=="orderdate"){
	            	$('.cal-btn').css('display' , 'inline-block');
	            	return false;
	            }else{
	            	$('.cal-btn').css('display' , 'none');
	            }
  			});
		});
		
		$('#cbsearch').change();
	});
	
</script>	   								

srh;
	
$html=<<<cd
    <!-- Main Section -->	
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                   {$title}
                </h2>
            </header>
			{$search}
            <section class="container_6 clearfix">
                <div class="grid_6" style="width:780px">
cd;

if ($_POST['mark']=="srhorders")
{
	
	switch ($_POST['cbsearch'])
	{
	 case 'propid' :
		$filters = $db->SelectAll("properties","id","fullname LIKE '%{$_POST[txtsrh]}%' ","id Desc");
		$ids = array();
		for($i = 0; $i < Count($filters); $i++)
		{
			$ids[] = $filters[$i][0];			
		}
		$idd = implode(",",($ids));
		$where.= " AND propid in (".$idd.")";
		$rows = $db->SelectAll("orders","*",$where,"id Desc");
		//echo $db->cmd;
	 break;
	 case 'orderdate' :
	 
	    list($year,$month,$day) = explode("/", trim($_POST["txtsrh"]));		
		list($gyear,$gmonth,$gday) = jalali_to_gregorian($year,$month,$day);		
		$_POST["txtsrh"] = Date("Y-m-d",mktime(0, 0, 0, $gmonth, $gday, $gyear));
		//echo $_POST["txtsrh"];
		$where .= " AND orderdate LIKE '%{$_POST[txtsrh]}%' ";
		$rows = $db->SelectAll("orders","*",$where,"id Desc");
	 break;	 
	 case 'tel' :
		$filters = $db->SelectAll("properties","id","tel LIKE '%{$_POST[txtsrh]}%' ","id Desc");
		$ids = array();
		for($i = 0; $i < Count($filters); $i++)
		{
			$ids[] = $filters[$i][0];			
		}
		$idd = implode(",",($ids));
		$where.= " AND propid in (".$idd.")";
		$rows = $db->SelectAll("orders","*",$where,"id Desc");
	 break;
	 case 'pegiri' :
	    $orderid = $db->Select("payment","oid","pegiri = ".$_POST['txtsrh'])[0]; 
		
		$where.= " AND id = ".$orderid;
		$rows = $db->SelectAll("orders","*",$where,"id Desc");		
	 break;
	}	
}
//else
	//$rows = $db->SelectAll("orders","*",$where,"id Desc");
	//echo $db->cmd;
	$rows = $db->SelectAll(
				"orders",
				"*",
				$where,
				"id DESC",
				$_GET["pageNo"]*10,
				10);
				
				$rowsClass = array();
                $colsClass = array();
                $rowCount =($_GET["rec"]=="all" or $_POST["mark"]!="srhorders")?$db->CountOf("orders",$where):Count($rows);
			   // $rowCount = Count($rows);
				//echo "row is ".$rowCount;
                for($i = 0; $i < Count($rows); $i++)
                {		
				 $rows[$i]["orderdate"] = ToJalali($rows[$i]["orderdate"],"Y/m/d H:i");
				 $rows[$i]["tel"] = $db->Select("properties","tel","id = ".$rows[$i]["propid"])[0];
				 $rows[$i]["mobile"] = $db->Select("properties","mobile","id = ".$rows[$i]["propid"])[0];
				 $rows[$i]["email"] = $db->Select("properties","email","id = ".$rows[$i]["propid"])[0];
				 $rows[$i]["propid"] = $db->Select("properties","fullname","id = ".$rows[$i]["propid"])[0]; 
				 
				 $rows[$i]["planid"] = $db->Select("plans","pname","id = ".$rows[$i]["planid"])[0];

				 $rows[$i]["peygiri_code"] =$db->Select("payment","pegiri","oid = ".$rows[$i]["id"])[0]; 
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

					
				if ($i % 2==0)
				 {
						$rowsClass[] = "datagridevenrow";
				 }
				else
				{
						$rowsClass[] = "datagridoddrow";
				}		
				$colsClass = array(" width:15px; "," width:17px; "," width:40px; "," width:20px;","width:15px;","width:40px;","width:60px;","width:20px;"
				,"width:20px;","width:20px;","width:20px;","width:20px;");
				if ($_GET["act"]=="ord")
				{
				$rows[$i]["edit"] = "<a href='?act=confirm&state=ord&oid={$rows[$i][id]}' class='button button-gray no-text'
						 style='text-decoration:none;'><span class='pencil'></span></a>";
				$rows[$i]["delete"]=<<< del
				<a href="javascript:void(0)"
				onclick="DelMsg('{$rows[$i]['id']}',
					'از حذف این خبر اطمینان دارید؟',
				'?act=del&state=ord&pageNo={$_GET[pageNo]}&oid=');"
				 class='button button-gray no-text' 
			     style='text-decoration:none;'><span class='bin'></span></a>
del;
				}
                         }

    if (!$_GET["pageNo"] or $_GET["pageNo"]<=0) $_GET["pageNo"] = 0;
            if (Count($rows) > 0)
            {       
					if ($_GET["act"]=="ord")
					{
						$header = array( 
					        "orderdate"=>"تاریخ سفارش",
							"propid"=>"نام مشتری",
							"tel"=>"تلفن",
							"mobile"=>"موبایل",
							//"email"=>"ایمیل",
							"kind"=>"نوع سفارش",
							"planid"=>"   نام طرح   ",
							"price"=>"مبلغ",
							"status"=>"وضعیت سفارش",							
							"paystatus"=>"وضعیت پرداخت",
							"peygiri_code"=>"کد پیگیری",				
                            "edit"=>"ویرایش",
							"delete"=>"حذف",);
							$plink = "act=ord";
					}
                    else
					{
						$header = array( 
					        "orderdate"=>"تاریخ سفارش",
							"propid"=>"نام مشتری",
							"tel"=>"تلفن",
							"mobile"=>"موبایل",
							//"email"=>"ایمیل",
							"kind"=>"نوع سفارش",
							"planid"=>"   نام طرح   ",
							"price"=>"مبلغ",
							"status"=>"وضعیت سفارش",							
							"paystatus"=>"وضعیت پرداخت",
							"peygiri_code"=>"کد پیگیری",);
							$plink = "act=confirmed";
					}
                    $gridcode .= DataGrid($header, $rows, $colsClass, $rowsClass, 10,
                            $_GET["pageNo"], "id", false, true, true, $rowCount,$plink);  
            }				


$html.=<<<cd
                {$gridcode}
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
  include_once("inc/footer.php")
?>