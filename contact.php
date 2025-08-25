<?php
	include("includes/header.php");
?>

<div id="content">
	<div class="post">
		<h2 class="title"><a href="#" style="color:black;">Contact Us</a></h2>
		<p class="meta"></p>
		<div class="entry">

			<!-- ✅ Success Message Display -->
			<?php
				if(isset($_SESSION['success'])) {
					echo '<p style="color: green; font-weight: bold;">'.$_SESSION['success'].'</p>';
					unset($_SESSION['success']); // ✅ Success message clear after showing
				}
			?>

			<table border="0" width="100%">
				<tr valign="top">
					<td width="100%">
						<form class="contact" action="contact_process.php" method="post" style="color:black;">
							
							Full Name :<br>
							<input type="text" name="fnm" class="txt" value="<?php echo isset($_SESSION['old']['fnm']) ? htmlspecialchars($_SESSION['old']['fnm']) : ''; ?>">
							<?php
								if(isset($_SESSION['error']['fnm']))
								{
									echo '<font color="red">'.$_SESSION['error']['fnm'].'</font>';
								}
							?>
							<br><br>

							Mobile No :<br>
							<input type="text" name="mno" class="txt" value="<?php echo isset($_SESSION['old']['mno']) ? htmlspecialchars($_SESSION['old']['mno']) : ''; ?>">
							<?php
								if(isset($_SESSION['error']['mno']))
								{
									echo '<font color="red">'.$_SESSION['error']['mno'].'</font>';
								}
							?>
							<br><br>

							E-Mail ID :<br>
							<input type="email" name="email" class="txt" value="<?php echo isset($_SESSION['old']['email']) ? htmlspecialchars($_SESSION['old']['email']) : ''; ?>">
							<?php
								if(isset($_SESSION['error']['email']))
								{
									echo '<font color="red">'.$_SESSION['error']['email'].'</font>';
								}
							?>
							<br><br>

							Message :<br>
							<textarea class="txt" name="msg"><?php echo isset($_SESSION['old']['msg']) ? htmlspecialchars($_SESSION['old']['msg']) : ''; ?></textarea>
							<?php
								if(isset($_SESSION['error']['msg']))
								{
									echo '<font color="red">'.$_SESSION['error']['msg'].'</font>';
								}
							?>
							<br><br>

							<input type="submit" class="btn" value="Submit" style="color:white;">

						</form>
					</td>
				</tr>
			</table>

		</div>
	</div>
</div><!-- end #content -->

<?php
	// ✅ Clear errors and old input after rendering
	unset($_SESSION['error']);
	unset($_SESSION['old']);

	include("includes/footer.php");
?>
