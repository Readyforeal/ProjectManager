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
        <link rel="stylesheet" type="text/css" href="css/addtrack.css">
	</head>

	<body>
        <section class="section-default">
            <div class="section-wrapper">
                <div id="section-track-add" class="form-default">
                    <form action="functions/addtrack-func.php?project=<?php echo($_GET['project'])?>&artist=<?php echo($_GET['artist'])?>" method="post">
                        <input id="title" type="text" name="tracktitle" placeholder="Track Name..">
                        <input id="genre" type="text" name="trackgenre" placeholder="Genre..">
                        <input id="minutes" type="number" name="lengthmin" min="0" max="60" placeholder="M">
                        <input id="seconds" type="number" name="lengthsec" min="0" max="60" placeholder="S">
                        <input id="bpm" type="number" name="bpm" min="1" max="512" placeholder="BPM">
                        <br>
                        <br>
                        <br>
                        <textarea id="lyrics" name="lyrics" placeholder="Lyrics.."></textarea>
                        <br>
                        <br>
                        <button type="submit" name="addtrack-submit">+ Add track</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>