<?php
require("../connectdb.php");
$send = json_decode($_POST['send']);
// insert table user
$sql_insert_user = "INSERT INTO user(ID_user, Password, Username)
VALUES ('".$send[0]->ID_user."','".$send[0]->Password."','".$send[0]->Username."')";
// insert table user_details
$sql_insert_user_details = "INSERT INTO user_details(ID_user, Name, Lastname, Birthday, Phone_number, Email, Condi, Decondi)
VALUES ('".$send[0]->ID_user."','".$send[0]->Name."','".$send[0]->Lastname."',
'".$send[0]->Birthday."','".$send[0]->Phone_number."','".$send[0]->Email."',
".(($send[0]->Condi=='')?"NULL":("'".$send[0]->Condi."'")).",".(($send[0]->Decondi=='')?"NULL":("'".$send[0]->Decondi."'")).")";
// insert picture default
$sql_pic = "INSERT INTO image_user VALUES ('".$send[0]->ID_user."','noimage.jpg')";
// run sql
if($conn->query($sql_insert_user) === TRUE){
  if($conn->query($sql_insert_user_details) === TRUE){
    $conn->query($sql_pic);
    echo 1;
  }else{
    echo 2;
  }
}else{
  echo 0;
}

$conn->close();
?>
