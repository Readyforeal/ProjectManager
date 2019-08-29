<?php

    require 'dbhandler-func.php';

    session_start();

    $user = $_SESSION['email'];
    $projectName = $_GET['project'];
    $trackTitle = $_POST['tracktitle'];
    $artist = $_GET['artist'];
    $trackGenre = $_POST['trackgenre'];
    $minutes = $_POST['lengthmin'];
    $seconds = $_POST['lengthsec'];
    $bpm = $_POST['bpm'];
    $lyrics = $_POST['lyrics'];

    //If any fields are empty
    if(empty($trackTitle)){
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

            $sql = "INSERT INTO songs (project, projectowner, artist, title, genre, lengthminute, lengthsecond, bpm, lyrics) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../dashboard.php?error=error");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "sssssiiis", $projectName, $user, $artist, $trackTitle, $trackGenre, $minutes, $seconds, $bpm, $lyrics);
                mysqli_stmt_execute($stmt);

                header("Location: ../dashboard.php?page=projectpage&project=".$projectName."&artist=".$artist);
                exit();
            }

        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
