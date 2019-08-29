<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/projects.css">
    </head>

    <body>
        <div class="section-group">
            <section class="section-default">
                <div class="section-wrapper">
                    <div class="section-project-header">
                        <div class="section-project-title-wrapper">
                            <p class="header-title">Home</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="section-default">
            <div class="section-wrapper">
                <div class="project-list">
                    <?php

                        $_projectName = "";
                        $_artist = "";

                        function FetchProjects(){
                            include 'functions/dbhandler-func.php';
                            
                            $sql = "SELECT * FROM projects WHERE projectowner=?;";
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "<p>Failed to load</p>";
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                
                                while($row = mysqli_fetch_assoc($result)){
                                    //echo("<form action='project.php?project=".$row['projectname']."' method='post'>");
                                    //echo("<button class='project-name' type='submit' name='openproject'>".$row['projectname']."</button>");
                                    //echo("</form>");
                                    //echo '<p>Project type: '.$row['projecttype'].'<p>';
                                    //echo '<p>Project artist: '.$row['projectartist'].'<p>';
                                    
                                    $projectName = htmlspecialchars(stripslashes($row['projectname']), ENT_QUOTES);
                                    $projectNameRaw = $row['projectname'];

                                    $artist = htmlspecialchars(stripslashes($row['projectartist']), ENT_QUOTES);
                                    $artistRaw = $row['artist'];

                                    echo("<div class='project-list-item'>");
                                        echo("<div class='project-list-item-name'><p>".$row['projectname']." </p></div>");
                                        echo("<div class='project-list-item-artist'><p>- ".$row['projectartist']."</p></div>");

                                        //echo("<form action='functions/deleteproject-func.php?project=".$projectName."' method='post'>");
                                        //    echo("<div class='project-list-item-button btn-bad'><button type='submit' name='deleteproject-submit'>Delete</button></div>");
                                        //echo("</form>");

                                        echo("<form action='functions/app-func.php?project=".$projectName."&artist=".$artist."' method='post'>");
                                            echo("<div class='project-list-item-button'><button type='submit' name='openproject-submit'>View project board</button></div>");
                                        echo("</form>");
                                    echo("</div>");

                                    $_projectName = $projectNameRaw;
                                    $_artist = $artistRaw;
                                }
                            }
                        }

                        FetchProjects();
                    ?>
                </div>
            </div>
        </section>
    </body>
</html>