<?php
    require "head.php";
?>

<div id="header">
    <div id="header-wrapper">
        <div id="site-title">
            <div id="site-title-wrapper">
                <p id="site-title-text">Session</p>
            </div>
        </div>
        <div id="site-nav">
            <div id="site-nav-wrapper">
                <div id="site-nav-acct-btns">
                    <?php
                        if(isset($_SESSION['email'])){
                            echo("<form action='functions/logout-func.php' method='post'>");
                            echo("<button type='submit' name='logout-submit'>Logout</button>");
                            echo("</form>");
                        }
                        else{
                            echo("<form action='login.php' method='post'>");
                            echo("<button type='submit' name='login-submit'>Log in</button>");
                            echo("</form>");
                            echo("<form action='signup.php' method='post'>");
                            echo("<button type='submit' name='signup-submit'>Sign up</button>");
                            echo("</form>");
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="site-user-info">
            <div id="site-user-info-wrapper">
                <?php
                    if(isset($_SESSION['email'])){
                        echo("<p id='site-user-info-text'>Logged in as ".$_SESSION['email']."</p>");
                    }
                ?>
            </div>
        </div>
    </div>
</div>