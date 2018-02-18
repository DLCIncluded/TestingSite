<?PHP
include_once("includes/top.php");

if(isset($_POST['applyBtn'])){
	
	$mcUser=$_POST['mcUsername'];
	$message=$_POST['message'];
	$sql="SELECT * FROM Whitelist WHERE mcUsername='".$mcUser."'";
	$result=$connection->query($sql);
	
	if($result->num_rows < 1){
		
		$sql = "INSERT INTO Whitelist VALUES (NULL, '$mcUsername', '$message', 0)";
		if($connection->query($sql)){
			//successfully entered into database now send email to staff members to process
			applyWhiteList_mail($mcUser);
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
	<input type='submit' name='applyBtn' value='Apply' id='applyBtn' />
</form>

<?PHP
include_once("includes/bottom.php");
?>