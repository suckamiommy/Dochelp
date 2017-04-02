<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dochelp";
$conn = new mysqli($servername,$username,$password,$dbname);
$conn->query("set character set utf8");
?>
