<?php
    header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="fa"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Irana | Login page</title>

<link rel="stylesheet" media="screen" href="css/reset.css">
<link rel="stylesheet" media="screen" href="css/grid.css">
<link rel="stylesheet" media="screen" href="css/style.css">
<link rel="stylesheet" media="screen" href="css/messages.css">
<link rel="stylesheet" media="screen" href="css/forms.css">

<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<script src="js/PIE.js"></script>
<![endif]-->
<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.ui.min.js"></script>

<!--[if lte IE 9]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

<script src="js/global.js"></script>
<script> 
$(document).ready(function(){
    $.tools.validator.fn("#username", function(input, value) {
        return value!='Username' ? true : {     
            en: "Please complete this mandatory field"
        };
    });
    
    $.tools.validator.fn("#password", function(input, value) {
        return value!='Password' ? true : {     
            en: "Please complete this mandatory field"
        };
    });

    $("#form").validator({ 
    	position: 'top', 
    	offset: [25, 10],
    	messageClass:'form-error',
    	message: '<div><em/></div>' // em element is the arrow
    }).attr('novalidate', 'novalidate');
});
</script>
</head>
<body class="login">
    <div class="login-box main-content">
      <header><h2>ورود به پنل مدیرت شرکت ایرانا</h2></header>
    	<section>
    		<div class="message info"><p style="margin:0;font-size:15px;">نام کاربری و رمز عبور خود را وارد نمایید</p></div>
    		<form id="form" action="dashboard.html" method="post" class="clearfix" novalidate="novalidate">
    			<p>
    				<input type="text" id="username" class="full" value="" name="username" required="required" placeholder="نام کاربری">
    			</p>
    			<p>
    				<input type="password" id="password" class="full" value="" name="password" required="required" placeholder="رمز عبور">
    			</p>
    			<p class="clearfix">
    				<button class="button button-gray fr" type="submit">ورود</button>
    			</p>
    		</form>
    	</section>
    </div>
    <div class="apple_overlay black" id="overlay">
        <iframe class="contentWrap" style="width: 100%; height: 500px"></iframe>
    </div>
</body>
</html>