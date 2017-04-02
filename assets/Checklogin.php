<?php
require("../connectdb.php");
$loginstatus = $_POST['loginstatus'];
$id = $_POST['id'];
$pass = $_POST['pass'];

if($loginstatus==1){
  $sql = "SELECT Name,Email,user.ID_user FROM user INNER JOIN user_details ON user.ID_user = user_details.ID_user
  WHERE user.ID_user LIKE '".$id."' AND user.Password LIKE '".$pass."'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      session_start();
      $_SESSION["user"] = array("name"=>$row['Name'],"email"=>$row['Email'],"id"=>$row['ID_user']);
      echo 1;
    }
  }else{
    echo 0;

  }
}else{
  $sql = "SELECT Name,Email,doctor.ID_doctor FROM doctor INNER JOIN doctor_details ON doctor.ID_doctor = doctor_details.ID_doctor
  WHERE doctor.ID_doctor LIKE '".$id."' AND doctor.Password LIKE '".$pass."'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      session_start();
      $_SESSION["doctor"] = array("name"=>$row['Name'],"email"=>$row['Email'],"id"=>$row['ID_doctor']);
      echo 2;
    }
  }else{
    echo 0;
  }
}

$conn->close();
?>
