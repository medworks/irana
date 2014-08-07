<?php include_once("inc/header.php"); ?>

	<!-- Main Section -->
    <section class="main-section grid_7">
        <div class="main-content">
            <header>
                <h2>
                    تعرفه ها
                </h2>
            </header>
            <section class="container_6 clearfix">
                <div class="grid_6">
                    <h3 style="font-size:18px;">تعرفه طرح ها</h3>
					<hr>
					<form class="plans">
						<p><span>نام طرح</span><input type="text" name="plan" placeholder="طلایی - 3 گیگابایت - 3 ماهه" /></p>
						<p><span>مدت زمان (ماه)</span><input type="text" name="month" placeholder="1-12"/></p>
						<p><span>حجم (گیگابایت)</span><input type="text" name="volume" placeholder="1-99"/></p>
						<p style="padding-top:10px"><span>شبانه دارد</span><input type="checkbox" name="night" value="" /></p>
						<p style="padding-top:10px"><span>مودم دارد</span><input type="checkbox" name="modem" value="" /></p>
						<p class="clear"></p>
                        <p><span>درصد تخفیف</span><input type="text" name="percent" placeholder="1-100" /></p>
						<p><input type="submit" style="width:70px;height:35px" value="ثبت"/></p>
					</form>
                    <div class="clear"></div>
                    <hr>
                    <?php include_once("inc/table.php") ?>
                </div>
            </section>
        </div>
    </section>
    <!-- Main Section End -->

<?php include_once("inc/footer.php"); ?>