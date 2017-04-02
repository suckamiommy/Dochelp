<!DOCTYPE HTML>
<html>
	<head>
		<title>Dochelp</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" type="text/css" href="jQuery/dist/sweetalert.css">
    <style media="screen">
      .btnn{
        margin-top: 30px;
        width: 450px;
        height: 100px;
        font-size: 30px;
      }
    </style>
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">
				<?php
					session_start();
				?>
				<!-- Header -->
					<header id="header">
						<h1><a href="index.html"><strong>Dochelp</strong> Log On By</a> <?php
						if(isset($_SESSION['admin'])) {
							echo $_SESSION["admin"];
						}else{
							http_response_code(404);
							header("HTTP/1.0 404 Not Found");
							die();
						}
						?></h1>
						<nav>
							<ul>
								<li><button id="menu" class="icon fa-info-circle">menu</button></li>
								<li><button id="logout" class="icon fa-info-circle">Log Out</button></li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
        <div class="menu">
          <center>
            <button type="button" class="btnn" id="manageUser" name="button">จัดการข้อมูล User</button><br>
						<button type="button" class="btnn" id="manageDoctor" name="button">จัดการข้อมูล Doctor</button><br>
          </center>
        </div>

        <div id="MP" style="display: none">
          <center>
            <button type="button" class="btnn" id="Edit" name="button">แก้ไขข้อมูล User</button>
            <button type="button" class="btnn" id="Del" name="button">ลบข้อมูล User</button>

            <div id="classAdd" style="display: none; margin-top: 30px;">
							<form id="formAdd">
								ชื่อ : <input type="text" name="Name" id="Name"  required="required" style="width: 500px;">
								นามสกุล : <input type="text" name="Lastname" id="Lastname"  required="required" style="width: 500px;">
								วันเกิด : <input type="date" name="Birthday"  id="Birthday" required="required" style="width: 500px;">
								เบอร์โทรศัพท์ : <input type="text" name="phone" id="phone"  required="required" pattern="[0-9]{10,10}" style="width: 500px;">
								อีเมลล์ : <input type="email" name="Email" id="Email"  required="required" style="width: 500px;">
								โรคประจำตัว : <input type="text" name="condi" id="condi" style="width: 500px;">
								รายละเอียดโรคประจำตัว : <textarea name="Decondi" rows="2" id="Decondi" style="width: 500px;"></textarea>
								<center><input type="submit" value="Send" style="margin-top: 10px;"></center>
								<br>
								<h1 class="result"></h1>
							</form>
            </div>

            <div id="classEdit" style="display: none; margin-top: 30px;">
              <?php
            		require("../connectdb.php");
            		$sql = "SELECT * FROM user_details";
            		$result = $conn->query($sql);
            		if ($result->num_rows > 0) {
            			echo "<table border='1' class='table' style='width: 80%;'>
            			<tr>
										<th style='font-size: 18px;'>Name</th>
										<th style='font-size: 18px;'>Lastname</th>
										<th style='font-size: 18px;'>Birthday</th>
										<th style='font-size: 18px;'>Phone_number</th>
										<th style='font-size: 18px;'>Email</th>
										<th style='font-size: 18px;'>Condi</th>
										<th style='font-size: 18px;'>Decondi</th>
                    <th style='font-size: 18px;'>Edit</th>
            			</tr>";
            			while($row = $result->fetch_assoc()) {
            					echo "	<tr>
											<td>" .$row["Name"]. "</td>
											<td>" .$row["Lastname"]. "</td>
											<td>" .$row["Birthday"]. "</td>
											<td>" .$row["Phone_number"]. "</td>
											<td>" .$row["Email"]. "</td>
											<td>" .$row["Condi"]. "</td>
											<td>" .$row["Decondi"]. "</td>
                      <td><button type='button' class='btn-edit' name='button' value='".$row["ID_user"]."'>Edit</button></td>
            					</tr>";
            		}
            		echo "</table>";
            	} else {
            		echo "0 results";
            	}
            	$conn->close();
            	?>
            </div>

            <div id="classDel" style="display: none; margin-top: 30px;">
              <?php
            		require("../connectdb.php");
            		$sql = "SELECT * FROM user_details";
            		$result = $conn->query($sql);
            		if ($result->num_rows > 0) {
            			echo "<table border='1' class='table' style='width: 80%;'>
            			<tr>
										<th style='font-size: 18px;'>Name</th>
										<th style='font-size: 18px;'>Lastname</th>
										<th style='font-size: 18px;'>Birthday</th>
										<th style='font-size: 18px;'>Phone_number</th>
										<th style='font-size: 18px;'>Email</th>
										<th style='font-size: 18px;'>Condi</th>
										<th style='font-size: 18px;'>Decondi</th>
                    <th style='font-size: 18px;'>Delete</th>
            			</tr>";
            			while($row = $result->fetch_assoc()) {
            					echo "	<tr>
											<td>" .$row["Name"]. "</td>
											<td>" .$row["Lastname"]. "</td>
											<td>" .$row["Birthday"]. "</td>
											<td>" .$row["Phone_number"]. "</td>
											<td>" .$row["Email"]. "</td>
											<td>" .$row["Condi"]. "</td>
											<td>" .$row["Decondi"]. "</td>
                      <td><button type='button' class='btn-Delete' name='button' value='".$row["ID_user"]."'>Delete</button></td>
            					</tr>";
            		}
            		echo "</table>";
            	} else {
            		echo "0 results";
            	}
            	$conn->close();
            	?>
            </div>
          </center>
        </div>

				<div id="MA" style="display: none">
          <center>
            <button type="button" class="btnn" id="Edit_Doctor" name="button">แก้ไขข้อมูล Doctor</button>
            <button type="button" class="btnn" id="Del_Doctor" name="button">ลบข้อมูล Doctor</button>

            <div id="classAdd_Doctor" style="display: none; margin-top: 30px;">
							<form id="formAdd_Doctor">
								ชื่อ : <input type="text" name="Name_Doctor" id="Name"  required="required" style="width: 500px;">
								นามสกุล : <input type="text" name="Lastname_Doctor" id="Lastname"  required="required" style="width: 500px;">
								วันเกิด : <input type="date" name="Birthday_Doctor"  id="Birthday" required="required" style="width: 500px;">
								เบอร์โทรศัพท์ : <input type="text" name="phone_Doctor" id="phone"  required="required" pattern="[0-9]{10,10}" style="width: 500px;">
								อีเมลล์ : <input type="email" name="Email_Doctor" id="Email"  required="required" style="width: 500px;">
								จังหวัด :
								<select class="Province" name="province" required="required" style="width: 500px;">
					          <option value="">กรุณาเลือกจังหวัด</option>
					          <?php
					          require("../connectdb.php");
					          $sql = "SELECT * FROM province";
					          $result = $conn->query($sql);
					          if($result->num_rows > 0){
					            while ($row = $result->fetch_assoc()) {
					              echo "<option value='".$row['province_id']."'>".$row['province_name']."</option>";
					            }
					          }else{
					            echo "result 0 row";
					          }
					          $conn->close();
					          ?>
					        </select>
								โรงพยาบาล :
								<select class="Hospital" name="hospital" required="required" style="width: 500px;">
				        </select>
								<center><input type="submit" value="Send" style="margin-top: 10px;"></center>
								<br>
								<h1 class="result_Doctor"></h1>
							</form>
            </div>

            <div id="classEdit_Doctor" style="display: none; margin-top: 30px;">
              <?php
            		require("../connectdb.php");
            		$sql_Doctor = "SELECT ID_doctor,Name,Lastname,Birthday,Phone_number,Email,province.province_name,hospital.hospital_name
								FROM doctor_details,province,hospital WHERE doctor_details.Province = province.province_id
								AND doctor_details.Hospital = hospital.hospital_id";
            		$result_Doctor = $conn->query($sql_Doctor);
            		if ($result_Doctor->num_rows > 0) {
            			echo "<table border='1' class='table' style='width: 80%;'>
            			<tr>
										<th style='font-size: 18px;'>Name</th>
										<th style='font-size: 18px;'>Lastname</th>
										<th style='font-size: 18px;'>Birthday</th>
										<th style='font-size: 18px;'>Phone_number</th>
										<th style='font-size: 18px;'>Email</th>
										<th style='font-size: 18px;'>province_name</th>
										<th style='font-size: 18px;'>hospital_name</th>
                    <th style='font-size: 18px;'>Edit</th>
            			</tr>";
            			while($row_Doctor = $result_Doctor->fetch_assoc()) {
            					echo "	<tr>
											<td>" .$row_Doctor["Name"]. "</td>
											<td>" .$row_Doctor["Lastname"]. "</td>
											<td>" .$row_Doctor["Birthday"]. "</td>
											<td>" .$row_Doctor["Phone_number"]. "</td>
											<td>" .$row_Doctor["Email"]. "</td>
											<td>" .$row_Doctor["province_name"]. "</td>
											<td>" .$row_Doctor["hospital_name"]. "</td>
                      <td><button type='button' class='btn-edit_Doctor' name='button' value='".$row_Doctor["ID_doctor"]."'>Edit</button></td>
            					</tr>";
            		}
            		echo "</table>";
            	} else {
            		echo "0 results";
            	}
            	$conn->close();
            	?>
            </div>

            <div id="classDel_Doctor" style="display: none; margin-top: 30px;">
              <?php
            		require("../connectdb.php");
            		$sql_Doctor = "SELECT ID_doctor,Name,Lastname,Birthday,Phone_number,Email,province.province_name,hospital.hospital_name
								FROM doctor_details,province,hospital WHERE doctor_details.Province = province.province_id
								AND doctor_details.Hospital = hospital.hospital_id";
            		$result_Doctor = $conn->query($sql_Doctor);
            		if ($result_Doctor->num_rows > 0) {
            			echo "<table border='1' class='table' style='width: 80%;'>
            			<tr>
										<th style='font-size: 18px;'>Name</th>
										<th style='font-size: 18px;'>Lastname</th>
										<th style='font-size: 18px;'>Birthday</th>
										<th style='font-size: 18px;'>Phone_number</th>
										<th style='font-size: 18px;'>Email</th>
										<th style='font-size: 18px;'>province_name</th>
										<th style='font-size: 18px;'>hospital_name</th>
                    <th style='font-size: 18px;'>Delete</th>
            			</tr>";
            			while($row_Doctor = $result_Doctor->fetch_assoc()) {
            					echo "	<tr>
											<td>" .$row_Doctor["Name"]. "</td>
											<td>" .$row_Doctor["Lastname"]. "</td>
											<td>" .$row_Doctor["Birthday"]. "</td>
											<td>" .$row_Doctor["Phone_number"]. "</td>
											<td>" .$row_Doctor["Email"]. "</td>
											<td>" .$row_Doctor["province_name"]. "</td>
											<td>" .$row_Doctor["hospital_name"]. "</td>
                      <td><button type='button' class='btn-Delete_Doctor' name='button' value='".$row_Doctor["ID_doctor"]."'>Delete</button></td>
            					</tr>";
            		}
            		echo "</table>";
            	} else {
            		echo "0 results";
            	}
            	$conn->close();
            	?>
            </div>
          </center>
        </div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="jQuery/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){

					$('select[name="province"]').change(function(){
				    var id_province = $(this).val();
				    $.ajax({
				      type: 'POST',
				      url: '../assets/Select_hospital.php',
				      data : {id:id_province},
				      success : function(result){
				        $('select[name="hospital"]').html(result);
				      }
				    });
				  });

          // MP
          var value = 0;
					var value2 = 0;
          // btn 1
          $('#manageUser').click(function(){
            $(this).hide();
            $('#manageDoctor').hide();
            $('.menu').css('display','none');
            $('#MP').css('display','block');
            $('#MA').css('display','hide');
          });
          $('#manageDoctor').click(function(){
            $(this).hide();
            $('#manageUser').hide();
            $('.menu').css('display','none');
            $('#MP').css('display','hide');
            $('#MA').css('display','block');
          });

          //btn 2
          $('#Edit').click(function(){
            $('.result').empty();
            $('#classAdd').css('display','none');
            $('#classEdit').css('display','block');
            $('#classDel').css('display','none');
          });
          $('#Del').click(function(){
            $('#classAdd').css('display','none');
            $('#classEdit').css('display','none');
            $('#classDel').css('display','block');
          });

					$('#Edit_Doctor').click(function(){
            $('.result_Doctor').empty();
            $('#classAdd_Doctor').css('display','none');
            $('#classEdit_Doctor').css('display','block');
            $('#classDel_Doctor').css('display','none');
          });
          $('#Del_Doctor').click(function(){
            $('#classAdd_Doctor').css('display','none');
            $('#classEdit_Doctor').css('display','none');
            $('#classDel_Doctor').css('display','block');
          });

          // form add
          $('#formAdd').submit(function(){
            var Name = $('input[name="Name"]').val();
            var Lastname = $('input[name="Lastname"]').val();
            var Birthday = $('input[name="Birthday"]').val();
            var phone = $('input[name="phone"]').val();
						var Email = $('input[name="Email"]').val();
						var condi = $('input[name="condi"]').val();
						var Decondi = $('#Decondi').val();
            $.ajax({
              url : 'Addpersonnel.php',
              type : 'POST',
              data : {id:value,Name:Name,Lastname:Lastname,Birthday:Birthday,phone:phone,Email:Email,condi:condi,Decondi:Decondi},
              success : function(result){
                $('.result').html(result);
              }
            });
            $('input[name="Name"]').val("");
            $('input[name="Lastname"]').val("");
            $('input[name="Birthday"]').val("");
            $('input[name="phone"]').val("");
						$('input[name="Email"]').val("");
						$('input[name="condi"]').val("");
						$('#Decondi').val("");
            return false;
          });

          // form edit
          $('.btn-edit').click(function(){
            value = $(this).val();
            $('#classEdit').css('display','none');
            $('#classAdd').css('display','block');
            $.ajax({
              url : 'Selectpersonnel.php',
              type : 'POST',
              data : {id:value},
              success : function(result){
                var result = result.split('|');
								$('input[name="Name"]').val(result[0]);
		            $('input[name="Lastname"]').val(result[1]);
		            $('input[name="Birthday"]').val(result[2]);
		            $('input[name="phone"]').val(result[3]);
								$('input[name="Email"]').val(result[4]);
								$('input[name="condi"]').val(result[5]);
								$('#Decondi').val(result[6]);
              }
            });
          });

          // form Del
          $('.btn-Delete').click(function(){
            var del = $(this).val();
            $.ajax({
              url : 'Deletepersonnel.php',
              type : 'POST',
              data : {id:del},
              success : function(result){
                var delstatus = result;
								if(delstatus==1){
									location.reload();
								}else{
									$('#result').html("ไม่สามารถลบข้อมูลสินค้าได้");
								}
              }
            });
          });

					// form add
          $('#formAdd_Doctor').submit(function(){
            var Name = $('input[name="Name_Doctor"]').val();
            var Lastname = $('input[name="Lastname_Doctor"]').val();
            var Birthday = $('input[name="Birthday_Doctor"]').val();
            var phone = $('input[name="phone_Doctor"]').val();
						var Email = $('input[name="Email_Doctor"]').val();
						var province = $('select[name="province"]').val();
						var hospital = $('select[name="hospital"]').val();
            $.ajax({
              url : 'AddDoctor.php',
              type : 'POST',
              data : {id:value2,Name:Name,Lastname:Lastname,Birthday:Birthday,phone:phone,Email:Email,province:province,hospital:hospital},
              success : function(result){
                $('.result_Doctor').html(result);
              }
            });
            $('input[name="Name_Doctor"]').val("");
            $('input[name="Lastname_Doctor"]').val("");
            $('input[name="Birthday_Doctor"]').val("");
            $('input[name="phone_Doctor"]').val("");
						$('input[name="Email_Doctor"]').val("");
						$('select[name="province"]').val("");
						$('select[name="hospital]').val("");
            return false;
          });

          // form edit
          $('.btn-edit_Doctor').click(function(){
            value2 = $(this).val();
            $('#classEdit_Doctor').css('display','none');
            $('#classAdd_Doctor').css('display','block');
            $.ajax({
              url : 'SelectDoctor.php',
              type : 'POST',
              data : {id:value2},
              success : function(result){
                var result = result.split('|');
								$('input[name="Name_Doctor"]').val(result[0]);
		            $('input[name="Lastname_Doctor"]').val(result[1]);
		            $('input[name="Birthday_Doctor"]').val(result[2]);
		            $('input[name="phone_Doctor"]').val(result[3]);
								$('input[name="Email_Doctor"]').val(result[4]);
								$('select[name="province"]').val(result[5]);
								$('select[name="hospital]').val(result[6]);
								var id_province = result[5];
								var id_hospital = result[6];
						    $.ajax({
						      type: 'POST',
						      url: '../assets/Select_hospital2.php',
						      data : {id:id_province,id_hospital:id_hospital},
						      success : function(result){
						        $('select[name="hospital"]').html(result);
						      }
						    });
              }
            });
          });

          // form Del
          $('.btn-Delete_Doctor').click(function(){
            var del = $(this).val();
            $.ajax({
              url : 'DeleteDoctor.php',
              type : 'POST',
              data : {id:del},
              success : function(result){
                var delstatus = result;
								if(delstatus==1){
									location.reload();
								}else{
									$('#result').html("ไม่สามารถลบข้อมูลสินค้าได้");
								}
              }
            });
          });

					// selector
					$('#menu').click(function(){
						location.reload();
					});
					$('#logout').click(function(){
						window.location.assign('../assets/webboard/logout.php');
					});
				});
			</script>
	</body>
</html>
