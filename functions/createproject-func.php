<?php

    require 'dbhandler-func.php';

    session_start();

    $user = $_SESSION['email'];
    $projectName = $_POST['newprojectname'];
    $projectType = $_POST['newprojecttype'];
    $projectArtist = $_POST['newprojectartist'];

    //If any fields are empty
    if(empty($projectName) || empty($projectType) || empty($projectArtist)){
        header("Location: ../dashboard.php?error=emptyfields");
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
            mysqli_stmt_bind_param($stmt, "s", $projectName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);

            if($resultCheck > 0){
                header("Location: ../dashboard.php?error=projectexists&projecttype=".$projectType);
                exit();
            }
            else{
                $sql = "INSERT INTO projects (projectowner, projectname, projecttype, projectartist) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../dashboard.php?error=error");
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "ssss", $user, $projectName, $projectType, $projectArtist);
                    mysqli_stmt_execute($stmt);

                    header("Location: ../dashboard.php?page=projects");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
