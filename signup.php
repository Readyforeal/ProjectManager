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
                <div class="form-signup form-default">
                    <?php
                    
                    if(isset($_GET['error'])){
                        if($_GET['error'] === "emptyfields"){
                            echo"<p class='error-text'>Empty fields</p>";
                        }
                        else if($_GET['error'] === "invalidemailpass"){
                            echo"<p class='error-text'>Invalid email and password.</p>";
                        }
                        else if($_GET['error'] === "invalidemail"){
                            echo"<p class='error-text'>Please use a valid email.</p>";
                        }
                        else if($_GET['error'] === "invalidpassword"){
                            echo"<p class='error-text'>Unexpected characters used in password.</p>";
                        }
                        else if($_GET['error'] === "passwordcheck"){
                            echo"<p class='error-text'>Passwords do not match.</p>";
                        }
                        else if($_GET['error'] === "error"){
                            echo"<p class='error-text'>Unexpected error.</p>";
                        }
                        else if($_GET['error'] === "alreadyregistered"){
                            echo"<p class='error-text'>Email already registered.</p>";
                        }
                    }
                    
                    ?>
                    <form action="/functions/signup-func.php" method="post">

                        <input type="text" name="email" placeholder="Email..">
                        <input type="password" name="password" placeholder="Password..">
                        <input type="password" name="password-repeat" placeholder="Repeat password..">
                        <button type="submit" name="signup-submit">Sign up</button>

                    </form>

                    <p>Already have an account? <a href="login.php">Log in</a></p>
                </div>
            </div>
		</section>
	</body>
</html>

<?php
    require "footer.php";
?>