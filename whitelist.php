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
	
	if(isset($_POST['acceptBtn'])){
		$sql = "UPDATE Whitelist SET status=1 WHERE mcUsername='".$mcUser."'"; 
		if($connection->query($sql)){

			//successfully entered into database now send email to staff members to notify it was complete
			
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
			
			whitelistMail($email,$mcUser,$username);
			
			header("Location: https://dlcincluded.com/status.php?msg=whitelist");
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
		<input type='submit' name='acceptBtn' value='Add to Whitelist' id='acceptBtn' />
	</form>

<?PHP
}else{
	echo "You are not authorized to view this page.";
}
include_once("includes/bottom.php");
?>