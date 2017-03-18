<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dochelp";
$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
  die("Connection failed :" . $conn->connect_error);
}
$conn->query("set character set utf8");
?>
