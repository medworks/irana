<?php
  include_once("inc/header.php");
  
  include_once("config.php");
    include_once("classes/database.php");
    include_once("classes/messages.php");
  include_once("classes/functions.php");
  include_once("lib/persiandate.php");
  
  $db = Database::GetDatabase();
  $msg = Message::GetMessage();
$html =<<<cd
  <link rel="stylesheet" href="manager/css/tables.css" type="text/css">
  <link rel="stylesheet" href="manager/css/forms.css" type="text/css">

    <!-- <script src="manager/js/jquery.tools.min.js"></script>
    <script src="manager/js/jquery.ui.min.js"></script>
    <script src="manager/js/jquery.tables.js"></script> -->
    <!-- <style>
      a.button-blue{
        background: -webkit-gradient(linear, left top, left bottom, from(#faa51a), to(#f47a20)) !important;
        color:#2f2f2f !important;
        font-size:15px !important;
        border:1px solid #dd6611 !important;
      }

      a.button-blue:hover,
      a.button-blue:focus{
        background: -webkit-gradient(linear, left top, left bottom, from(#f88e11), to(#f06015)) !important;
        border: solid 1px #aa5511 !important;
        color: #fef4e9 !important;
      }

      a.button-blue.current{
        color:#fff !important;
      }
    </style> -->

    <!-- Main content alpha -->
    <div class="main png_bg">
      <div class="inner_main">
      <!-- True containers (keep the content inside containers!) -->
        <div class="container_alpha slogan">
          <h1>تعرفه طرح ها</h1>
        </div>
        <div class="container_gamma slogan" style="background:none">
cd;
$rows = $db->SelectAll("plans","*"," remove = 0 ","position Asc");
$table=<<<cd
<table class="datatable full">
    <thead class="rtl">
        <tr>          
		  <th>  </th>		
          <th>نام طرح</th>
          <th>مدت زمان (ماه)</th>
          <!-- <th>حجم (گیگابایت)</th> -->
          <th>شبانه رایگان</th>
          <th>مودم رایگان</th>
          <th>هزینه طرح (ریال)</th>
          <th>درصد تخفیف</th>
          <th>قابل پرداخت (ریال)</th>   
          <th>سفارش</th>    
        </tr>
    </thead>
  <tbody class="rtl">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["month"] = ($rows[$i]["month"])." ماهه ";
 $rows[$i]["gig"]   = ($rows[$i]["gig"])." گیگابایت ";
 $rows[$i]["night"] = ($rows[$i]["night"])?"دارد" :"ندارد";
 $rows[$i]["modem"] = ($rows[$i]["modem"])?"دارد" :"ندارد";
 $percent = $rows[$i]["percent"]." % ";

if (($i+1)%10 == 0)
  
  $table.=<<<cd
  </tbody>
<tbody class="rtl" style="display: table-row-group;">
cd;

$percentedprice =$rows[$i]["price"]-(($rows[$i]["price"]*$rows[$i]["percent"])/100);
if ($rows[$i]["special"])
 {
  $class= "spec";
 }
else
 {
   $class = "";
 }
 
 if ($rows[$i]["hispecial"])
 {
  $offer= "<img src='./images/offer.gif' width='40px' height='40px' />";
 }
else
 {
   $offer = "";
 }
 
$table .=<<<cd
        <tr class="$class">   
			<td>{$offer}</td>
            <td>{$rows[$i]["pname"]}</td>
            <td>{$rows[$i]["month"]}</td>
            <!-- <td>{$rows[$i]["gig"]}</td> -->
            <td>{$rows[$i]["night"]}</td>
            <td>{$rows[$i]["modem"]}</td>
            <td>{$rows[$i]["price"]}</td>     
            <td>{$percent}</td>     
            <td>{$percentedprice}</td>
            <td>
              <a href="main.php?act=neword&planid={$rows[$i]["id"]}&do=ok" class="button button-gray no-text" style="display:inline-block;padding:0 10px;">
                <span class="order"></span>
              </a>
            </td>
        </tr>
  
cd;
}
$table.="</tbody> </table>";
$html.=<<<cd
          {$table}
          <div class="clearfix"></div>
        </div>
        <div class="container_alpha slogan">
          <h1>تعرفه حجم ها</h1>
        </div>
        <div class="container_gamma slogan" style="background:none">
cd;
$rows = $db->SelectAll("volumes","*",null,"id Asc");
$table=<<<cd
<table class="datatable full">
    <thead class="rtl">
        <tr>          
            <th>از حجم (گیگابایت)</th>
            <th>تا حجم (گیگابایت)</th>
            <th>قیمت (ریال)</th>
            <th>درصد تخفیف</th>                 
            <th>قابل پرداخت (ریال)</th>                 
        </tr>
    </thead>
  <tbody class="rtl">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["fvol"] = ($rows[$i]["fvol"])." گیگابایت ";
 $rows[$i]["tvol"] = ($rows[$i]["tvol"])." گیگابایت ";
 $rows[$i]["percent"] = $rows[$i]["percent"]+" % ";
 $percentedprice = $rows[$i]["price"]-(($rows[$i]["price"]*$rows[$i]["percent"])/100);
if (($i+1)%10 == 0)
  
  $table.=<<<cd
  </tbody>
<tbody style="display: table-row-group;">
cd;

$table .=<<<cd
        <tr>    
            <td>{$rows[$i]["fvol"]}</td>
            <td>{$rows[$i]["tvol"]}</td>
            <td>{$rows[$i]["price"]}</td>
            <td>{$percent}</td>
      <td>{$percentedprice}</td>
        </tr>
  
cd;
}
$table.="</tbody> </table>";
$html.=<<<cd
          {$table}
          <div class="clearfix"> </div>
        </div>
      </div>
    </div>
    <!-- /True containers (keep the content inside containers!) -->
      <div class="endmain png_bg"></div>
    <!-- /Main content alpha -->
  
cd;
    echo $html;
  include_once("inc/footer.php");
?>