<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../../connect.php');
    $detail = $_POST['detail'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $ID_doctor = $_POST['ID_doctor'];

    $sql = "INSERT INTO answers (detail,name,email,question_id,ID_doctor)
    VALUES ('".$detail."','".$name."','".$email."',".$id.",'".$ID_doctor."')";
    $conn->query($sql);

    // update
    $query = $conn->query("UPDATE questions SET reply=reply+1 WHERE id = ".$id);
    if ($query == TRUE) {
      echo 1;
    }else{
      echo 0;
    }
    $conn->close();
}
?>
