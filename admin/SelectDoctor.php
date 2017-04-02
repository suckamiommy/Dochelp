<?php

require("../connectdb.php");
$ID_member = $_POST['id'];
$sql = "SELECT * FROM doctor_details WHERE ID_doctor LIKE '".$ID_member."'";
$send = array();

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
		array_push($send, $row["Name"]);
    array_push($send, $row["Lastname"]);
    array_push($send, $row["Birthday"]);
    array_push($send, $row["Phone_number"]);
    array_push($send, $row["Email"]);
    array_push($send, $row["Province"]);
    array_push($send, $row["Hospital"]);
	}
} else {
		echo "0 results";
}

foreach ($send as $key => $value) {
	echo $value;
	echo '|';
}

$conn->close();

?>
