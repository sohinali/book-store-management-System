<?php
	include("includes/header.php");
?>

<div id="content">
	<div class="post">
		<h2 class="title"><a href="#" style="color:black;">Search : <?php echo $_GET['s']; ?></a></h2>
			<p class="meta"></p>
			<div class="entry">

				<?php
					include("includes/connection.php");

					$s=$_GET['s'];

					$blq="select * from book where b_nm like '%$s%'";

					$blres=mysqli_query($blq,$mysqli);

					while($blrow=mysqli_fetch_assoc($blres))
					{
						echo '<div class="book_box">
								<a href="book_detail.php?id='.$blrow['b_id'].'">
									<img src="'.$blrow['b_img'].'">
									<h2>'.$blrow['b_nm'].'</h2>
									<p>Rs. '.$blrow['b_price'].'</p>
								</a>
							</div>';
					}
				?>
				
				<div style="clear:both;"></div>

			</div>
	</div>
</div><!-- end #content -->

<?php
	include("includes/footer.php");
?>