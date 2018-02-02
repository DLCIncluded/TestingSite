<?PHP
session_start();
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
	
		<h1>Profile Page</h1>
		<p>
			<?PHP 
				//check if logged in, if so show the profile, if not ask to login.
				
				if(isset($_SESSION['username'])){
					if(isset($_GET['username']) && $_GET['username'] != ""){
					?>
					
						Welcome to <?PHP echo $_GET['username']; ?>'s profile, I hope you like it....

					<?PHP
					}
					else{
						
					?>
						User not found
					<?PHP
					}
				}else{
					
					?>
					
					Please login using the button at the top right.
					
					<?PHP
					
					
				}
			
			?>
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