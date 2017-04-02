<?php

require("../connectdb.php");
$ID_member = $_POST['id'];
$sql = "DELETE FROM user_details WHERE ID_user LIKE '".$ID_member."'";
$sql_insert = "DELETE FROM user WHERE ID_user LIKE '".$ID_member."'";

if ($conn->query($sql)&&$conn->query($sql_insert) === TRUE) {
    echo 1;
} else {
    echo 0;
}

$conn->close();

?>
