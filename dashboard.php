<?php
    require "head.php";

    if(!isset($_SESSION['email'])){
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
	</head>

	<body>
        <section id="main-menu">
            <?php
                require "menu.php";
            ?>
        </section>

        <section id="main-app">
            <?php
                $selectedPage = $_GET['page'];

               if($selectedPage == 'home'){
                    require "home.php";
                }
                else if($selectedPage == 'projects'){
                    require "projects.php";
                }
                else if($selectedPage == 'createproject'){
                    require "createproject.php";
                }
                else if($selectedPage == 'projectpage'){
                    require "project.php";
                }
                else if($selectedPage == 'addtrack'){
                    require "addtrack.php";
                }
            ?>
        </section>
        <!--<div id="dashboard">
            <section class="section-default">
                <div class="section-wrapper">
                    <div class="section-project-header">
                        <div class="section-project-title-wrapper">
                            <p class="header-title">Dashboard</p>
                        </div>
                    </div>

                    <div id="dashboard-page">
                        
                    </div>
                </div>
            </section>
        </div>-->
	</body>
</html>

<?php
    require "footer.php";
?>
