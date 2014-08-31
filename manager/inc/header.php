<?php
    header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Irana | Admin page</title>

<link rel="stylesheet" media="screen" href="css/reset.css">
<link rel="stylesheet" media="screen" href="css/grid.css">
<link rel="stylesheet" media="screen" href="css/style.css">
<link rel="stylesheet" media="screen" href="css/messages.css">
<link rel="stylesheet" media="screen" href="css/forms.css">
<link rel="stylesheet" media="screen" href="css/tables.css">

<!--[if lt IE 8]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<![endif]-->

<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.tables.js"></script>

<script type="text/javascript" src="js/global.js"></script>

<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/PIE.js"></script>
<script type="text/javascript" src="js/IE9.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

</head>
<body>
    <div id="wrapper">
        <header style="opacity: 1;">
            <div class="container_8 clearfix">
                <h1 class="grid_1" style="font-size:20px;"><a href="http://www.ir2020.ir">شرکت ایرانا</a></h1>
                <nav class="grid_5" style="width:750px;">
                    <ul class="clearfix" style="font-size:15px;">
                        <li><a href="admin.php?act=ord">لیست سفارشات</a></li>
                        <li><a href="admin.php?act=confirmed">لیست تایید شده</a></li>
                        <li><a href="paymentlist.php">لیست پرداختی ها</a></li>
                        <li><a href="plans.php?act=new">تعرفه طرح ها</a></li>
                        <li><a href="volume.php?act=new">تعرفه حجم ها</a></li>
                        <li class="fl">
                            <a href="#">عملیات<span class="arrow-down"></span></a>
                            <ul>
                                <li><a href="setting.php">تنظیمات</a></li>
                                <li><a href="sms.php">اس ام اس</a></li>
                                <li><a href="bankset.php">تنظیمات درگاه</a></li>
                                <li><a href="user.php?act=new">تعریف کاربر</a></li>
                                <li><a href="admin.php?act=logout">خارج شدن</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <section>
        <div class="container_8 clearfix">
            <!-- Sidebar -->
            <aside class="grid_1">
                <nav class="global">
                    <ul class="clearfix">
                        <li><a class="nav-icon icon-house" href="admin.php?act=ord">لیست سفارشات</a></li>
                        <li><a class="nav-icon icon-tick" href="admin.php?act=confirmed">لیست تایید شده</a></li>
                        <li><a class="nav-icon icon-note" href="plans.php?act=new">تعرفه طرح ها</a></li>
                        <li><a class="nav-icon icon-book" href="volume.php?act=new">تعرفه حجم ها</a></li>
                    </ul>
                </nav>
            </aside>
            <!-- Sidebar End -->