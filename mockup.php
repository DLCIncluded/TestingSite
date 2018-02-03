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
<script src="scripts.js"></script>

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
			<p>The Only DLC that matters</p>
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
	
		<h1>Welcome!</h1>
		<p>
			Hey there! Welcome to the site for DLCIncluded's Modded MC server!<br><br>
			
			We are a group of close friends, who love playing minecraft on the rare occasion. We do switch packs every few
			months(usually 6+) when we get bored but only when the majority agrees, and yes we do take new players into account.<br><br>
			
			Right now we are playing on the All The Mods 3 pack version 5.3, which will update soon. <!-- Lets put a db check here for what version we are on so it is always up to date!!!!! -->
			Want to join us?? Thought you might, please register for the site, and once you have activated your account
			you will have the option in your profile to apply for the whitelist which will send a message to staff to 
			review and accept/reject (we like people so unless you're a bot we usually add/accept) 
			<br><br>
			
			If you see players online to the right, and they have an account here you can take a look at their profile page, for 
			possible biographies, base pictures, or whatever they fancy decking their profile out with!
			
			Thanks for checking us out, the site will be growing in features over the next few weeks ( and things will likely move /change
			because we are actively developing!) <br><br>
			
			PS A big shout out to Pruitt(chj1axr0) for helping out on the site. You are awesome!<br><br><br>

		</p>
	
	</content><!-- main-content -->
	<aside id="sidebar-right">
		<?PHP include("playerCheck.php"); ?>
	</aside><!-- sidebar-right -->


</div><!-- / container -->
<span id="clear"></span>

<footer>
	&copy; Copyright 2018 DLCIncluded 
</footer>
    
<!-- Partical effect  -->
<div class="stars-container">
	<div id="stars"></div>
	<div id="stars2"></div>
	<div id="stars3"></div>
</div>
<!-- / partical effect -->


</body>
</html>