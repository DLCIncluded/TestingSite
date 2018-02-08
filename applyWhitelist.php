<?PHP
include_once("includes/top.php");

if(isset($_POST['applybtn'])){
	
	$mcUser=$_POST['mcUsername'];
	$message=$_POST['message'];
	$sql="SELECT * FROM Whitelist WHERE mcUsername='".$mcUser."'";
	$result=$connection->query($sql);
	
	if($result->num_rows < 1){
		
		$sql = "INSERT INTO Whitelist VALUES (NULL, '$mcUsername', '$message', 0)";
		if($connection->query($sql)){
			//successfully entered into database now send email to staff members to process
			$to = "admin@dlcincluded.com, chj1axr0@dlcincluded.com, myaskill@dlcincluded.com, h2owiz1@dlcincluded.com";
			//$to = "admin@dlcincluded.com";
			
			$subject = $mcUser . " Requested to be Whitelisted";
			
			$message = "Please click this link to process this request: http://dlcincluded.com/testing/whitelist.php?username=".$mcUsername;
			
			$headers = "From: admin@dlcincluded.com\r\n";
			$headers .= "Reply-To: admin@dlcincluded.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			mail($to, $subject, $message, $headers);
			
			//echo "Thank you for applying, we will contact you soon when we have processed your account!";
			header("Location: http://dlcincluded.com/testing/status.php?msg=apply");
		}else{
			echo $sql . "<br>" . $connection->error;
		}
		
	}else {
		echo "You have already applied we will process your application soon.";
	}
}
?>


<title>Apply for Whitelist</title>
<h1>Apply for Whitelist</h1>

<form method="POST" action="applyWhitelist.php">
	<?PHP echo $mcUsername; ?> please fill out this quick survey to apply:<br/><br/>
	<input type="hidden" name="mcUsername" value="<?PHP echo $mcUsername; ?>" />
	Reason for joining us? The better you fill this out the faster we can process your application.
	<textarea rows='7' cols='40' name='message' placeholder="Example: 'I know billy bob and we used to play together and he invited me'"></textarea><br/>
	<input type='submit' name='applybtn' value='Apply' id='applybtn' />
</form>

<?PHP
include_once("includes/bottom.php");
?>