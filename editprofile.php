<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");
?>
<title>Edit Your Profile</title>
<?PHP

//form handling 
if(isset($_POST['submitBtn'])){
	if(isset($_POST['submitBtn'])){ //process the updates on users account
		$fName=$_POST['fName'];
		$lName=$_POST['lName'];
		$email=$_POST['email'];	                  
		$mcUsername=$_POST['mcUsername'];
		$birthday=$_POST['birthday'];
		$bio=$_POST['bio'];
		$authQ=$_POST['authQ'];
		$authA=$_POST['authA'];
		  
		$sql = "Update Users SET fName='".$fName ."',lName='".$lName."',email='".$email."',mcUsername='".$mcUsername."',birthday='".$birthday."',bio='".$bio."',authQ='".$authQ."',authA='".$authA."' WHERE username='".$username."'"; 
		if ($connection->query($sql) === TRUE){ //if the query is successful
			echo "Applying updates for: ".$username." Successful.";
		} else { //echo out error if failed
			echo "error: " . $sql . "<br><br>" . $connection->error;
		}
	}
}


if(isset($username)){
	$sql = "SELECT * FROM Users WHERE username='".$username."'";
	$result = $connection->query($sql); 
	
	if($result->num_rows > 0){
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
				?>
				

				<h1>Edit Your Profile</h1>
				
				<div id='usersTable'>
					<form action='editProfile.php' method='POST'>
					<table>
						<tbody>
							<tr id='usersRow'>
								<td id='usersCell'>Field</td>
								<td id='usersCell'>Value</td>
							</tr>
							<tr id='usersRow'>							
								<td id='usersCell'>First Name</td>
								<td id='usersCell'><input type='text' name='fName' value='<?PHP echo $row['fName']; ?>'/></td>
							</tr>	
							<tr id='usersRow'>	
								<td id='usersCell'>Last Name</td>
								<td id='usersCell'><input type='text' name='lName' value='<?PHP echo $row['lName']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Email</td>
								<td id='usersCell'><input type='text' name='email' value='<?PHP echo $row['email']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>mcUsername</td>
								<td id='usersCell'><input type='text' name='mcUsername' value='<?PHP echo $row['mcUsername']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Birthday</td>
								<td id='usersCell'><input type='date' name='birthday' value='<?PHP echo  $row['birthday']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Biography</td>
								<td id='usersCell'><textarea rows='7' cols='40' name='bio'><?PHP echo $row['bio'] ?></textarea></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Auth Question</td>
								<td id='usersCell'>
								<select name='authQ' id='authQ'>
									<option value='q1' <?PHP echo $q1; ?>>What is your favorite Minecraft mob?</option>
									<option value='q2' <?PHP echo $q2; ?>>Who was your childhood hero?</option>
									<option value='q3' <?PHP echo $q3; ?>>What is your oldest cousin's first and last name?</option>
									<option value='q4' <?PHP echo $q4; ?>>Where did your mother and father meet?</option>
									<option value='q5' <?PHP echo $q5; ?>>What is a skill you have that not many others have?</option>
								</select>
								</td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Auth Answer</td>
								<td id='usersCell'><input type='text' name='authA' value='<?PHP echo $row['authA']; ?>'/></td>
							</tr>
						<tbody>
					</table>
					<a href="resetPass.php">Reset Password</a><br><br>
					<input type='submit' name='submitBtn' value='Submit Changes' id='submitBtn'>
					</form>
					
			</div>

			
			<?PHP
		}
	}
} else {
	echo "Please <a href='login.php'>Login</a> to view this page.";
}

include_once("includes/bottom.php");
?>