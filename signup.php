

<html>
<head>
	<meta charset="utf-8">
	<title>Signup</title>
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
 	<link href="css/signup.css" rel="stylesheet" type="text/css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>

<body>
	<div class="signup">
		<h1>Sign Up</h1> 
		<?php
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfields"){
                    echo "<p style='color:red;'> Fill in all fields! </p>";
                } else if($_GET['error'] == "takenUsername"){
                    echo "<p style='color:red;'> This username already exists in the system! </p>";
                } else if($_GET['error'] == "existingAcc"){
                    echo "<p style='color:red;'> You already have an account! </p>";
                }
            }
        ?>
		<form action="script/registration.php" method="post" align="center">
			<!-- <input type="text" name="username" placeholder="Username" id="username" required> -->
            
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="newUsername" name="Username">
				<label class="mdl-textfield__label" for="newUsername">Username</label>
			</div>

			<br>
            
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="number" id="monashId" name="MonashId">
				<label class="mdl-textfield__label" for="monashId">Monash ID</label>
			</div>

			<br>
            
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="fullName" name="FullName">
				<label class="mdl-textfield__label" for="fullName">Full Name</label>
			</div>

			<br>
            
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input type="password" class="mdl-textfield__input" type="text" id="newPassword" name="Password">
				<label class="mdl-textfield__label" for="newPassword">Password</label>
			</div>

			<br>
            
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="email" name="Email">
				<label class="mdl-textfield__label" for="email">E-mail</label>
			</div>

			<br>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" name= "signup" value="Student" type="submit">
				Sign up as a STUDENT
			</button>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name = "signup" value = "Teacher" type ="submit">
				Sign up as a TEACHER
			</button>
		</form>
		<br>
	</div>
</body>

</html>
