<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");
?>
<title>Edit Your Profile</title>
<?PHP

//form handling 
if(isset($_POST['submitbtn'])){
	if(isset($_POST['submitbtn'])){ //process the updates on users account
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
				
				<div id='users-table'>
					<form action='editprofile.php' method='POST'>
					<table>
						<tbody>
							<tr id='users-row'>
								<td id='users-cell'>Field</td>
								
								<td id='users-cell'>Value</td>
							</tr>
							<tr id='users-row'>							
								<td id='users-cell'>First Name</td>
								<td id='users-cell'><input type='text' size='7' name='fName' value='<?PHP echo $row['fName']; ?>'/></td>
							</tr>	
							<tr id='users-row'>	
								<td id='users-cell'>Last Name</td>
								<td id='users-cell'><input type='text' size='7' name='lName' value='<?PHP echo $row['lName']; ?>'/></td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Email</td>
								<td id='users-cell'><input type='text' size='20' name='email' value='<?PHP echo $row['email']; ?>'/></td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>mcUsername</td>
								<td id='users-cell'><input type='text' size='20' name='mcUsername' value='<?PHP echo $row['mcUsername']; ?>'/></td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Birthday</td>
								<td id='users-cell'><input type='date' size='10' name='birthday' value='<?PHP echo  $row['birthday']; ?>'/></td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Biography</td>
								<td id='users-cell'><textarea rows='7' cols='40' name='bio'><?PHP echo $row['bio'] ?></textarea></td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Auth Question</td>
								<td id='users-cell'>
								<select name='authQ' id='authQ'>
									<option value='q1' <?PHP echo $q1; ?>>What is your favorite Minecraft mob?</option>
									<option value='q2' <?PHP echo $q2; ?>>Who was your childhood hero?</option>
									<option value='q3' <?PHP echo $q3; ?>>What is your oldest cousin's first and last name?</option>
									<option value='q4' <?PHP echo $q4; ?>>Where did your mother and father meet?</option>
									<option value='q5' <?PHP echo $q5; ?>>What is a skill you have that not many others have?</option>
								</select>
								</td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Auth Answer</td>
								<td id='users-cell'><input type='text' size='10' name='authA' value='<?PHP echo $row['authA']; ?>'/></td>
							</tr>
						<tbody>
					</table>
					<a href="resetPass.php">Reset Password</a><br><br>
					<input type='submit' name='submitbtn' value='Submit Changes' id='submitbtn'>
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