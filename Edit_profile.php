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
			top: 10%;
			background-color: white;
			width: 55%;
			height: 80%;
			border-radius: 20px;
			color: black;
		}
		.profile > .profile_details > h1{
			margin-top: 5%;
			color: black;
		}
		.profile > .profile_details > form > h3{
			margin-top: 2%;
			text-align: left;
			margin-left: 15%;
			font-size: 18px;
		}
		.myButton {
			margin-top: 1%;
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
					<li><a href="#" id="Main">Main</a></li>
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
						$select = "SELECT * FROM user_details INNER JOIN image_user ON
            user_details.ID_user = image_user.ID_user WHERE user_details.ID_user LIKE '".$id."'";
						$profile = $conn->query($select);
						$row_profile = $profile->fetch_assoc();
						 ?>
						<div class="cd-slider-content">
							<div class="content-wrapper">
								<div class="profile">
									<img src="img/profile/<?=$row_profile['FilesName']?>" width="300px" height="300px" alt="profile">
									<div class="profile_details">
										<h1>Your profile</h1>
										<form action="assets/Update_profile.php" method="post" enctype="multipart/form-data">
                      <h3>ชื่อ : <b style="margin-left:15%"><input type="text" name="Name" id="Name" value="<?=$row_profile['Name']?>" required="required"></b></h3>
  										<h3>นามสกุล : <b style="margin-left:7.8%"><input type="text" name="Lastname" id="Lastname" value="<?=$row_profile['Lastname']?>" required="required"></b></h3>
  										<h3>วันเกิด : <b style="margin-left:10.5%"><input type="date" name="Birthday" value="<?=$row_profile['Birthday']?>" id="Birthday" required="required"></b></h3>
  										<h3>เบอร์โทรศัพท์ : <b style="margin-left:1%"><input type="text" name="phone" id="phone" value="<?=$row_profile['Phone_number']?>" required="required" pattern="[0-9]{10,10}"></b></h3>
  										<h3>อีเมลล์ : <b style="margin-left:10.1%"><input type="email" name="Email" id="Email" value="<?=$row_profile['Email']?>" required="required"></b></h3>
  										<h3>โรคประจำตัว : <b style="margin-left:2.5%"><input type="text" name="condi" id="condi" value="<?=$row_profile['Condi']?>"></b></h3>
  										<h3>รายละเอียดโรคประจำตัว : <b style="margin-left:2.5%"><textarea name="Decondi" rows="2" id="Decondi" value="<?=$row_profile['Decondi']?>"></textarea></b></h3>
                      <h3>อัพเดทรูป : <input type="file" name="pic"></h3>
                      <input type="hidden" name="ID_user" value="<?=$id?>">
  										<input type="submit" class="myButton" value="ยืนยัน"></button>
										</form>
									</div>
								</div>
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
	$(document).ready(function(){
		$('#logout').click(function(){
			window.location.assign('assets/webboard/logout.php');
		});
    $('#Main').click(function(){
			window.location.assign('webboard.php');
		});
	});
</script>
</body>
</html>
