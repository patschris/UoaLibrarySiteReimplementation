<div class="firstDiv"></div>
<div class="Login">
	<div class="dropdown" id="menuLogin">
		<a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogout"><span class="glyphicon glyphicon-user"></span>  <i><?php echo $_SESSION['username']; ?></i></a>
		<div class="dropdown-menu" id="logout">
			<form action="logout_post.php" method="post">
				<a href="profile.php">Το προφίλ μου</a><br>
				<input name="signout" type="submit" id="btnLogout" class="btn btn-warning" value="Αποσύνδεση">
			</form>
		</div>
	</div>
</div>