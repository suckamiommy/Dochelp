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
				<ol class="sub-slides">
					<li>
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

					<li>
						<?php
						$select = "SELECT * FROM user_details INNER JOIN image_user ON
            user_details.ID_user = image_user.ID_user WHERE user_details.ID_user LIKE '".$row['ID_user']."'";
						$profile = $conn->query($select);
						$row_profile = $profile->fetch_assoc();
						 ?>
						<div class="cd-slider-content">
							<div class="content-wrapper">
								<div class="profile">
									<img src="../../img/profile/<?=$row_profile['FilesName']?>" width="300px" height="300px" alt="profile">
									<div class="profile_details">
										<h1>User profile</h1>
										<h3>ชื่อ : <b style="margin-left:15%"><?=$row_profile['Name']?></b></h3>
										<h3>นามสกุล : <b style="margin-left:7.8%"><?=$row_profile['Lastname']?></b></h3>
										<h3>วันเกิด : <b style="margin-left:10.5%"><?=$row_profile['Birthday']?></b></h3>
										<h3>เบอร์โทรศัพท์ : <b style="margin-left:1%"><?=$row_profile['Phone_number']?></b></h3>
										<h3>อีเมลล์ : <b style="margin-left:10.1%"><?=$row_profile['Email']?></b></h3>
										<h3>โรคประจำตัว : <b style="margin-left:2.5%"><?=($row_profile['Condi']=='')?"-":$row_profile['Condi'];?></b></h3>
										<h3>รายละเอียดโรคประจำตัว : <b style="margin-left:2.5%"><?=($row_profile['Decondi']=='')?"-":$row_profile['Decondi'];?></b></h3>
										<input type="button" class="myButton" value="บล็อคผู้ใช้งาน"></button>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ol> <!-- .sub-slides -->
			</li>

			<?php
			$i = 2;
			if ($result_a->num_rows > 0) {
				while ($row_a = $result_a->fetch_assoc()) {
					?>
					<li id="slide-<?=$i?>">
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
					<?php
					$i++;
				}
			}
			?>

      <li>
        <div class="cd-slider-content">
          <div class="content-wrapper" id="comment">
            <div class="form-style-5">
              <form id="newcomment">
                <fieldset>
                  <legend><span class="number">></span> ตอบคำถาม</legend>
                  <label for="detail">รายละเอียด:</label><textarea name="detail" placeholder="รายละเอียด" style="margin: 0px 0px 30px;height: 159px;width: 943px;" required="required"></textarea>
                  <input type="hidden" name="name" value="<?=$name ?>">
                  <input type="hidden" name="email" value="<?=$email ?>">
                  <input type="hidden" name="id" value="<?=$row['id']; ?>">
                </fieldset>
                <input type="submit" value="บันทึกข้อมูล">
              </form>
            </div>
          </div>
        </div>
      </li>

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
		$('#slide-'+data).children().children().css("background-color", colors[rand]);
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
			window.location.assign('../../webboard_doctor.php');
		});
		$('#newcomment').submit(function(){
			var detail = $('textarea[name="detail"]').val();
			var name = $('input[name="name"]').val();
			var email = $('input[name="email"]').val();
      var id = $('input[name="id"]').val();
			var ID_doctor = "<?= $id ?>";
			$.ajax({
				url : 'add_answer.php',
				type : 'POST',
				data : {detail:detail,name:name,email:email,id:id,ID_doctor:ID_doctor},
				success : function(result){
					var status = result;
					if(status==1){
						swal({
							title: "Thank You",
							text: "คุณได้ตอบคำถามแล้ว",
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
						swal("Error", "ไม่สามารถตอบคำถามได้", "error");
					}
				}
			});
			return false;
		});
		$('.myButton').click(function(){
			swal({
				title: "คุณแน่ใจแล้วหรือ",
				text: "การบล็อคผู้ใช้งาน จะทำให้ไม่เห็นกระทู้ของผู้ใช้งานคนนั้นอีกต่อไป",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "ตกลง",
				cancelButtonText: "ยกเลิก",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm){
				if (isConfirm) {
					var user = "<?=$row['ID_user']?>";
					var doctor = "<?=$id?>";
					$.ajax({
						url : '../block_user.php',
						type : 'POST',
						data : {doctor:doctor,user:user},
						success : function(result){
							var block = result;
							if(block==1){
								swal({
									title: "สำเร็จ",
									text: "บล็อคผู้ใช้งานสำเร็จคุณจะไม่เห็น Post ของเขาอีกต่อไป",
									type: "success",
									confirmButtonColor: "#47ed52",
									confirmButtonText: "OK",
									closeOnConfirm: false
								},
								function(isConfirm){
									if (isConfirm) {
										window.location.assign('../../webboard_doctor.php');
									} else {
										window.location.assign('../../webboard_doctor.php');
									}
								});
							}else{
								swal("Error", "ไม่สามารถบล็อคผู้ใช้งานได้", "error");
							}
						}
					});
				} else {
					swal("ยกเลิก", "ตัดสินใจให้ดีก่อนจะบล็อคผู้ใช้งาน", "error");
				}
			});
		});
	});
</script>
</body>
</html>
<?php
$conn->close();
 ?>
