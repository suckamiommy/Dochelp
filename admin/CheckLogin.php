<?php

require("../connectdb.php");
$id = $_POST['login_admin'];
$password = $_POST['login_password_admin'];
$sql = "SELECT * FROM admin WHERE ID LIKE '".$id."' AND Password LIKE '".$password."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    session_start();
		$_SESSION["admin"] = $row['Name'];
	}
  $url = 'personnel.php';
  header( "Location: $url" );
} else {
  http_response_code(404);
  header("HTTP/1.0 404 Not Found");
  die();
}

$conn->close();

?>
