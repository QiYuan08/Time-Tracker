<?php
	// link the header of the html file
	require "header.php";
?>

	<main>
		<div class="login">
			<h1 >Login</h1>
            <?php
				if(isset($_GET['error'])){
					echo "<p style='color:red;'>Invalid username or password</p>";
				}
			?>
			<form action="script/login.php" method="post" align="center">
				<!-- <input type="text" name="username" placeholder="Username" id="username" required> -->
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="text" id="username" name="username" >
					<!-- <span class="error" required>* <?php echo $usernameErr;?></span> -->
					<label class="mdl-textfield__label" for="username">Username</label>

				</div>

				<br>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input  type="password" class="mdl-textfield__input" type="text" id="password" name="password" >
					<!-- <span class="error" required>* <?php echo $usernameErr;?></span> -->
					<label class="mdl-textfield__label" for="password">Password</label>
                </div>

				<br>
				<button name="loginBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					Login
				</button>
			</form>
			<br>
			<p>Not registered yet? <a href=' ./signup.php'>Register Here</a></p>
            <br>
			<br>
			<p>In case of emergencies: <br>Contact fit2107group@gmail.com or <br>Call +08 1300 888 333</p>
		</div>
	</main>

<?php
	// link to the footer file
	require "footer.php";
?>
