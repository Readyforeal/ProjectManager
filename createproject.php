<?php
    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
        exit();
    }

    require "head.php";
?>

<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/createproject.css">
	</head>

	<body>
        <section class="section-default">
            <div class="section-wrapper">
                <div id="section-project-add">
                    <form class="form-default" action="functions/createproject-func.php" method="post">
                        <input type="text" name="newprojectname" placeholder="Project Name..">
                        <input type="text" name="newprojectartist" placeholder="Project Artist..">
                        <select name="newprojecttype">
                            <option selected="selected">Project type</option>
                            <option value="single">Single</option>
                            <option value="ep">EP</option>
                            <option value="album">Album</option>
                        </select>
                        <br>
                        <br>
                        <br>
                        <button type="submit" name="createproject-submit">Create Project</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>