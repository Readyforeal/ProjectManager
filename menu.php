<?php
    require "head.php";
    include "icons/";
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/mainmenu.css">
    </head>

    <body>
        <div id="main-menu">
            <div id="menu-header" class="menu-section">
                <?php
                    echo($_SESSION['email']);
                ?>
            </div>

            <div id="menu-buttons" class="menu-section">
                <form action="functions/app-func.php" method="post">
                    <button type="submit" name="home">Home</button>
                </form>

                <form action="functions/app-func.php" method="post">
                    <button type="submit" name="projects">Projects</button>
                </form>
            </div>
        </div>
    </body>
</html>