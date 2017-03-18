<?php
require("../connectdb.php");
$send = json_decode($_POST['send']);
// insert table user
$sql_insert_doctor = "INSERT INTO doctor(ID_doctor, Password, Doctorname)
VALUES ('".$send[0]->ID_doctor."','".$send[0]->Password."','".$send[0]->Username."')";
// insert table user_details
$sql_insert_doctor_details = "INSERT INTO doctor_details(ID_doctor, Name, Lastname, Birthday, Phone_number, Email, Province, Hospital)
VALUES ('".$send[0]->ID_doctor."','".$send[0]->Name."','".$send[0]->Lastname."',
'".$send[0]->Birthday."','".$send[0]->Phone_number."','".$send[0]->Email."',".$send[0]->Province.",".$send[0]->Hospital.")";
// run sql
if($conn->query($sql_insert_doctor) === TRUE){
  if($conn->query($sql_insert_doctor_details) === TRUE){
    echo 1;
  }else{
    echo 2;
  }
}else{
  echo 0;
}

$conn->close();
?>
