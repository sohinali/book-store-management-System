<div id="sidebar">

			<?php
				if(isset($_SESSION['client']['status']))
				{
					  echo '<ul>
					    		<li>
					    			<h2>Hi : '.$_SESSION['client']['unm'].'</h2>
					    			<ul>
					    				<li><a href="logout.php">Log Out</a></li>
					    			</ul>
					    		</li>
					    	</ul>';
				}
			?>

			<?php

include("includes/connection.php");

$cat_q = "select * from category order by cat_nm asc";
$cat_res = mysqli_query($mysqli, $cat_q);

echo '<ul>
        <li>
            <h2>Category</h2>
            <ul>';

while ($cat_row = mysqli_fetch_assoc($cat_res)) {
    echo '<li><a href="book_list.php?id=' . $cat_row['cat_id'] . '&cat=' . $cat_row['cat_nm'] . '">' . $cat_row['cat_nm'] . '</a></li>';
}

echo '</ul>
        </li>
      </ul>';

?>

		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
	<div id="footer">
		<p style="color:black;font-size: 15px" ; >&copy; 2023. All rights reserved. Project Made By <a href="index.php" rel="nofollow" style="color:black;">Sohin Ali</a>.</p>
	</div>
	<!-- end #footer -->
</body>
</html>