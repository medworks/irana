<?php
	include_once("inc/header.php");
	
	include_once("config.php");
    include_once("classes/database.php");
    include_once("classes/messages.php");
	include_once("classes/functions.php");
	include_once("/lib/persiandate.php");
  
    $db = Database::GetDatabase();
	$msg = Message::GetMessage();
$html =<<<cd
	<link rel="stylesheet" href="manager/css/tables.css" type="text/css">
	<link rel="stylesheet" href="manager/css/forms.css" type="text/css">

  	<script src="manager/js/jquery.tools.min.js"></script>
  	<script src="manager/js/jquery.ui.min.js"></script>
  	<script src="manager/js/jquery.tables.js"></script>
  	<style>
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
  	</style>

		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slogan">
					<h1>تعرفه طرح ها</h1>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<table class="datatable paginate sortable full">
					    <thead class="rtl">
					        <tr>
					            <th><a href="#">Browser</a></th>
					            <th><a href="#">Platform</a></th>
					            <th><a href="#">Table Cell</a></th>
					            <th><a href="#">Table Cell</a></th>
					            <th><a href="#">Table Cell</a></th>
					            <th style="width:70px"><a href="#"></a></th>
					        </tr>
					    </thead>
					    <tbody style="display: none;">
					        <tr>
					            <td>Firefox 3.0</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Firefox 3.0</td>
					            <td>OS X</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Firefox 3.6</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Firefox 3.6</td>
					            <td>OS X</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Firefox 3.6</td>
					            <td>Ubuntu</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Chrome 6.0</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Chrome 7.0</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Chrome 7.0</td>
					            <td>OS X</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Internet Explorer 6.0</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Internet Explorer 7.0</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					    </tbody>
					    <tbody style="display: table-row-group;">
					        <tr>
					            <td>Chrome 6.0</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					        <tr>
					            <td>Chrome 7.0</td>
					            <td>Windows</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>Table Cell</td>
					            <td>
					                <ul class="action-buttons">
					                    <li><a href="#" class="button button-gray no-text"><span class="pencil"></span></a></li>
					                    <li><a href="#" class="button button-gray no-text"><span class="bin"></span></a></li>
					                </ul>
					            </td>
					        </tr>
					    </tbody>
					</table>
					<div class="clearfix"></div>
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
  	