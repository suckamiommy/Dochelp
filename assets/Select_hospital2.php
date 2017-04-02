<?php
require("../connectdb.php");
$id_province = $_POST['id'];
$id_hospital = $_POST['id_hospital'];
$sql = "SELECT * FROM hospital WHERE province_id = ".$id_province." AND hospital_id = ".$id_hospital;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<option value='".$row['hospital_id']."'>".$row['hospital_name']."</option>";
$sql2 = "SELECT * FROM hospital WHERE province_id = ".$id_province." AND hospital_id != ".$id_hospital;
$result2 = $conn->query($sql2);
if($result2->num_rows > 0){
  while ($row2 = $result2->fetch_assoc()) {
    echo "<option value='".$row2['hospital_id']."'>".$row2['hospital_name']."</option>";
  }
}else{
  echo "result 0 row";
}
$conn->close();
?>
