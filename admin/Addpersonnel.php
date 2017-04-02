<?php

require("../connectdb.php");
$Name = $_POST['Name'];
$Lastname = $_POST['Lastname'];
$Birthday = $_POST['Birthday'];
$phone = $_POST['phone'];
$Email = $_POST['Email'];
$condi = $_POST['condi'];
$Decondi = $_POST['Decondi'];
$ID_user = $_POST['id'];

$sql = "UPDATE user_details SET Name = '".$Name."', Lastname = '".$Lastname."',
Birthday = '".$Birthday."', Phone_number = '".$phone."', Email = '".$Email."',
Condi = ".(($condi=='')?"NULL":("'".$condi."'")).", Decondi = ".(($Decondi=='')?"NULL":("'".$Decondi."'"))."
WHERE ID_user LIKE '".$ID_user."'";
if ($conn->query($sql) === TRUE) {
  echo "อัพเดทข้อมูล User สำเร็จ";
} else {
  echo "ไม่สามารถอัพเดทข้อมูลของ User ได้";
}

$conn->close();

?>
