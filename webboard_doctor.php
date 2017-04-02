<?php
	session_start();
	if(isset($_SESSION['doctor'])) {
		$name = $_SESSION["doctor"]["name"];
		$email = $_SESSION["doctor"]["email"];
		$id = $_SESSION["doctor"]["id"];
	}else{
		http_response_code(404);
		header("HTTP/1.0 404 Not Found");
		die();
	}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/resetWebboard.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/styleWebboard.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<link rel="stylesheet" type="text/css" href="js/dist/sweetalert.css">
	<title>Webboard</title>
	<style media="screen">
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
		.myButton {
			margin-top: 3%;
			-moz-box-shadow: 0px 9px 21px -6px #276873;
			-webkit-box-shadow: 0px 9px 21px -6px #276873;
			box-shadow: 0px 9px 21px -6px #276873;
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #93dffa), color-stop(1, #408c99));
			background:-moz-linear-gradient(top, #93dffa 5%, #408c99 100%);
			background:-webkit-linear-gradient(top, #93dffa 5%, #408c99 100%);
			background:-o-linear-gradient(top, #93dffa 5%, #408c99 100%);
			background:-ms-linear-gradient(top, #93dffa 5%, #408c99 100%);
			background:linear-gradient(to bottom, #93dffa 5%, #408c99 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#93dffa', endColorstr='#408c99',GradientType=0);
			background-color:#93dffa;
			-moz-border-radius:19px;
			-webkit-border-radius:19px;
			border-radius:19px;
			border:1px solid #29668f;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:18px;
			font-weight:bold;
			padding:8px 25px;
			text-decoration:none;
			text-shadow:0px 1px 0px #3d768a;
		}
		.myButton:hover {
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #93dffa));
			background:-moz-linear-gradient(top, #408c99 5%, #93dffa 100%);
			background:-webkit-linear-gradient(top, #408c99 5%, #93dffa 100%);
			background:-o-linear-gradient(top, #408c99 5%, #93dffa 100%);
			background:-ms-linear-gradient(top, #408c99 5%, #93dffa 100%);
			background:linear-gradient(to bottom, #408c99 5%, #93dffa 100%);
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#408c99', endColorstr='#93dffa',GradientType=0);
			background-color:#408c99;
		}
		.myButton:active {
			position:relative;
			top:1px;
		}
	</style>
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
					<li>
            <a href="#slide-1">Your Profile</a>
            <ol class="sub-nav">
							<li><a href="#slide-1">กระทู้ของผู้ป่วย</a></li>
						</ol>
          </li>
					<li><a href="#" id="logout">Log out</a></li>
				</ol>
			</div> <!-- .cd-nav-items -->
		</nav> <!-- .cd-slideshow-nav -->

		<ol class="cd-slideshow">
			<li class="visible" id="slide-1">
        <ol class="sub-slides">
					<li>
						<?php
						require('connectdb.php');
						$select = "SELECT Name,Lastname,Birthday,Phone_number,Email,province.province_name,hospital.hospital_name,image_doctor.FilesName
						FROM doctor_details,province,hospital,image_doctor
						WHERE doctor_details.Province = province.province_id
						AND doctor_details.Hospital = hospital.hospital_id
						AND image_doctor.ID_doctor = doctor_details.ID_doctor
						AND doctor_details.ID_doctor LIKE '".$id."'";
						$profile = $conn->query($select);
						$row_profile = $profile->fetch_assoc();
						 ?>
						<div class="cd-slider-content">
							<div class="content-wrapper">
								<div class="profile">
									<img src="img/profile/<?=$row_profile['FilesName']?>" width="300px" height="300px" alt="profile">
									<div class="profile_details">
										<h1>Your profile</h1>
										<h3>ชื่อ : <b style="margin-left:15%"><?=$row_profile['Name']?></b></h3>
										<h3>นามสกุล : <b style="margin-left:7.8%"><?=$row_profile['Lastname']?></b></h3>
										<h3>วันเกิด : <b style="margin-left:10.5%"><?=$row_profile['Birthday']?></b></h3>
										<h3>เบอร์โทรศัพท์ : <b style="margin-left:1%"><?=$row_profile['Phone_number']?></b></h3>
										<h3>อีเมลล์ : <b style="margin-left:10.1%"><?=$row_profile['Email']?></b></h3>
										<h3>จังหวัด : <b style="margin-left:10.1%"><?=$row_profile['province_name']?></b></h3>
										<h3>โรงพยาบาลที่สังกัด : <b style="margin-left:2.5%"><?=$row_profile['hospital_name']?></b></h3>
										<button type="button" name="button" class="myButton">แก้ไข Profile</button>
									</div>
								</div>
							</div>
						</div>
					</li>

					<li>
						<div class="cd-slider-content">
							<div class="content-wrapper" style="padding: 0px 50px;">
								<section>
									<h1>กระทู้ของผู้ป่วย</h1>
									<div class="tbl-header">
										<?php
										require('connect.php');
										$sql = "SELECT * FROM questions ORDER BY id DESC";
										$result = $conn->query($sql);
										?>
										<table cellpadding="0" cellspacing="0" border="0">
											<thead>
												<tr>
													<th>ลำดับ</th>
													<th>หัวข้อกระทู้</th>
													<th>อ่าน</th>
													<th>ตอบ</th>
													<th>วันที่ตั้งกระทู้</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="tbl-content">
										<table cellpadding="0" cellspacing="0" border="0">
											<tbody>
												<?php
												$i = 1;
												while ($row = $result->fetch_assoc()) {
													?>
													<tr>
														<td style="text-align: center;"><?php echo $i; ?></td>
														<td><a href="assets/webboard/view_topic_doctor.php?id=<?php echo $row['id']; ?>"><?php echo $row['topic']; ?></a></td>
														<td style="text-align: center;"><?php echo $row['view']; ?></td>
														<td style="text-align: center;"><?php echo $row['reply']; ?></td>
														<td style="text-align: center;"><?php echo $row['created']; ?></td>
													</tr>
													<?php
													$i++;
												}
												$conn->close();
												?>
											</tbody>
										</table>
									</div>
								</section>
							</div>
						</div>
					</li>
				</ol> <!-- .sub-slides -->
			</li>
		</ol> <!-- .cd-slideshow -->
	</div> <!-- .cd-slideshow-wrapper -->

<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/mainWebboard.js"></script> <!-- Resource jQuery -->
<script src="js/dist/sweetalert.min.js"></script>
<script type="text/javascript">
$(window).on("load resize ", function() {
	var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
	$('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#logout').click(function(){
			window.location.assign('assets/webboard/logout.php');
		});
		$('.myButton').click(function(){
			window.location.assign('Edit_profile_doctor.php');
		});
  });
</script>
</body>
</html>
