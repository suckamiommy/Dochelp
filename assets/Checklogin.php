<?php
require("../connectdb.php");
$loginstatus = $_POST['loginstatus'];
$id = $_POST['id'];
$pass = $_POST['pass'];

if($loginstatus==1){
  $sql = "SELECT * FROM user WHERE ID_user like '".$id."' and Password like '".$pass."'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      session_start();
      $_SESSION["user"] = $row['Username'];
      echo 1;
    }
  }else{
    echo 0;
  }
}else{
  $sql = "SELECT * FROM doctor WHERE ID_doctor like '".$id."' and Password like '".$pass."'";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      session_start();
      $_SESSION["user"] = $row['Doctorname'];
      echo 1;
    }
  }else{
    echo 0;
  }
}

$conn->close();
?>
