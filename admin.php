<?PHP
ini_set('display_errors', '1');
session_start();
include_once("dbConn.php");

include_once("accountManager.php");

require("MulticraftAPI.php");

$api = new MulticraftAPI('http://dlcincluded.com/multicraft/api.php', 'DLCIncluded', '+n2DLp2z*mZoBz');

if(isset($_SESSION['username']) && isset($_SESSION['siteLevel']) && $_SESSION['siteLevel'] >= 5){ //if logged in and level >= 5
	if(isset($_POST['submitbtn'])){ //process the updates on users account
		$id = $_POST['id'];
		$fName=$_POST['fName'];
		$lName=$_POST['lName'];
		$username=$_POST['username'];
		$email=$_POST['email'];	                  
		$mcUsername=$_POST['mcUsername'];
		$birthday=$_POST['birthday'];
		$bio=$_POST['bio'];
		$authQ=$_POST['authQ'];
		$authA=$_POST['authA'];
		$donator=$_POST['donator'];
		$siteLevel=$_POST['siteLevel'];
		$active=$_POST['active'];
		$banned=$_POST['banned'];
		$locked=$_POST['locked'];
		  
		$sql = "Update Users SET fName='".$fName ."',lName='".$lName."',username='".$username."',email='".$email."',mcUsername='".$mcUsername."',birthday='".$birthday."',bio='".$bio."',authQ='".$authQ."',authA='".$authA."',donator=".$donator.",siteLevel=".$siteLevel.",active=".$active.",banned=".$banned.",locked=".$locked." WHERE id=".$id; 
		if ($connection->query($sql) === TRUE){ //if the query is successful
			echo "Applying updates for: ".$_POST['username']." Successful.";
		} else { //echo out error if failed
			echo "error: " . $sql . "<br><br>" . $connection->error;
		}
	}
	
	if(isset($_POST['newPass'])){//input new password into database using custiom function
		echo changePass($_POST['username'],$_POST['newPass']);
	}	

	if(isset($_POST['mcsubmit'])){ //add user to Multicraft via API
		echo "Creating multicraft account for ".$_POST['username'];
		$sql1 = "SELECT * FROM Users WHERE username='".$_POST['username']."' AND siteLevel=5";
		
		$result1 = $connection->query($sql1);
		
		while($row1 = $result1->fetch_assoc()){
			$name = $row1['username'];
			$fName = $row1['fName'];
			$email = $row1['email'];
			$api = new MulticraftAPI('http://dlcincluded.com/multicraft/api.php', 'DLCIncluded', '+n2DLp2z*mZoBz');
			$tempPass = substr(md5(rand(0,999999999)),0,12);
			
			if($api->createUser($name, $email, $tempPass)){
				echo " successfully created account and sent email with temp password";
			}else echo " An error occured, check username and duplicate emails.";
			
			$subject = "Your new account on multicraft for DLCIncluded's server";
			
			$message = "Hello ".$fName.", Please click this link to login: <a href='http://dlcincluded.com/multicraft/'>http://dlcincluded.com/multicraft</a>. Your temporary password is, ".$tempPass.", please change it immediately!!!";
			
			$headers[] = "MIME-Version: 1.0";
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			$headers[] = 'To: '.$email;
			$headers[] = 'From: DLCIncluded Admin <Admin@DLCIncluded.com>';
			
			mail($email, $subject, $message, implode("\r\n", $headers));
			
		}
	}

	if(isset($_GET['edit']) && isset($_GET['username']) && !isset($_GET['pass'])){  //if we are editing a user, display that users fields
		$page = "This is the edit page, you are editing: ".$_GET['username'];
		$sql = "SELECT * FROM Users WHERE username='".$_GET['username']."'";
		$result = $connection->query($sql);
		$data="";
		if($result->num_rows == 1){ //make sure we only have one result
			while($row = $result->fetch_assoc()){
				$q1="";
				$q2="";
				$q3="";
				$q4="";
				$q5="";
				if($row['authQ'] === 'q1'){$q1="selected";}
				if($row['authQ'] === 'q2'){$q2="selected";}
				if($row['authQ'] === 'q3'){$q3="selected";}
				if($row['authQ'] === 'q4'){$q4="selected";}
				if($row['authQ'] === 'q5'){$q5="selected";}
				
				$data .= "
				<tr id='users-row'>
					<input type='hidden' value='".$row['id']."' name='id'/>
					<td id='users-cell'><input type='text' disabled size='1' name='id1' value='".$row['id']."'/></td>
					<td id='users-cell'><input type='text' size='7' name='fName' value='".$row['fName']."'/></td>
					<td id='users-cell'><input type='text' size='7' name='lName' value='".$row['lName']."'/></td>
					<td id='users-cell'><input type='text' size='10' name='username' value='".$row['username']."'/></td>
					<td id='users-cell'><input type='text' size='20' name='email' value='".$row['email']."'/></td>
					<td id='users-cell'><input type='text' size='20' name='mcUsername' value='".$row['mcUsername']."'/></td>
					<td id='users-cell'><input type='text' size='10' name='birthday' value='".$row['birthday']."'/></td>
					<td id='users-cell'><textarea rows='1' cols='20' name='bio'>".$row['bio']."</textarea></td>
					<td id='users-cell'>
					
					<select name='authQ' id='authQ'>
						<option value='q1' ". $q1 ." >What is your favorite Minecraft mob?</option>
						<option value='q2' ". $q2 ." >Who was your childhood hero?</option>
						<option value='q3' ". $q3 ." >What is your oldest cousin's first and last name?</option>
						<option value='q4' ". $q4 ." >Where did your mother and father meet?</option>
						<option value='q5' ". $q5 ." >What is a skill you have that not many others have?</option>
					</select>
					
					</td>
					<td id='users-cell'><input type='text' size='10' name='authA' value='".$row['authA']."'/></td>
					<td id='users-cell'><input type='text' size='1' name='donator' value='".$row['donator']."'/></td>
					<td id='users-cell'><input type='text' size='1' name='siteLevel' value='".$row['siteLevel']."'/></td>
					<td id='users-cell'><input type='text' size='1' name='active' value='".$row['active']."'/></td>
					<td id='users-cell'><input type='text' size='1' name='banned' value='".$row['banned']."'/></td>
					<td id='users-cell'><input type='text' size='1' name='locked' value='".$row['locked']."'/></td>
				</tr>
				
				";
			}
			$page .= "
			<div id='users-table';>
					<form action='admin.php' method='POST'>
					<table>
						<tbody>
							<tr id='users-row'>
								<td id='users-cell'>ID</td>
								<td id='users-cell'>First Name</td>
								<td id='users-cell'>Last Name</td>
								<td id='users-cell'>Username</td>
								<td id='users-cell'>Email</td>
								<td id='users-cell'>mcUsername</td>
								<td id='users-cell'>Birthday</td>
								<td id='users-cell'>Bio</td>
								<td id='users-cell'>AuthQ</td>
								<td id='users-cell'>AuthA</td>
								<td id='users-cell'>Donator</td>
								<td id='users-cell'>Site Level</td>
								<td id='users-cell'>Active</td>
								<td id='users-cell'>Banned</td>
								<td id='users-cell'>Locked</td>
							</tr>
								".$data."
						<tbody>
					</table>
					<input type='submit' name='submitbtn' value='submitbtn' id='submitbtn'>
					</form>
					<form action='admin.php' method='POST'>
						<input type='hidden' name='multicraft' value='true'/>
						<input type='hidden' name='username' value='".$_GET['username']."'/>
						<input type='submit' name='mcsubmit' value='Create Multicraft Account' id='submitbtn'>
					</form>
					
					<a href='admin.php?edit=true&pass=true&username=".$_GET['username']."'>Change Users Password</a>
				</div>
				
			";
		} else {
			$page = "This is the edit page, and user: ".$_GET['username']." cannot be found. Please go back and try again.";
		}
		
	}elseif(!isset($_GET['edit']) && !isset($_GET['username']) && !isset($_GET['pass'])){ //if we are not editing anything display the short version of accounts with locked, active, and banned status 

	$data="";
		$sql = "SELECT * FROM Users";
		$result = $connection->query($sql); 
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$data .= "
				<tr id='users-row'>
					<td id='users-cell'>".$row['id']."</td>
					<td id='users-cell'>".$row['username']."</td>
					<td id='users-cell'>".$row['active']."</td>
					<td id='users-cell'>".$row['locked']."</td>
					<td id='users-cell'>".$row['banned']."</td>
					<td id='users-cell'><a href='admin.php?edit=true&username=".$row['username']."'>Edit</a></td>
				</tr>
				
				";
			}
		}
		$page="
		<div id='users-table';>
				<table>
					<tbody>
						<tr id='users-row'>
							<td id='users-cell'>ID</td>
							<td id='users-cell'>Username</td>
							<td id='users-cell'>Active</td>
							<td id='users-cell'>Locked</td>
							<td id='users-cell'>Banned</td>
							<td id='users-cell'>Edit</td>
						</tr>
							".$data."
					<tbody>
				</table>
		";
	}
	
	if(isset($_GET['edit']) && isset($_GET['pass']) && isset($_GET['username'])){
		echo "editing password for: ". $_GET['username'];
		$page = "
		<form action='admin.php' method='POST'>
		<input type='hidden' name='username' value='".$_GET['username']."' />
		New Password: <input type='password' name='newPass' id='newPass' placeholder='Password' />
		<input type='submit' name='passSubmit' value='Submit' id='passSubmit' />
		</form>
		
		";
	}
	
} elseif(isset($_SESSION['username']) && isset($_SESSION['siteLevel']) && $_SESSION['siteLevel'] <= 5) { //not level 5 or above
	$page = "You are not authorized to be here ".$_SESSION['username'].", get out now!";
}else {
	$page = "You are not authorized to be here, get out now!"; //not logged in
}
?>

<style>
	table {
		border-collapse: collapse;
	}
	#users-table {
		
	}
	
	#users-row {
		border-bottom: 1px solid #000;
	}
	
	#users-table tr {
		background-color:#ACACAC;
	}
	
	#users-table  tr:nth-child(1) {
		background-color:#6a2f6e;
	}
	
	#users-table  tr:nth-child(even) {
		background-color:#CC0;
	}
	
	#users-cell {
		border-bottom: 1px solid #000;
		padding-right:10px;
		margin:0 0;
	}
</style>

<html>
	<body>

		<?PHP
			echo $page;
		?>
		
		
		
	</body>
</html>