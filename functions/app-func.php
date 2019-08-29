<?php

    $pages = array(
        "home.php",
        "projects.php",
        "project.php",
        "createproject.php",
        "addtrack.php"
    );

    $selectedPage = $pages["home.php"];

    if(isset($_POST['home'])){
        $selectedPage = $pages["home.php"];
        header("Location: ../dashboard.php?page=home");
        exit();
    }

    if(isset($_POST['projects'])){
        $selectedPage = $pages["projects.php"];
        header("Location: ../dashboard.php?page=projects");
        exit();
    }

    if(isset($_POST['createproject-submit'])){
        $selectedPage = $pages["createproject.php"];
        header("Location: ../dashboard.php?page=createproject");
        exit();
    }

    if(isset($_POST['openproject-submit'])){
        $selectedPage = $pages["project.php"];
        header("Location: ../dashboard.php?page=projectpage&project=".$_GET['project']."&artist=".$_GET['artist']);
        exit();
    }

    
    if(isset($_POST['addtrack-submit'])){
        $selectedPage = $pages["addtrack.php"];
        header("Location: ../dashboard.php?page=addtrack&project=".$_GET['project']."&artist=".$_GET['artist']);
        exit();
    }

?>