<?php

    require 'dbhandler-func.php';

    session_start();

    $user = $_SESSION['email'];
    $project = $_GET['project'];
    $track = $_GET['track'];

    $sql = "SELECT projectname FROM projects WHERE projectname=? AND projectowner=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../dashboard.php?error=error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $project, $user);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        $sql = "DELETE FROM songs WHERE title=? AND projectowner=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../dashboard.php?error=error");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $track, $user);
            mysqli_stmt_execute($stmt);

            header("Location: ../dashboard.php?page=projectpage&project=".$row['projectname']."&artist=".$_GET['artist']);
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
