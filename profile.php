<?PHP 
include_once("includes/top.php");
?>
	<title><?PHP echo $_GET['username']; ?>'s Profile</title>
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
	
<?PHP 
include_once("includes/bottom.php");
?>
	