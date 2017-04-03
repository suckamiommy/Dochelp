<?php
require('../connectdb.php');
$doctor = $_POST['doctor'];
$user = $_POST['user'];
$sql = "INSERT INTO block(ID_doctor,ID_user) VALUES ('".$doctor."','".$user."')";
if($conn->query($sql) === TRUE){
  echo 1;
}else{
  echo 0;
}
$conn->close();
 ?>
