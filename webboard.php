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
							<li><a href="#slide-1">ตั้งกระทู้</a></li>
							<li><a href="#slide-1">กระทู้ที่เคยตั้งขึ้น</a></li>
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
										<h3>ชื่อ : <b style="margin-left:15%"><?=$row_profile['Name']?></b></h3>
										<h3>นามสกุล : <b style="margin-left:7.8%"><?=$row_profile['Lastname']?></b></h3>
										<h3>วันเกิด : <b style="margin-left:10.5%"><?=$row_profile['Birthday']?></b></h3>
										<h3>เบอร์โทรศัพท์ : <b style="margin-left:1%"><?=$row_profile['Phone_number']?></b></h3>
										<h3>อีเมลล์ : <b style="margin-left:10.1%"><?=$row_profile['Email']?></b></h3>
										<h3>โรคประจำตัว : <b style="margin-left:2.5%"><?=($row_profile['Condi']=='')?"-":$row_profile['Condi'];?></b></h3>
										<h3>รายละเอียดโรคประจำตัว : <b style="margin-left:2.5%"><?=($row_profile['Decondi']=='')?"-":$row_profile['Decondi'];?></b></h3>
										<button type="button" name="button" class="myButton">แก้ไข Profile</button>
									</div>
								</div>
							</div>
						</div>
					</li>

					<li>
						<div class="cd-slider-content">
							<div class="content-wrapper">
								<div class="form-style-5">
									<form id="newpost">
										<fieldset>
											<legend><span class="number">></span> ตั้งกระทู้ใหม่</legend>
											<label for="topic">หัวข้อกระทู้:</label><input type="text" name="topic" placeholder="หัวข้อกระทู้" required="required">
											<label for="detail">รายละเอียด:</label><textarea name="detail" placeholder="รายละเอียด" style="margin: 0px 0px 30px;height: 159px;width: 943px;" required="required"></textarea>
											<input type="hidden" name="name" value="<?=$name ?>">
											<input type="hidden" name="email" value="<?=$email ?>">
										</fieldset>
										<input type="submit" value="ตั้งกระทู้ใหม่">
									</form>
								</div>
							</div>
						</div>
					</li>

					<li>
						<div class="cd-slider-content">
							<div class="content-wrapper" style="padding: 0px 50px;">
								<section>
									<h1>กระทู้ที่เคยตั้งขึ้น</h1>
									<div class="tbl-header">
										<?php
										require('connect.php');
										$sql = "SELECT * FROM questions WHERE ID_user LIKE '".$id."' ORDER BY created DESC";
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
														<td><a href="assets/webboard/view_topic.php?id=<?php echo $row['id']; ?>"><?php echo $row['topic']; ?></a></td>
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
			window.location.assign('Edit_profile.php');
		});
		$('#newpost').submit(function(){
			var topic = $('input[name="topic"]').val();
			var detail = $('textarea[name="detail"]').val();
			var name = $('input[name="name"]').val();
			var email = $('input[name="email"]').val();
			var id = "<?= $id ?>";
			$.ajax({
				url : 'assets/webboard/add_new_topic.php',
				type : 'POST',
				data : {topic:topic,detail:detail,name:name,email:email,id:id},
				success : function(result){
					var status = result;
					if(status==1){
						swal({
							title: "Thank You",
							text: "กระทู้ของคุณถูกตั้งขึ้นแล้ว",
							type: "success",
							confirmButtonColor: "#47ed52",
							confirmButtonText: "OK",
							closeOnConfirm: false
						},
						function(isConfirm){
							if (isConfirm) {
								location.reload();
							} else {
								location.reload();
							}
						});
					}else{
						swal("Error", "ไม่สามารถตั้งกระทู้ใหม้ได้", "error");
					}
				}
			});
			return false;
		});
	});
</script>
</body>
</html>
