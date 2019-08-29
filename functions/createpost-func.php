<?php

    require 'dbhandler-func.php';

    session_start();

    $user = $_SESSION['email'];
    $projectName = $_GET['project'];
    $content = $_POST['content'];
    //$dateTime = date("Y-m-d H:i:s");

    //If any fields are empty
    if(empty($content)){
        header("Location: ../dashboard.php?page=project&error=emptyfields");
        exit();
    }
    else{

        $sql = "SELECT projectname FROM projects WHERE projectname=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../dashboard.php?error=error");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $projectname);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            $sql = "INSERT INTO posts (poster, postproject, postcontent, postdatetime) VALUES (?, ?, ?, now());";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../dashboard.php?error=error");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "sss", $user, $projectName, $content);
                mysqli_stmt_execute($stmt);

                header("Location: ../dashboard.php?page=projectpage&project=".$projectName."&artist=".$_GET['artist']);
                exit();
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }