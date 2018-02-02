<?PHP
include_once("dbConn.php");
include_once("accountManager.php");
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Permanent+Marker|Russo+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Coda" rel="stylesheet"> 

<link href="css/reset.css" rel="stylesheet"> 
<link href="css/styles.css" rel="stylesheet"> 
<link href="css/stars.css" rel="stylesheet"> 

<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	  $('.login-button').click(function() {
		$('.login-form-wrap').slideToggle(400);
		console.log("Done")
	  });
	});
	
	function swap1(){
		$('.login-form-wrap').slideToggle(400);
		$('.register-form-wrap').delay(400).slideToggle(400);
	}
	function swap2(){
		$('.register-form-wrap').slideToggle(400);
		$('.login-form-wrap').delay(400).slideToggle(400);
	}
</script>

</head>


<body>

<!-- login-form-dropdown -->
<div class="login-form-wrap">
	<div class="login-form-container">
		<div id="login-form-dropdown" class="login-form-dropdown">
			<?PHP
				include("login.php");
			?>
		</div>
	</div>
</div>

<div class="register-form-wrap">
	<div class="register-form-container">
		<div id="register-form-dropdown" class="register-form-dropdown">
			<?PHP
				include("register.php");
			?>
		</div>
	</div>
</div>
<!-- /login-form-dropdown -->

<div id="container">
	<header id="header">
		<div id="dlc">
			<h1>DLCIncluded</h1>
		</div>
		<!-- dlc -->
		<button id="login-button" class="login-button"> Login </button>
	<!-- login-button -->
	<!-- <span id="clear"></span> -->
	</header><!-- header -->
<span id="clear"></span>

	<aside id="sidebar-left">
	
		<ul>
			<li><a href="#">News</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Apply</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Home</a></li>
		</ul>
	
	</aside><!-- sidebar-left -->
	<content id="main-content">
	
		<h1>Main Header</h1>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sodales consectetur neque, vitae ultrices mi faucibus a. Donec imperdiet vitae eros nec eleifend. Praesent vitae neque diam. Donec id dolor nec nunc imperdiet consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut non gravida ante, finibus dapibus ipsum. Ut facilisis sodales metus. Donec nulla velit, viverra id sapien quis, rutrum fermentum nisl. Integer risus nulla, hendrerit a interdum non, dictum vel risus. Sed volutpat est quis lobortis posuere. Proin cursus mi et placerat vehicula. Vestibulum vel cursus ipsum, volutpat bibendum mi. Aliquam erat volutpat. Donec ac dignissim urna.

			Donec fermentum arcu at porta bibendum. Donec cursus quis ligula ut pulvinar. Curabitur scelerisque blandit arcu, vel pharetra elit viverra a. Donec id leo at justo rhoncus convallis. Nullam scelerisque arcu urna, eget tincidunt eros lacinia nec. Nullam non magna et tellus placerat pharetra id elementum justo. Cras euismod massa odio, et feugiat nisl tristique quis. Integer dictum erat ipsum, vitae ultricies magna gravida at. Pellentesque sit amet justo massa. Duis gravida scelerisque euismod. Proin et congue tellus. Phasellus a mattis ipsum. Integer vel massa non velit ultrices fermentum. Donec eget augue felis. Nullam non molestie nulla, ac iaculis magna. Etiam non enim in nisi tincidunt eleifend at ac lectus.

			Sed sit amet mauris in dui mollis euismod. Pellentesque dui purus, consequat sed ligula sit amet, sodales porttitor diam. Proin nec tortor interdum, lobortis nibh in, aliquet massa. In quis nibh rutrum mauris malesuada ultricies. Duis ut massa viverra, vehicula velit quis, ullamcorper arcu. Nulla sit amet ultrices leo. Duis vitae hendrerit mauris. Cras lobortis magna eu elit convallis sollicitudin. Nullam metus ligula, mattis et velit maximus, laoreet interdum libero. Sed egestas metus mauris, eu congue magna convallis eu. Sed sed justo vitae quam fermentum suscipit sed sed orci. Fusce elementum ac magna at faucibus.
		</p>
	
	</content><!-- main-content -->
	<aside id="sidebar-right">
		<?PHP include("playerCheck.php"); ?>
	</aside><!-- sidebar-right -->
	
</div><!-- / container -->

<!-- Partical effect  -->
<div class="stars-container">
	<div id="stars"></div>
	<div id="stars2"></div>
	<div id="stars3"></div>
</div>
<!-- / partical effect -->


</body>
</html>