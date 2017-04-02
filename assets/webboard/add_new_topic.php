<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../../connect.php');
    $topic = $_POST['topic'];
    $detail = $_POST['detail'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    $sql = "INSERT INTO questions (topic,detail,name,email,created,ID_user)
    VALUES ('".$topic."','".$detail."','".$name."','".$email."',NOW(),'".$id."')";
    $query = $conn->query($sql);
    if ($query == TRUE) {
      echo 1;
    }else{
      echo 0;
    }
    $conn->close();
}
?>
