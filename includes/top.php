<?PHP
session_start();
include_once("includes/dbConn.php");
include_once("includes/accountFunctions.php");
include_once("includes/mailFunctions.php");

checkLogin();
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Permanent+Marker|Russo+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Coda" rel="stylesheet"> 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.js"></script>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<link href="css/reset.css" rel="stylesheet"> 
<link href="css/styles.css" rel="stylesheet"> 
<link href="css/stars.css" rel="stylesheet"> 

<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-ui@1.12.1/ui/widget.min.js"></script>
<script src="js/scripts.js"></script>

</head>


<body>

<div class="chatWrap">
	<div class="chatContainer">
		<div id="chatPullout" class="chatPullout">
			<div data-simplebar id="chatContainer">
			
			</div>
			<div id="msgBox">
				<?PHP
				if(isset($username)){
				?>
				<form action="sendChat.php" method="POST" class="ajax">
					<input type="hidden" id="mcUsername" name="mcUsername" value="<?PHP echo $mcUsername; ?>" />
					<input type="text" id="chat" name="chat" style="width:95%" placeholder="Message..."/>
					<input type="submit" id="msgBtn" name="msgBtn" value="Send Message" />
				</form>
				<?PHP
				}else{
					echo "<a class='loginButton'>Login</a> to send chat messages.";
				}
				?>		
			</div>
		</div>
	</div>
</div>

<button id="chatBtn">Chat</button>

	<?PHP
	if (!isset($username)) { //if not logged in give the login form &&|| reg form
	?>
		<!-- loginFormDropdown -->
		<div class="loginFormWrap">
			<div class="loginFormContainer">
				<div id="loginFormDropdown" class="loginFormDropdown">
					<?PHP
						include_once("includes/login.php");
					?>
				</div>
			</div>
		</div>
		
		<!-- registerFormDropdown -->
		<div class="registerFormWrap">
			<div class="registerFormContainer">
				<div id="registerFormDropdown" class="registerFormDropdown">
					<?PHP
						include_once("includes/register.php");
					?>
				</div>
			</div>
		</div>
		
	<?PHP
	} else{
	?>
		<div class="profileFormWrap">
			<div class="profileFormContainer">
				<div id="profileFormDropdown" class="profileFormDropdown">
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
		<button id="loginButton" class="loginButton"> Login </button>
		<?PHP
		} else {
		?>
			<button id="profileButton" class="profileButton"> Profile </button>
		<?PHP
		}
		?>
	<!-- loginButton -->
	<!-- <span id="clear"></span> -->
	</header><!-- header -->
<span id="clear"></span>

	<aside id="sidebarLeft">
	
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
			<li><a href="forumSections.php">Forums</a></li>
			<?PHP
				$sql = "SELECT * FROM Pages ORDER BY name";
				$result = $connection->query($sql);
				
				if($result->num_rows > 0){ 

					while($row = $result->fetch_assoc()){
						$name=$row['name'];
						if($name == "home"){
						}else{
							
					
					
					?>
					
							<li><a href="<?PHP echo $row['fileName']; ?>.php"><?PHP $name=str_replace("_"," ",$name); $name=strtolower($name); echo ucfirst($name); ?></a></li>

					<?PHP
						}
					}
				}
					?>
			
		</ul>
	
	</aside><!-- sidebarLeft -->
	<content id="mainContent">
	