<?php
    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/project.css">
        <link rel="stylesheet" type="text/css" href="css/projects.css">
        <link rel="stylesheet" type="text/css" href="css/projectfeed.css">
	</head>

	<body>

        <!--Page header-->
        <!--Styling / style.css-->

        <section class="section-default">
            <div class="section-wrapper">
                <?php
                    include_once 'functions/dbhandler-func.php';

                    $sql = "SELECT * FROM projects WHERE projectowner=? AND projectname=?;";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "<p>Failed to load</p>";
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "ss", $_SESSION['email'], $_GET['project']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while($row = mysqli_fetch_assoc($result)){

                            ?>

                            <div class='section-project-header'>
                                <div class='section-project-title-wrapper'>
                                    <p class='header-title'><?php echo(ucwords($row['projectname']))?></p>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <!--
                            <p class='section-project-info'>Project info</p>
                            <p class="section-project-subtitle">Producer - <?php echo($row['projectowner'])?><p>
                            <p class="section-project-subtitle">Artist - <?php echo($row['projectartist'])?><p>
                            <p class="section-project-subtitle">Type - <?php echo($row['projecttype'])?><p>-->
                            <?php
                        }
                    }
                ?>
            </div>
        </section>

        <!--Tracks section-->
        <!--Styling / projectfeed.css-->
        
        <div class="section-group section-group-half">
            <section class="section-default">
                <div class="section-wrapper">
                    <div class='section-project-header'>
                        <div class='section-project-title-wrapper'>
                            <p class='header-title'>Feed</p>
                        </div>
                    </div>

                    <div id="projectfeed-section">
                        <div id="projectfeed-createpost">
                            <form class="form-default" action="functions/createpost-func.php?poster=<?php echo($_SESSION['email'])?>&project=<?php echo($_GET['project'])?>&artist=<?php echo($_GET['artist'])?>" method="post">
                                <textarea name="content" placeholder="Say something!"></textarea>
                                <button type="submit">Post</button>
                            </form>
                        </div>

                    <!--Pull feed from database-->

                        <div class="projectfeed-posts">
                            <?php
                                include_once 'functions/dbhandler-func.php';

                                $sql = "SELECT * FROM posts WHERE postproject=? ORDER BY postdatetime DESC;";
                                $stmt = mysqli_stmt_init($conn);

                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    echo "<p>Failed to load</p>";
                                }
                                else{
                                    mysqli_stmt_bind_param($stmt, "s", $_GET['project']);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        //echo("<form action='project.php?project=".$row['projectname']."' method='post'>");
                                        //echo("<button class='project-name' type='submit' name='openproject'>".$row['projectname']."</button>");
                                        //echo("</form>");
                                        //echo '<p>Project type: '.$row['projecttype'].'<p>';
                                        //echo '<p>Project artist: '.$row['projectartist'].'<p>';
                                        
                                        $content = htmlspecialchars(stripslashes($row['postcontent']), ENT_QUOTES);
                                        $poster = $row['poster'];
                                        $dateTime = $row['postdatetime'];

                                        echo("<div class='projectfeed-post'>");
                                            echo("<div class='projectfeed-post-poster'><p>".$poster." on ".date('F d, g:ma', strtotime($dateTime))."</p></div>");
                                            echo("<div class='projectfeed-post-content'><p>".$content."</p></div>");

                                            //echo("<form action='functions/deletetrack-func.php?project=".$_GET['project']."&track=".$row['title']."&artist=".$_GET['artist']."' method='post'>");
                                            //    echo("<div class='project-list-item-button btn-bad'><button type='submit' name='deletetrack-submit'>Delete</button></div>");
                                            //echo("</form>");
                                        echo("</div>");
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!--Tracks section-->
        <!--Styling / projecttracks.css-->
            
        <div class="section-group section-group-half">
            <section class="section-default">
                <div class="section-wrapper">
                    <div class='section-project-header'>
                        <div class='section-project-title-wrapper'>
                            <p class='header-title'>Tracks</p>
                        </div>
                        <div class="section-header-button">
                            <form action="functions/app-func.php?project=<?php echo($_GET['project'])?>&artist=<?php echo($_GET['artist'])?>" method="post">
                                <button type="submit" name="addtrack-submit">Add track</button>
                            </form>
                        </div>
                    </div>

                    <div class="project-list">
                        <?php
                            include_once 'functions/dbhandler-func.php';

                            $sql = "SELECT * FROM songs WHERE project=?;";
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "<p>Failed to load</p>";
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "s", $_GET['project']);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                
                                while($row = mysqli_fetch_assoc($result)){
                                    //echo("<form action='project.php?project=".$row['projectname']."' method='post'>");
                                    //echo("<button class='project-name' type='submit' name='openproject'>".$row['projectname']."</button>");
                                    //echo("</form>");
                                    //echo '<p>Project type: '.$row['projecttype'].'<p>';
                                    //echo '<p>Project artist: '.$row['projectartist'].'<p>';
                                    
                                    $trackTitle = htmlspecialchars(stripslashes($row['title']), ENT_QUOTES);

                                    echo("<div class='project-list-item'>");
                                        echo("<div class='project-list-item-name'><p>".$row['title']." </p></div>");

                                        //echo("<form action='functions/deletetrack-func.php?project=".$_GET['project']."&track=".$row['title']."&artist=".$_GET['artist']."' method='post'>");
                                        //    echo("<div class='project-list-item-button btn-bad'><button type='submit' name='deletetrack-submit'>Delete</button></div>");
                                        //echo("</form>");
                                    echo("</div>");
                                }
                            }
                        ?>
                    </div>
                </div>
            </section>
        </div>


	</body>
</html>

<?php
    require "footer.php";
?>
