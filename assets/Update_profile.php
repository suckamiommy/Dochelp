<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../connectdb.php');
    $Name = $_POST['Name'];
    $Lastname = $_POST['Lastname'];
    $Birthday = $_POST['Birthday'];
    $phone = $_POST['phone'];
    $Email = $_POST['Email'];
    $condi = $_POST['condi'];
    $Decondi = $_POST['Decondi'];
    $ID_user = $_POST['ID_user'];

    $sql_insert = "UPDATE user_details SET Name = '".$Name."', Lastname = '".$Lastname."',
    Birthday = '".$Birthday."', Phone_number = '".$phone."', Email = '".$Email."',
    Condi = ".(($condi=='')?"NULL":("'".$condi."'")).", Decondi = ".(($Decondi=='')?"NULL":("'".$Decondi."'"))."
    WHERE ID_user LIKE '".$ID_user."'";
    $insert = $conn->query($sql_insert);

    $select = "SELECT ID_user FROM image_user WHERE ID_user LIKE '".$ID_user."'";
    $result = $conn->query($select);
    if($row = $result->fetch_assoc() > 0){
      if(copy($_FILES["pic"]["tmp_name"],"../img/profile/".$_FILES["pic"]["name"])){
        $insert_pic = "UPDATE image_user SET FilesName = '".$_FILES["pic"]["name"]."' WHERE ID_user LIKE '".$ID_user."'";
        $pic = $conn->query($insert_pic);
      }else{
        $insert_pic = "UPDATE image_user SET FilesName = 'noimage.jpg' WHERE ID_user LIKE '".$ID_user."'";
        $pic = $conn->query($insert_pic);
      }
    }else{
      if(copy($_FILES["pic"]["tmp_name"],"../img/profile/".$_FILES["pic"]["name"])){
        $insert_pic = "INSERT INTO image_user(ID_user,FilesName)
        VALUES ('".$ID_user."','".$_FILES["pic"]["name"]."')";
        $pic = $conn->query($insert_pic);
      }else{
        $insert_pic = "UPDATE image_user SET FilesName = 'noimage.jpg' WHERE ID_user LIKE '".$ID_user."'";
        $pic = $conn->query($insert_pic);
      }
    }

    if($insert&&$pic === TRUE){
      $url = '../webboard.php';
      header( "Location: $url" );
    }else{
      echo "error !";
    }
    $conn->close();
}
 ?>
