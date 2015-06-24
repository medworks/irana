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
		$fields = array("`amount`","`desc`");		
		$values = array("'{$_POST[amount]}'","'{$_POST[desc]}'");
		
		if (!$db->InsertQuery('vols',$fields,$values)) 
		{			
			header('location:vols.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:vols.php?act=new&msg=1');												
		}  				 
	}
	else
	if ($_POST["mark"]=="editvol")
	{			    
		$values = array("`amount`"=>"'{$_POST[fvol]}'",
		                 "`desc`"=>"'{$_POST[tvol]}'");
        $db->UpdateQuery("vols",$values,array("id='{$_GET[vid]}'"));		
		header('location:vols.php?act=edit&msg=1');
	}	
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ثبت'/></p>
						<input type='hidden' name='mark' value='savevol' />  ";
	}
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("vols","*","id='{$_GET["vid"]}'",NULL);		
		$insertoredit = "
			<p><input type='submit' style='width:70px;height:35px' value='ویرایش'/></p>
						<input type='hidden' name='mark' value='editvol' />  ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("vols"," id",$_GET["vid"]);		
		header('location:vols.php?act=new');	
	}	
$msgs = GetMessage($_GET['msg']);
$html=<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">	
        <div class="main-content">
            <header>
                <h2>
                    لیست حجم ها
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
				    <div id="message">{$msgs}</div>
					<form class="plans" action="" method="post">
                        <p><span>مقدار</span><input type="text" name="amount" placeholder="مقدار" value='{$row[amount]}'/></p>
                        <p><span>توضیحات</span><input type="text" name="desc" placeholder="توضیحات" value='{$row[desc]}'/></p>                        
						{$insertoredit}
					</form>
                    <div class="clear"></div>
                    <hr>
cd;
$rows = $db->SelectAll("vols","*",null,"id Asc");
$table=<<<cd
<table class="datatable sortable full">
    <thead class="rtl">
        <tr>	        
            <th><a href="#">مقدار</a></th>
            <th><a href="#">توضیحات</a></th>
			<th style="width:70px"><a href="#">عملیات</a></th>	
        </tr>
    </thead>
	<tbody class="rtl">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 $rows[$i]["fvol"] = ($rows[$i]["amount"])." گیگابایت ";
 $rows[$i]["tvol"] = ($rows[$i]["desc"]);
 
if (($i+1)%10 == 0)
	
	$table.=<<<cd
	</tbody>
<tbody style="display: table-row-group;">
cd;

$table .=<<<cd
        <tr>		
            <td>{$rows[$i]["amount"]}</td>
            <td>{$rows[$i]["desc"]}</td>
             
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