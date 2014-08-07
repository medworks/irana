<?php include_once("inc/header.php"); ?>

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
					<form class="plans">
                        <p><span>از حجم</span><input type="text" name="volume1" placeholder="از حجم"/></p>
                        <p><span>تا حجم</span><input type="text" name="volume2" placeholder="تا حجم"/></p>
                        <p><span>با درصد تخفیف</span><input type="text" name="username" placeholder="1-100"/></p>
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