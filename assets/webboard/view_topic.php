<?php
	session_start();
	if(isset($_SESSION['user'])) {
		$name = $_SESSION["user"]["name"];
		$email = $_SESSION["user"]["email"];
		$id = $_SESSION["user"]["id"];
	}else{
		http_response_code(404);
		header("HTTP/1.0 404 Not Found");
		die();
	}
?>
<?php
require('../../connect.php');
//question
$sql = "SELECT * FROM questions WHERE id = ".$_GET['id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// answer
$sql_a = "SELECT * FROM answers WHERE question_id = ".$_GET['id'];
$result_a = $conn->query($sql_a);
$sql_b = "SELECT * FROM answers WHERE question_id = ".$_GET['id'];
$result_b = $conn->query($sql_b);

// update view
$sql_u = "UPDATE questions SET view=view+1 WHERE id = ".$_GET['id'];
$conn->query($sql_u);
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="../../css/resetWebboard.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="../../css/styleWebboard.css"> <!-- Resource style -->
	<script src="../../js/modernizr.js"></script> <!-- Modernizr -->
	<link rel="stylesheet" type="text/css" href="../../js/dist/sweetalert.css">
	<style media="screen">
		.post{
			width: 90%;
			height: 90%;
			margin: 10px auto;
			background-color: #eee;
			border-radius: 20px;
			padding: 2%;
		}
		.topic {
			height: 10%;
			font-size: 40px;
			color: black;
			border-top-left-radius: 20px;
			border-top-right-radius: 20px;
	    border-left: 6px solid blue;
	    background-color: lightblue;
		}
		.detail {
			margin-top: 1%;
			height: 74%;
			font-size: 20px;
			color: black;
			text-align: left;
			border-left: 6px solid blue;
			padding: 10px;
	    background-color: #ddd;
		}
		.footer {
			margin-top: 1%;
			height: 10%;
			font-size: 18px;
			color: black;
			text-align: right;
			border-bottom-left-radius: 20px;
			border-bottom-right-radius: 20px;
			border-left: 6px solid blue;
			padding: 10px;
	    background-color: #ffcccc;
		}
		.profile{
			width: 95%;
			height: 90%;
			background-color: #ddd;
			margin: 0 auto;
			border-radius: 20px;
			-webkit-box-shadow: 6px 6px 27px 2px rgba(136,136,136,1);
			-moz-box-shadow: 6px 6px 27px 2px rgba(136,136,136,1);
			box-shadow: 6px 6px 27px 2px rgba(136,136,136,1);
			padding: 7% 5%;
		}
		.profile > img{
			float: left;
			border-radius: 50%;
		}
		.profile > img:hover {
		  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
		}
		.profile > .profile_details{
			position: absolute;
			right: 8%;
			top: 15%;
			background-color: white;
			width: 55%;
			height: 70%;
			border-radius: 20px;
			color: black;
		}
		.profile > .profile_details > h1{
			margin-top: 5%;
			color: black;
		}
		.profile > .profile_details > h3{
			margin-top: 2%;
			text-align: left;
			margin-left: 15%;
			font-size: 18px;
		}
	</style>
	<title>Webboard</title>
</head>
<body>
	<div class="cd-slideshow-wrapper">
		<nav class="cd-slideshow-nav">
			<button class="cd-nav-trigger">
				Open Nav
				<span aria-hidden="true"></span>
			</button>

			<div class="cd-nav-items">
				<ol>
					<li><a href="#slide-1">Post</a></li>
					<?php
					$num = 2;
					if ($result_b->num_rows > 0) {
						while ($row_b = $result_b->fetch_assoc()) {
							?>
							<li><a href="#slide-<?=$num?>">comment - <?=$num-1?></a></li>
							<?php
							$num++;
						}
					}
					?>
					<li><a href="#" id="Main">Main</a></li>
					<li><a href="#" id="logout">Log out</a></li>
				</ol>
			</div> <!-- .cd-nav-items -->
		</nav> <!-- .cd-slideshow-nav -->

		<ol class="cd-slideshow">
			<li class="visible" id="slide-1">
				<div class="cd-slider-content">
					<div class="content-wrapper">
						<div class="post">
							<div class="topic">
								<?= $row['topic'] ?>
							</div>
							<div class="detail">
								<?= $row['detail'] ?>
							</div>
							<div class="footer">
								<div style="float:left">
									ชื่อผู้ตั้งกระทู้ : <?= $row['name'] ?> , อีเมล์ผู้ตั้งกระทู้ : <?= $row['email'] ?>
								</div>
								เวลาที่ตั้งกระทู้ : <?= $row['created'] ?>
							</div>
						</div>
					</div>
				</div>
			</li>

			<?php
			$i = 2;
			if ($result_a->num_rows > 0) {
				while ($row_a = $result_a->fetch_assoc()) {
					?>
					<li id="slide-<?=$i?>">
						<ol class="sub-slides">
							<li>
								<div class="cd-slider-content">
									<div class="content-wrapper">
										<div class="post">
											<div class="topic">
												ผู้ตอบคำถาม : <?= $row_a['name'] ?>
											</div>
											<div class="detail">
												<?= $row_a['detail'] ?>
											</div>
											<div class="footer">
												<div style="float:left">
													อีเมล์ผู้ตอบคำถาม : <?= $row_a['email'] ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<?php
								$select = "SELECT Name,Lastname,Birthday,Phone_number,Email,province.province_name,hospital.hospital_name,image_doctor.FilesName
								FROM doctor_details,province,hospital,image_doctor
								WHERE doctor_details.Province = province.province_id
								AND doctor_details.Hospital = hospital.hospital_id
								AND image_doctor.ID_doctor = doctor_details.ID_doctor
								AND doctor_details.ID_doctor LIKE '".$row_a['ID_doctor']."'";
								$profile = $conn->query($select);
								$row_profile = $profile->fetch_assoc();
								 ?>
								<div class="cd-slider-content">
									<div class="content-wrapper">
										<div class="profile">
											<img src="../../img/profile/<?=$row_profile['FilesName']?>" width="300px" height="300px" alt="profile">
											<div class="profile_details">
												<h1>Doctor profile</h1>
												<h3>ชื่อ : <b style="margin-left:15%"><?=$row_profile['Name']?></b></h3>
												<h3>นามสกุล : <b style="margin-left:7.8%"><?=$row_profile['Lastname']?></b></h3>
												<h3>วันเกิด : <b style="margin-left:10.5%"><?=$row_profile['Birthday']?></b></h3>
												<h3>เบอร์โทรศัพท์ : <b style="margin-left:1%"><?=$row_profile['Phone_number']?></b></h3>
												<h3>อีเมลล์ : <b style="margin-left:10.1%"><?=$row_profile['Email']?></b></h3>
												<h3>จังหวัด : <b style="margin-left:10.1%"><?=$row_profile['province_name']?></b></h3>
												<h3>โรงพยาบาลที่สังกัด : <b style="margin-left:2.5%"><?=$row_profile['hospital_name']?></b></h3>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ol> <!-- .sub-slides -->
					</li>
					<?php
					$i++;
				}
			}
			$conn->close();
			?>
		</ol> <!-- .cd-slideshow -->
	</div> <!-- .cd-slideshow-wrapper -->

<script src="../../js/jquery-2.1.4.js"></script>
<script src="../../js/jquery.mobile.custom.min.js"></script>
<script src="../../js/mainWebboard.js"></script> <!-- Resource jQuery -->
<script src="../../js/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	var length = <?=$i?>;
	function rancss(data){
		var colors = ["#2b3158","#56b456","#52bccf","#df8a2f","#c14fce"];
 		var rand = Math.floor(Math.random()*colors.length);
		$('#slide-'+data).children().children().children().children().css("background-color", colors[rand]);
	}
	for(var i = 2; i < length; i++){
		rancss(i);
	}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#logout').click(function(){
			window.location.assign('logout.php');
		});
		$('#Main').click(function(){
			window.location.assign('../../webboard.php');
		});
  });
</script>
</body>
</html>
