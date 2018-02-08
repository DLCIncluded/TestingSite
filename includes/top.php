<?PHP
session_start();
include_once("includes/dbConn.php");
include_once("includes/accountFunctions.php");
checklogin();
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Permanent+Marker|Russo+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Coda" rel="stylesheet"> 

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<link href="css/reset.css" rel="stylesheet"> 
<link href="css/styles.css" rel="stylesheet"> 
<link href="css/stars.css" rel="stylesheet"> 

<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="js/scripts.js"></script>

</head>


<body>


	<?PHP
	if (!isset($username)) { //if not logged in give the login form &&|| reg form
	?>
		<!-- login-form-dropdown -->
		<div class="login-form-wrap">
			<div class="login-form-container">
				<div id="login-form-dropdown" class="login-form-dropdown">
					<?PHP
						include_once("includes/login.php");
					?>
				</div>
			</div>
		</div>

		<div class="register-form-wrap">
			<div class="register-form-container">
				<div id="register-form-dropdown" class="register-form-dropdown">
					<?PHP
						include_once("includes/register.php");
					?>
				</div>
			</div>
		</div>
		<!-- register-form-dropdown -->
	<?PHP
	} else{
	?>
		<div class="profile-form-wrap">
			<div class="profile-form-container">
				<div id="profile-form-dropdown" class="profile-form-dropdown">
					<?PHP include_once('includes/miniProfile.php'); ?>
				</div>
			</div>
		</div>
	<?PHP
	}
	?>
<div id="container">
	<header id="header">
		<div id="dlc">
			<h1>DLCIncluded</h1>
			<p>The Only DLC that matters</p>
		</div>
		<!-- dlc -->
		<?PHP
		if (!isset($_SESSION['username']) && !isset($_POST['username'])) { //if not logged in give the login form &&|| reg form
		?>
		<button id="login-button" class="login-button"> Login </button>
		<?PHP
		} else {
		?>
			<button id="profile-button" class="profile-button"> Profile </button>
		<?PHP
		}
		?>
	<!-- login-button -->
	<!-- <span id="clear"></span> -->
	</header><!-- header -->
<span id="clear"></span>

	<aside id="sidebar-left">
	
		<ul>
			<!--<li><a href="#">News</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Apply</a></li>
			<li><a href="#">About</a></li>
			-->
			<li><a href="index.php">Home</a></li>
			
			<?PHP
				if(isset($username)){
			?>
			<li><a href="profile.php?username=<?PHP echo $username; ?>">Profile</a></li>
			<?PHP
			}
			
			?>
			<?PHP
				$sql = "SELECT * FROM Pages";
				$result = $connection->query($sql);
				
				if($result->num_rows > 0){ 

					while($row = $result->fetch_assoc()){
						$name=$row['name'];
						if($name == "home"){
						}else{
					
					?>
					
							<li><a href="<?PHP echo $name; ?>.php"><?PHP $name=str_replace("_"," ",$name); $name=strtolower($name); echo ucfirst($name); ?></a></li>

					<?PHP
						}
					}
				}
					?>
			
		</ul>
	
	</aside><!-- sidebar-left -->
	<content id="main-content">
	