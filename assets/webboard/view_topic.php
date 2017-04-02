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
			window.location.assign('../../webboard.php');
		});
  });
</script>
</body>
</html>
