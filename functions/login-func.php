<?php

if(isset($_POST['login-submit'])){
    require 'dbhandler-func.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE useremail=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){
                $passwordcheck = password_verify($password, $row['userpassword']);
                if($passwordcheck == false){
                    header("Location: ../login.php?error=passwordfailed");
                    exit();
                }
                else if($passwordcheck == true){
                    session_start();
                    $_SESSION['email'] = $row['useremail'];

                    header("Location: ../dashboard.php");
                    exit();
                }
                else{
                    header("Location: ../login.php?error=passwordfailed");
                    exit();
                }
            }
            else{
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }

}
else{
    header("Location: ../login.php");
    exit();
}