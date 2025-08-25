<?php
	session_start();
?>

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> -->
<!Doctype html>
<html>
<head>
<title>Book store </title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width", initial-scale=1.0>

<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<div id="navbar" style="text-align: center;">
    <!-- <h1><a href="#" style="color: black;">Book store Management System</a></h1><br> -->

    <div style="background-color: black; display: flex; justify-content: center;">

        <li style="display: inline; margin-right:300px; padding: 10px;"><a href="index.php" style="color: white; text-decoration: none; font-size: 30px;" >Book Store </a></li>

        <ul style="list-style: none; padding: 10px; margin: 0;">
              <li style="display: inline; margin-right: 20px; padding: 10px;"><a href="index.php" style="color: white; text-decoration: none;">Home</a></li>

            <?php
            if (isset($_SESSION['client']['status'])) {
                echo '<li style="display: inline; margin-right: 20px; padding: 10px;"><a href="logout.php" style="color: white; text-decoration: none;">Logout</a></li>';
                 echo'<li style="display: inline; margin-right: 20px; padding: 10px;"><a href="show_orders.php" style="color: white; text-decoration: none;">Orders</a></li>';
            } else {
                echo '<li style="display: inline; margin-right: 20px; padding: 10px;"><a href="login.php" style="color: white; text-decoration: none;">Login</a></li>';
                echo '<li style="display: inline; margin-right: 20px; padding: 10px;"><a href="register.php" style="color: white; text-decoration: none;">Register</a></li>';
            }
            ?>

            <li style="display: inline; margin-right: 20px; padding: 10px;"><a href="contact.php" style="color: white; text-decoration: none;">Contact Us</a></li>
            <li style="display: inline; margin-right: 20px; padding: 10px;"><a href="cart.php" style="color: white; text-decoration: none;">Cart</a></li>
        </ul>

        <div>
            <form method="get" action="search.php">
                <div style="margin-top:15px">
                    <input type="text" name="s" id="search-text" size="15" placeholder="Search" style="color:black; display: inline;" />
                    <input type="submit"  value="GO" style="background-color:black; color : white;" />
                </div>
            </form>
        </div>
    </div>
</div>

	<!-- end #header -->
	<!-- end #header-wrapper -->
	<div id="page">
