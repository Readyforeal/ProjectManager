<?php

$servername = "localhost:3306";
$dbusername = "root";
$dbpassword = "musicalFusion123";
$dbname = "Test";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if(!$conn){
    die("Zoinks!: ".mysqli_connect_error());
}