<?php

if(isset($_POST['signup-submit'])){
    require 'dbhandler-func.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordrepeated = $_POST['password-repeat'];

    //If any fields are empty
    if(empty($email) || empty($password) || empty($passwordrepeated)){
        header("Location: ../signup.php?error=emptyfields&email=".$email);
        exit();
    }
    //Invalid email and password
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $password)){
        header("Location: ../signup.php?error=invalidemailpass");
        exit();
    }
    //Invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }
    //Invalid password
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $password)){
        header("Location: ../signup.php?error=invalidpassword&mail=".$email);
        exit();
    }
    //Passwords do not match
    else if ($password !== $passwordrepeated){
        header("Location: ../signup.php?error=passwordcheck&email=".$email);
        exit();
    }
    else{

        $sql = "SELECT useremail FROM users WHERE useremail=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=error");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);

            if($resultCheck > 0){
                header("Location: ../signup.php?error=alreadyregistered&email=".$email);
                exit();
            }
            else{
                $sql = "INSERT INTO users (useremail, userpassword) VALUES (?, ?);";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=error");
                    exit();
                }
                else{
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
                    mysqli_stmt_execute($stmt);

                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else{
    header("Location: ../signup.php");
    exit();
}