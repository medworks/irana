<?php	
	include_once("../config.php");
    include_once("../classes/database.php");
	include_once("../classes/messages.php");
	include_once("../classes/session.php");	
	include_once("../classes/functions.php");
	include_once("../classes/login.php");
	
	$login = Login::GetLogin();
	$db = Database::GetDatabase();
	$msg = Message::GetMessage();
	
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug		
	}
	
	if ($_POST["mark"]=="saveuser")
	{
	    $pass = md5($_POST[password]);
		$fields = array("`name`","`family`","`image`","`email`","`username`","`password`");
		$values = array("''","'{$_POST[family]}'","''","'{$_POST[email]}'","'{$_POST[username]}'","'{$pass}'");	
		if (!$db->InsertQuery('users',$fields,$values)) 
		{
			header('location:user.php?act=new&msg=2');				
		} 	
		else 
		{  										
			header('location:user.php?act=new&msg=1');
		}  				 
	}
	else
	if ($_POST["mark"]=="edituser")
	{			    
	    $row=$db->Select("users","*","id='{$_GET["uid"]}'",NULL);	    
		if ($_POST['password'] != $row['password'])
			$pass = md5($_POST['password']);
		else
			$pass = $_POST['password'];
		$values = array("`name`"=>"''",
		                 "`family`"=>"'{$_POST[family]}'",
						 "`image`"=>"''",
						 "`email`"=>"'{$_POST[email]}'",
						 "`username`"=>"'{$_POST[username]}'",
						 "`password`"=>"'{$pass}'");		
        $db->UpdateQuery("users",$values,array("id='{$_GET[uid]}'"));		
		header('location:user.php?act=new&msg=1');		
	}
	
if ($_GET['act']=="new")
{	
	$insertoredit = "
		<p>
			<input type='submit' id='submit' value='ذخیره'  />	 
			<input type='hidden' name='mark' value='saveuser' /> </p>";
}
if ($_GET['act']=="edit")
{
	$row=$db->Select("users","*","id='{$_GET["uid"]}'",NULL);	
	$insertoredit = "
	<p>
      	 <input type='submit' id='submit' value='ویرایش'  />	 
      	 <input type='hidden' name='mark' value='edituser' /> </p>";
}
if ($_GET['act']=="del")
{
	$db->Delete("users"," id",$_GET["uid"]);	
	header('location:user.php?act=new');	
}	
	
$msgs = GetMessage($_GET['msg']);

$html=<<<cd
	<!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                    تعرف کاربر
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
				    <div id="message">{$msgs}</div>
					<form class="plans" action="" method="post">
                        <p><span>نام و نام خانوادگی</span><input type="text" name="family" placeholder="نام و نام خانوادگی" value="{$row[family]}" /></p>
                        <p><span>ایمیل</span><input type="text" name="email" class="ltr" style="width:250px" placeholder="name@domain.com" value="{$row[email]}" /></p>
                        <p><span>نام کاربری</span><input type="text" name="username" placeholder="نام کاربری" value="{$row[username]}" /></p>
                        <p class="clear"></P>
                        <p><span>رمز عبور</span><input type="password" name="password" placeholder="رمز عبور"/></p>
                        <p><span>تکرار رمز عبور</span><input type="password" name="password" placeholder="تکرار رمز عبور"/></p>
						{$insertoredit}
					</form>
                    <div class="clear"></div>
                    <hr>
cd;
$rows = $db->SelectAll("users","*");
$table=<<<cd
<table class="datatable paginate sortable full">
    <thead class="rtl">
        <tr>	        
            <th><a href="#">نام و نام خانوادگی</a></th>
            <th><a href="#">ایمیل</a></th>
            <th><a href="#">نام کاربری</a></th>            
			<th style="width:70px"><a href="#">عملیات</a></th>	
        </tr>
    </thead>
	<tbody style="display: none;">
cd;
for($i = 0; $i < Count($rows); $i++)
{
 
if (($i+1)%10 == 0)
	
	$table.=<<<cd
	</tbody>
<tbody style="display: table-row-group;">
cd;

$table .=<<<cd
        <tr>		
            <td>{$rows[$i]["family"]}</td>
            <td>{$rows[$i]["email"]}</td>
            <td>{$rows[$i]["username"]}</td>            
			<td>
                <ul class="action-buttons">
                    <li><a href="?act=edit&uid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="pencil"></span></a></li>
                    <li><a href="?act=del&uid={$rows[$i]["id"]}" class="button button-gray no-text"><span class="bin"></span></a></li>
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
include_once("inc/header.php");
echo $html;
include_once("inc/footer.php"); 
?>