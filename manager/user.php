<?php include_once("inc/header.php"); ?>

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
					<form class="plans">
                        <p><span>نام و نام خانوادگی</span><input type="text" name="family" placeholder="نام و نام خانوادگی"/></p>
                        <p><span>ایمیل</span><input type="text" name="email" class="ltr" style="width:250px" placeholder="name@domain.com"/></p>
                        <p><span>نام کاربری</span><input type="text" name="username" placeholder="نام کاربری"/></p>
                        <p class="clear"></P>
                        <p><span>رمز عبور</span><input type="password" name="password" placeholder="رمز عبور"/></p>
                        <p><span>تکرار رمز عبور</span><input type="password" name="password" placeholder="تکرار رمز عبور"/></p>
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