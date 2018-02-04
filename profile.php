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
								$profile_user = $row['username'];
								$profile_bio = $row['bio'];
					?>
								<h1><?PHP echo $profile_user; ?>'s Profile</h1>
								<img src="images/profiles/<?PHP echo $profile_user; ?>/profilepic.png" />
							
								<?PHP echo $profile_bio; ?>
								

								<br>

					<?PHP
								if($username == $_GET['username']){
									echo "<a href='editprofile.php'>Edit Your Profile</a>";
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
	