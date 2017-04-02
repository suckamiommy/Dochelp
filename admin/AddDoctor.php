<?php

require("../connectdb.php");
$Name = $_POST['Name'];
$Lastname = $_POST['Lastname'];
$Birthday = $_POST['Birthday'];
$phone = $_POST['phone'];
$Email = $_POST['Email'];
$province = $_POST['province'];
$hospital = $_POST['hospital'];
$ID_user = $_POST['id'];

$sql = "UPDATE doctor_details SET Name = '".$Name."', Lastname = '".$Lastname."',
Birthday = '".$Birthday."', Phone_number = '".$phone."', Email = '".$Email."',
Province = ".$province.", Hospital = ".$hospital." WHERE ID_doctor LIKE '".$ID_user."'";
if ($conn->query($sql) === TRUE) {
  echo "อัพเดทข้อมูล Doctor สำเร็จ";
} else {
  echo "ไม่สามารถอัพเดทข้อมูลของ Doctor ได้";
}

$conn->close();

?>
