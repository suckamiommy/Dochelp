<?php
require("../connectdb.php");
$id_province = $_POST['id'];
$sql = "SELECT * FROM hospital WHERE province_id = ".$id_province;
echo $sql;
$result = $conn->query($sql);
if($result->num_rows > 0){
  echo "<option value=''>กรุณาเลือกโรงพยาบาล</option>";
  while ($row = $result->fetch_assoc()) {
    echo "<option value='".$row['hospital_id']."'>".$row['hospital_name']."</option>";
  }
}else{
  echo "result 0 row";
}
?>
