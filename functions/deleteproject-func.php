<?php

    require 'dbhandler-func.php';

    session_start();

    $user = $_SESSION['email'];
    $projectName = $_GET['project'];

    $sql = "SELECT projectname FROM projects WHERE projectname=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../dashboard.php?error=error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $projectName);
        mysqli_stmt_execute($stmt);


        $sql = "DELETE FROM projects WHERE projectname=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../dashboard.php?error=error");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $projectName);
            mysqli_stmt_execute($stmt);

            header("Location: ../dashboard.php?page=projects");
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
