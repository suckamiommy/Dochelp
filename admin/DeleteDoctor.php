<?php

require("../connectdb.php");
$ID_member = $_POST['id'];
$sql = "DELETE FROM doctor_details WHERE ID_doctor LIKE '".$ID_member."'";
$sql_insert = "DELETE FROM doctor WHERE ID_doctor LIKE '".$ID_member."'";

if ($conn->query($sql)&&$conn->query($sql_insert) === TRUE) {
    echo 1;
} else {
    echo 0;
}

$conn->close();

?>
