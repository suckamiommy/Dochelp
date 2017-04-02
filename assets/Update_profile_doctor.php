<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../connectdb.php');
    $Name = $_POST['Name'];
    $Lastname = $_POST['Lastname'];
    $Birthday = $_POST['Birthday'];
    $phone = $_POST['phone'];
    $Email = $_POST['Email'];
    $ID_doctor = $_POST['ID_doctor'];

    $sql_insert = "UPDATE doctor_details SET Name = '".$Name."', Lastname = '".$Lastname."', Birthday = '".$Birthday."',
    Phone_number = '".$phone."', Email = '".$Email."' WHERE ID_doctor LIKE '".$ID_doctor."'";
    $insert = $conn->query($sql_insert);

    $select = "SELECT ID_doctor FROM image_doctor WHERE ID_doctor LIKE '".$ID_doctor."'";
    $result = $conn->query($select);
    if($row = $result->fetch_assoc() > 0){
      if(copy($_FILES["pic"]["tmp_name"],"../img/profile/".$_FILES["pic"]["name"])){
        $insert_pic = "UPDATE image_doctor SET FilesName = '".$_FILES["pic"]["name"]."' WHERE ID_doctor LIKE '".$ID_doctor."'";
        $pic = $conn->query($insert_pic);
      }else{
        $insert_pic = "UPDATE image_doctor SET FilesName = 'noimage.jpg' WHERE ID_doctor LIKE '".$ID_doctor."'";
        $pic = $conn->query($insert_pic);
      }
    }else{
      if(copy($_FILES["pic"]["tmp_name"],"../img/profile/".$_FILES["pic"]["name"])){
        $insert_pic = "INSERT INTO image_doctor(ID_user,FilesName)
        VALUES ('".$ID_doctor."','".$_FILES["pic"]["name"]."')";
        $pic = $conn->query($insert_pic);
      }else{
        $insert_pic = "UPDATE image_doctor SET FilesName = 'noimage.jpg' WHERE ID_doctor LIKE '".$ID_doctor."'";
        $pic = $conn->query($insert_pic);
      }
    }

    if($insert&&$pic === TRUE){
      $url = '../webboard_doctor.php';
      header( "Location: $url" );
    }else{
      echo "error !";
    }
    $conn->close();
}
 ?>
