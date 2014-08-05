<?php
	include_once("inc/header.php");
?>
		<!-- Main content alpha -->
		<div class="main png_bg">
			<div class="inner_main">
			<!-- True containers (keep the content inside containers!) -->
				<div class="container_alpha slogan">
					<h1>شارژ و تمدید حساب</h1>
				</div>
				<div class="container_gamma slogan">
					<h3>
						1) لطفاً ایمیل و تلفن همراه معتبر وارد نمائید. در صورت پرداخت بصورت اینترنتی، اطلاعات خرید به این ایمیل و تلفن ارسال می شود.
					</h3></br>
					<h5>شماره خط: 5118555560</h5>
					<h5 style="margin-bottom:10px;">نوع حساب: برنزی 6 ماهه 3 گیگ+بدون شبانه</h5>
					<div style="direction:rtl">
						<form action="#" method="get">
							<strong style="font-size:18px;padding:0 5px 5px;display:block">نام و نام خانوادگی</strong><input style="width:30%;font-size:15px;" type="text" placeholder="نام و نام خانوادگی">
							<strong style="font-size:18px;padding:0 5px 5px;display:block">شماره همراه</strong><input style="width:30%;font-size:15px;" class="ltr latin-font" type="text" placeholder="09123456789">
							<strong style="font-size:18px;padding:0 5px px;display:block">ایمیل</strong><input style="width:30%;font-size:15px;" class="ltr" type="text" placeholder="name@domain.com">
						</form>
					</div>
				</div>
				<div class="container_gamma slogan" style="background:none">
					<h3>
						2) مشترک گرامی در صورت انتخاب گزینه تمدید، طرح درخواستی شما از زمان پرداخت فعال شده و میزان حجم و زمان به مانده قبلی شما اضافه خواهد شد، در غیر اینصورت از گزینه شارژ استفاده نمایید.
					</h3></br>
					<div style="direction:rtl;width:150px;float:right">
						<form class="action" action="#" method="get">
							<strong style="font-size:18px;padding:0 5px 15px;float:right">شارژ حساب</strong><input style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0" type="radio" checked name="plan" value="sharg">
							<strong style="font-size:18px;padding:0 5px 15px;float:right">تمدید حساب فعلی</strong><input style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0" class="ltr latin-font" type="radio" name="plan" value="tamdid">
							<strong style="font-size:18px;padding:0 5px 15px;float:right">تغییر حساب</strong><input style="width:15px;font-size:15px;box-shadow:none;float:right;margin:0" class="ltr" type="radio" name="plan" value="taghir">
						</form>
					</div>
					<script>
						$(document).ready(function(){
							$('form.action input').click(function(){
								var cureentAct= $(this).val();
								$(".toggler div.act").css("display","none");
								if (cureentAct=="sharg"){
									$(".toggler #sharg").css('display',"block");
								}
								if (cureentAct=="tamdid"){
									$(".toggler #tamdid").css('display',"block");
								}
								if (cureentAct=="taghir"){
									$(".toggler #taghir").css('display',"block");
								}
							});
						});
					</script>
					<div class="toggler open" style="direction:rtl;width:700px;float:right;padding-bottom:70px;">
						<div style="float:right;width:550px;">
							<!-- Sharj hesab -->
							<div id="sharg" class='act'>
								<h3>شارژ حساب</h3>
								<form action="#" method="get">
									<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">حجم به گیگابایت (بین 1 تا 99)</strong><input style="width:30%;font-size:15px;color:#000" class="ltr latin-font" type="text" placeholder="1-99">
								</form>
							</div>
							<!-- tamdid hesab feli -->
							<div id="tamdid" class='act activity'>
								<h3>تمدید حساب فعلی</h3>
								<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">طرح: <span style="color:#b24824">برنزی 6 ماهه 3 گیگ+بدون شبانه</span></strong>
								<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">حجم: <span style="color:#b24824">18 گیگابایت</span></strong>
								<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">زمان: <span style="color:#b24824">6 ماهه</span></strong>
							</div>
							<!-- taghir hesab -->
							<div id="taghir" class='act activity'>
								<h3>تغییر حساب</h3>
								<form action="#" method="get">
									<strong style="font-size:18px;padding:0 5px 5px;display:inline-block;color:#000">طرح: </strong>
										<select style="width:220px;height:28px;border-radius:8px;color:#b24824">
											<option value="">برنزی 6 ماهه 3 گیگ+بدون شبانه</option>
											<option value="">برنزی 6 ماهه 3 گیگ+بدون شبانه</option>
											<option value="">برنزی 6 ماهه 3 گیگ+بدون شبانه</option>
											<option value="">برنزی 6 ماهه 3 گیگ+بدون شبانه</option>
											<option value="">برنزی 6 ماهه 3 گیگ+بدون شبانه</option>
										</select>
									<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">حجم: <span style="color:#b24824">18 گیگابایت</span></strong>
									<strong style="font-size:18px;padding:0 5px 5px;display:block;color:#000">زمان: <span style="color:#b24824">6 ماهه</span></strong>
								</form>
							</div>
							<h4>پرداخت اینترنتی از طریق کلیه کارت های عضو شبکه شتاب امکان پذیر می باشد.</h4>
							<ul class="banks">
								<li><a title="بانک کشاورزی"><img src="images/banks/bankkeshavarzi.png" alt="بانک کشاورزی" /></a></li>
								<li><a title="بانک ملی"><img src="images/banks/bank-melli.png" alt="بانک ملی"  /></a></li>
								<li><a title="بانک پاسارگاد"><img src="images/banks/bankpasargad.png" alt="بانک پاسارگاد" /></a></li>
								<li><a title="بانک توسعه صادرات"><img src="images/banks/bank-tose-saderat.png" alt="توسعه صادرات"  /></a></li>
								<li><a title="بانک اقتصاد نوین"><img src="images/banks/enbank.png" alt="بانک اقتصاد نوین" /></a></li>
								<li><a title="بانک ملت"><img src="images/banks/mellat.png" alt="بانک ملت" /></a></li>
								<li><a title="بانک پارسیان"><img src="images/banks/parsian.png" alt="بانک پارسیان" /></a></li>
								<li><a title="بانک صادرات"><img src="images/banks/saderat.png" alt="بانک صادرات" /></a></li>
								<li><a title="بانک سامان"><img src="images/banks/saman.png" alt="بانک سامان" /></a></li>
								<li><a title="بانک صنعت و معدن"><img src="images/banks/sanato-maedan.png" alt="بانک صنعت و معدن" /></a></li>
								<li><a title="بانک سینا"><img src="images/banks/sina.png" alt="بانک سینا" /></a></li>
							</ul>
							<div class="clear"></div>
							<h3 style="color:#b24824">تذکر:</h3>
							<h4 style="margin-bottom:10px">1-کاربر گرامی با توجه به اینکه شارژ خریداری شده بلافاصله به حساب شما اضافه شده و قابل استفاده خواهد بود، امکان برگشت خرید انجام شده وجود ندارد.</h4>
							<h4>2-کاربر گرامی قیمت ارائه شده مطابق مصوبات سازمان تنظیم مقررات ارتباطات رادیوئی و شرکت مخابرات ایران می باشد و تنها با ابلاغ مصوبه جدید از سوی سازمان مذکور تغییر خواهد کرد.</h4>
						</div>
						<div class="pricing" style="border-left:0 none;border-right:0 none;margin:0">
							<div class="pricing_column" style="border-left:0 none;border-right:0 none;background:none">
								<div class="pricing_blurb" style="margin:0 !important;top: 10px;"><h3>مبلغ قابل پرداخت</h3><h2 style="margin:0;padding-top:0;">5000</h2><strong style="margin-right:57px;font-size:18px;color:#000">تومان</strong></div>
								<div class="specs"><p style="font-size:18px;margin-top:10px;">هزینه سرویس</p><p style="font-size:18px;">5000 تومان</p></div>
								<div class="specs"><p style="font-size:18px;padding-top:10px;">5% تخفیف</p></div>
								<div class="specs"><p style="font-size:18px"><img src="images/check.png" alt=""> مبلغ قابل پرداخت</p><p style="font-size:18px">5000 تومان</p></div>
								<div class="buyme"><p><a href="#" style="font-size:18px" class="superbutton">پرداخت</a></p></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /True containers (keep the content inside containers!) -->
    	</div>
    	<div class="endmain png_bg"></div>
		<!-- /Main content alpha -->
	</div>
  	<!--! end of #container -->
<?php
	include_once("inc/footer.php");
?>
  	