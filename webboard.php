<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/resetWebboard.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/styleWebboard.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

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
					<li>
            <a href="#slide-1">Slide 1</a>
            <ol class="sub-nav">
							<li><a href="#slide-1">Slide 1 - Sub 1</a></li>
							<li><a href="#slide-1">Slide 1 - Sub 2</a></li>
						</ol>
          </li>
				</ol>
			</div> <!-- .cd-nav-items -->
		</nav> <!-- .cd-slideshow-nav -->

		<ol class="cd-slideshow">
			<li class="visible" id="slide-1">
        <ol class="sub-slides">
					<li>
						<div class="cd-slider-content">
							<div class="content-wrapper">
								<h2>Profile</h2>
							</div>
						</div>
					</li>

					<li>
						<div class="cd-slider-content">
							<div class="content-wrapper">
								<h2>Slider #1 - Sub #1</h2>
							</div>
						</div>
					</li>

					<li>
						<div class="cd-slider-content">
							<div class="content-wrapper">
								<h2>Slider #1 - Sub #2</h2>
							</div>
						</div>
					</li>
				</ol> <!-- .sub-slides -->
			</li>
		</ol> <!-- .cd-slideshow -->
	</div> <!-- .cd-slideshow-wrapper -->

<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/mainWebboard.js"></script> <!-- Resource jQuery -->
</body>
</html>
