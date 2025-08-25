<?php
	include("includes/header.php");
?>

<div id="content">
	<div class="post">
		<h2 class="title"><a href="#" style="color:black;">User Registration</a></h2>
		<p class="meta"></p>
		<div class="entry" style="color:black;">
			
			<form class="register" action="register_process.php" method="post">
				
				<?php
					if(isset($_GET['register']))
					{
						echo '<font color="green">Registered Successfully.</font>';
						echo '<br><br>';
					}
				?>

				Full Name :<br>
				<input type="text" name="fnm" class="txt" value="<?= $_SESSION['form_data']['fnm'] ?? '' ?>">
				<?php if(isset($_SESSION['error']['fnm'])) echo '<font color="red">'.$_SESSION['error']['fnm'].'</font>'; ?>
				<br><br>

				User Name :<br>
				<input type="text" name="unm" class="txt"  value="<?= $_SESSION['form_data']['unm'] ?? '' ?>">
				<?php if(isset($_SESSION['error']['unm'])) echo '<font color="red">'.$_SESSION['error']['unm'].'</font>'; ?>
				<br><br>

				Password :<br>
				<input type="password" name="pwd" class="txt"  value="<?= $_SESSION['form_data']['pwd'] ?? '' ?>"><br>
				<?php if(isset($_SESSION['error']['pwd'])) echo '<font color="red">'.$_SESSION['error']['pwd'].'</font>'; ?>
				<br><br>

				Confirm Password :<br>
				<input type="password" name="cpwd" class="txt"><br>
				<?php if(isset($_SESSION['error']['cpwd'])) echo '<font color="red">'.$_SESSION['error']['cpwd'].'</font>'; ?>
				<br><br>


				E-Mail :<br>
				<input type="text" name="email" class="txt" value="<?= $_SESSION['form_data']['email'] ?? '' ?>">
				<?php if(isset($_SESSION['error']['email'])) echo '<font color="red">'.$_SESSION['error']['email'].'</font>'; ?>
				<br><br>

				Contact No :<br>
				<input type="text" name="cno" class="txt" value="<?= $_SESSION['form_data']['cno'] ?? '' ?>">
				<?php if(isset($_SESSION['error']['cno'])) echo '<font color="red">'.$_SESSION['error']['cno'].'</font>'; ?>
				<br><br>

				Security Question :<br>
				<select name="question" class="txt">
					<option <?= (isset($_SESSION['form_data']['question']) && $_SESSION['form_data']['question'] == "Which is your Favourite Movie ?" ? "selected" : "") ?>>Which is your Favourite Movie ?</option>
					<option <?= (isset($_SESSION['form_data']['question']) && $_SESSION['form_data']['question'] == "Which is your Favourite Actress ?" ? "selected" : "") ?>>Which is your Favourite Actress ?</option>
				</select>
				<?php if(isset($_SESSION['error']['que'])) echo '<font color="red">'.$_SESSION['error']['que'].'</font>'; ?>
				<br><br>

				Security Answer :<br>
				<input type="text" name="answer" value="<?= $_SESSION['form_data']['answer'] ?? '' ?>">
				<?php if(isset($_SESSION['error']['answer'])) echo '<font color="red">'.$_SESSION['error']['answer'].'</font>'; ?>
				<br><br>

				<input type="submit" class="btn" value="Register">

				<p class="login_link">
					<a href="login.php" style="margin-left: 145px; color : black ; text-decoration: none">Already have an account? Login</a>
				</p>

			</form>

			<?php
				unset($_SESSION['error']);
				unset($_SESSION['form_data']);
				unset($_GET['register']);
			?>

		</div>
	</div>
</div><!-- end #content -->

<?php
	include("includes/footer.php");
?>
