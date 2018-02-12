<?PHP
include_once("includes/top.php");

if(isset($_POST['email'])){
	$email = $_POST['email'];
	
	$sql = "SELECT * FROM Users WHERE email='".$email."'";
	$result = $connection->query($sql);
	if($result->num_rows == 1){
		$tempPass = substr(md5(rand(0,999999999)),0,12);
		
		$salt = md5($email); //Create Salt for password crypt
		$password = crypt($tempPass, '$2a$07$'.$salt.'$'); //Encrypt password using blowfish + salt just created

		$sql = "UPDATE Users SET password='".$password."', forceReset='1' WHERE email='".$email."'";
		if($connection->query($sql)){
			$subject = "Reset your password on DLCIncluded";
			
			$message = "Please use this temporary password to login to your account at DLCIncluded: ".$tempPass." If you have any issues, please reply to this email.";
			
			$headers = "From: admin@dlcincluded.com\r\n";
			$headers .= "Reply-To: admin@dlcincluded.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			mail($email, $subject, $message, $headers);
		}
		echo "Email sent with instructions to reset your password.";
	}else{
		echo "No account on record for that email address. Please try again or contact the admin. ".$connection->error;
	}
}else{

?>
	<form action="forgotPass.php" method="POST">
		<input type="text" name="email" placeholder="email address" />
		<input type="submit" name="submit" value="Send Email" />
	</form>
<?PHP
}
include_once("includes/bottom.php");
?>