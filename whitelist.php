<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

if($siteLevel>='5'){
	
	if(isset($_GET['username'])){
		$mcUser = $_GET['username'];
	}elseif(isset($_POST['username'])){
		$mcUser = $_POST['username'];
	}else{
		$mcUser = "";
	}
	
	$sql="SELECT * FROM Whitelist WHERE mcUsername='".$mcUser."'";
	if($connection->query($sql)){
		$result=$connection->query($sql);
		if($result->num_rows == 1){
			while($row=$result->fetch_assoc()){
				$reason=$row['message'];
				//echo "found user ".$mcUser." with message ".$reason;
			}
		}
	}else{
			echo $sql . "<br>" . $connection->error;
			
	}
	
	if(isset($_POST['acceptbtn'])){
		$sql = "UPDATE Whitelist SET status=1 WHERE mcUsername='".$mcUser."'"; 
		if($connection->query($sql)){

			//successfully entered into database now send email to staff members to notify it was complete
			$to = "admin@dlcincluded.com, chj1axr0@dlcincluded.com, myaskill@dlcincluded.com, h2owiz1@dlcincluded.com";
			//$to = "admin@dlcincluded.com";
			$sql1="SELECT * FROM Users WHERE mcUsername='".$mcUser."'";
			$result1=$connection->query($sql1);
			if($result1->num_rows == 1){
				while($row1=$result1->fetch_assoc()){
					$email=$row1['email'];
				}
			}
			
			require('includes/MulticraftAPI.php');
			$api = new MulticraftAPI('https://multicraft.dlcincluded.com/api.php', 'DLCIncluded', '4mA4kC8Lnz3KGn');
			//print_r($api->getServerStatus(1, true));
			if($api->sendConsoleCommand(1, "whitelist add ".$mcUser)){}
			
			$subject = $mcUser . " has been Whitelisted by ".$username;
			$subject2 = "You have been Whitelisted";
			
			$message = $mcUser." was added to the Whitelist, nothing more is needed from anyone.";
			$message2 = "Hello ".$mcUser.", you have been added to the Whitelist, please see our <a href='http://dlcincluded.com/testing/about.php'>About</a> page for information on the server.";
			
			
			$headers = "From: admin@dlcincluded.com\r\n";
			$headers .= "Reply-To: admin@dlcincluded.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			mail($to, $subject, $message, $headers);
			mail($email, $subject2, $message2, $headers);
			header("Location: http://dlcincluded.com/testing/status.php?msg=whitelist");
			//echo $mcUser." has been added to the whitelist and been notified via email!";
			
		}else{
			echo $sql . "<br>" . $connection->error;
		}
	}
	?>


	<title>Add to Whitelist</title>
	<h1>Add to Whitelist</h1>

	<form method="POST" action="whitelist.php">
		<?PHP echo $mcUser; ?> has applied to be added to the whitelist, this was his/her message:<br/><br/>
		<?PHP echo $reason; ?><br/><br/>
		<input type="hidden" name="username" value="<?PHP echo $mcUser; ?>"/>
		<input type='submit' name='acceptbtn' value='Add to Whitelist' id='acceptbtn' />
	</form>

<?PHP
}else{
	echo "You are not authorized to view this page.";
}
include_once("includes/bottom.php");
?>