<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

if(isset($_POST['force'])){
	$pass1 = $_POST['newPass1'];
	$pass2 = $_POST['newPass2'];
	if($pass1 == $pass2){
		$sql = "SELECT * FROM Users WHERE username='".$username."'";
		$result = $connection->query($sql);
		if($result->num_rows == 1){
			$fname = $_SESSION['fName'];
			
			$salt = md5($fName); //Create Salt for password crypt
			$password = crypt($pass1, '$2a$07$'.$salt.'$'); //Encrypt password using blowfish + salt just created
			
			$sql = "UPDATE Users SET password='".$password."',forceReset='0' WHERE username='".$username."'";
			if($connection->query($sql)){
				header("Location: status.php?msg=reset");
			}else{
				echo $connection->error;
			}
			
		}else{
			echo "Account does not exist.";
		}
	}else{
		echo "Passwords do not match.";
	}
}

if(isset($_POST['no-force'])){
	$oldPass = $_POST['oldPass'];
	$pass1 = $_POST['newPass1'];
	$pass2 = $_POST['newPass2'];
	
	if($pass1 == $pass2){
		$sql = "SELECT * FROM Users WHERE username='".$username."'";
		$result = $connection->query($sql);
		if($result->num_rows == 1){
			$fname = $_SESSION['fName'];
			while($row = $result->fetch_assoc()){
				$password_hash = $row['password'];
				if(crypt($pass1, $password_hash) == $password_hash) {
					$salt = md5($fName); //Create Salt for password crypt
					$password = crypt($pass1, '$2a$07$'.$salt.'$'); //Encrypt password using blowfish + salt just created
					
					$sql = "UPDATE Users SET password='".$password."' WHERE username='".$username."'";
					if($connection->query($sql)){
						header("Location: status.php?msg=reset");
					}
				}else{
					echo "Old password is incorrect";
				}
			}
			
		}else{
			echo "Account does not exist.";
		}
	}else{
		echo "Passwords do not match.";
	}
}

if(isset($username) && $username != ""){ //if logged in
	$sql = "SELECT * FROM Users WHERE username='".$username."'";
	$result = $connection->query($sql);
	if($result->num_rows == 1){
		while($row = $result->fetch_assoc()){
			$forced = $row['forceReset'];
		}
		if($forced == '0'){ // this is not a forced reset
		?>
			<form action="resetPass.php" method="POST">
				<input type="hidden" name="no-force" value="true" />
				<input type="password" name="oldPass" placeholder="Old Pass" /><br>
				<input type="password" name="newPass1" placeholder="New Pass" /><br>
				<input type="password" name="newPass2" placeholder="Repeat Pass" /><br>
				<input type="submit" name="submit" value="Change Password" />
			</form>
		<?PHP
		}else{//force reset
		?>
			<form action="resetPass.php" method="POST" name="force">
				<input type="hidden" name="force" value="true" />
				<input type="password" name="newPass1" placeholder="New Pass" /><br>
				<input type="password" name="newPass2" placeholder="Repeat Pass" /><br>
				<input type="submit" name="submit" value="Change Password" />
			</form>
		<?PHP
		}
		
	}
}else{
	echo "Please login to view this page.";
}

include_once("includes/bottom.php");
?>