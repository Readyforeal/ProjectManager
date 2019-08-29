<?php
    require "head.php";
?>

<!DOCTYPE html>
<html>
	<head>
	
	</head>

	<body>
		<section class="section-default">
			<div class="section-wrapper">
				<div class="form-login">
					<form action="functions/login-func.php" method="post">

						<input type="text" name="email" placeholder="Email..">
						<input type="password" name="password" placeholder="Password..">
						<button type="submit" name="login-submit">Login</button>

					</form>

					<p>Don't have an account? <a href="signup.php">Sign up</a></p>
				</div>
			</div>
		</section>
	</body>
</html>

<?php
    require "footer.php";
?>
