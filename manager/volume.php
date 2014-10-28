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
	$msg = Message::GetMessage();
    
    if ($_POST["mark"]=="savevol")
	{	      
		$fields = array("`fvol`","`tvol`","`price`","`percent`");		
		$values = array("'{$_POST[fvol]}'","'{$_POST[tvol]}'","'{$_POST[price]}'","'{$_POST[percent]}'");
		
		if (!$db->InsertQuery('volumes',$fields,$values)) 
		{			
			header('location:volume.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:volume.php?act=new&msg=1');												
		}  				 
	}
	else
	if ($_POST["mark"]=="editvol")
	{			    
		$values = array("`fvol`"=>"'{$_POST[fvol]}'",
		                 "`tvol`"=>"'{$_POST[tvol]}'",
						 "`price`"=>"'{$_POST[price]}'",
						 "`percent`"=>"'{$_POST[percent]}'");
        $db->UpdateQuery("volumes",$values,array("id='{$_GET[vid]}'"));		
		header('location:volume.php?act=edit&msg=1');
	}	
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ثبت'/></p>
						<input type='hidden' name='mark' value='savevol' />  ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("volumes","*","id='{$_GET["vid"]}'",NULL);
		$nightchecked=($row['night'])?"checked":"";
		$modemchecked=($row['modem'])?"checked":"";
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ویرایش'/></p>
						<input type='hidden' name='mark' value='editvol' />  ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("volumes"," id",$_GET["vid"]);		
		header('location:volume.php?act=new');	
	}	
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">	
        <div class="main-content">
            <header>
                <h2>
                    تعرفه حجم ها
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
				    <div id="message">{$msgs}</div>
					<form class="plans" action="" method="post">
                        <p><span>از حجم</span><input type="text" name="fvol" placeholder="از حجم" value='{$row[fvol]}'/></p>
                        <p><span>تا حجم</span><input type="text" name="tvol" placeholder="تا حجم" value='{$row[tvol]}'/></p>
                        <p><span>قیمت (ریال)</span><input type="text" name="price" placeholder="قیمت (ریال)" value='{$row[price]}'/></p>
                        <p><span>درصد تخفیف</span><input type="text" name="percent" placeholder="1-100" value='{$row[percent]}'/></p>
						{$insertoredit}
					</form>
                    <div class="clear"></div>
                    <hr>
cd;
$rows = $db->SelectAll("volumes","*",null,"id Asc");
$table=<<<cd
<table class="datatable sortable full">
    <thead class="rtl">
        <tr>	        
            <th><a href="#">از حجم</a></th>
            <th><a href="#">تا حجم</a></th>
            <th><a href="#">قیمت</a></th>
            <th><a href="#">درصد تخفیف </a></th>            
			<th style="width:70px"><a href="#">عملیات</a></th>	
        </tr>
    </thead>
	<tbody class="rtl">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["fvol"] = ($rows[$i]["fvol"])." گیگابایت ";
 $rows[$i]["tvol"] = ($rows[$i]["tvol"])." گیگابایت ";
 
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
            <td>{$rows[$i]["percent"]}</td>            
			<td>
                <ul class="action-buttons">
                    <li><a href="?act=edit&vid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
                    <li><a href="?act=del&vid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="bin"></span></a></li>
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