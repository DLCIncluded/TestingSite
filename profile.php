<?PHP 
ini_set('display_errors', '1');
include_once("includes/top.php");
?>
	<title><?PHP echo $_GET['username']; ?>'s Profile</title>
		
			<?PHP 
				//check if logged in, if so show the profile, if not ask to login.
				
				if(isset($username)){
					if(isset($_GET['username']) && $_GET['username'] != ""){
						$sql = "SELECT * FROM Users WHERE username='".$_GET['username']."'";
						
						$result=$connection->query($sql);
						if($result->num_rows == 1){
							while($row = $result->fetch_assoc()){
								$profileUser = $row['username'];
								$profileBio = $row['bio'];
								$profileMCuser = $row['mcUsername'];
								
					?>
								<h1><?PHP echo $profileUser; ?>'s Profile</h1>
								<div id="profilePic">
								<img src="<?PHP echo checkMCPic($profileMCuser,"body"); ?>" />
								MC Username: <?PHP echo $profileMCuser; ?><br>
								</div>
								<!--
								<div id="profile-info">
									MC Username:<?PHP echo $profileMCuser; ?><br>
								</div>
								-->
								<br>
								<span id="clear"></span>
								<?PHP echo $profileBio; ?>
								

								<br>

					<?PHP
								if($username == $_GET['username']){
									
									?>
									<a href='editProfile.php'>Edit Your Profile</a> <br><br>
									
									<?PHP
									$sql1="SELECT * FROM Whitelist WHERE mcUsername='".$mcUsername."'";
									$result1=$connection->query($sql1);
									if($result1->num_rows == 0){
									?>
									<a href='applyWhitelist.php'>Apply for Whitelist</a>
									<?PHP
									}
								}
							}
						}else{
							echo "User not found";
						}
						
					}
					else{
					?>
						User not found
					<?PHP
					}
				}else{
					
					?>
					
					Please login to view this content.
					
					<?PHP
					
					
				}
			
			?>

	
<?PHP 
include_once("includes/bottom.php");
?>
	