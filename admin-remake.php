<?PHP
ini_set('display_errors', '1');
include("includes/top.php");
require("includes/MulticraftAPI.php");
$api = new MulticraftAPI('http://dlcincluded.com/multicraft/api.php', 'DLCIncluded', '+n2DLp2z*mZoBz');

if(isset($_GET['edit'])){
	$edit=$_GET['edit'];
} else {
	$edit="";
}
if(isset($_GET['username'])){
	$username=$_GET['username'];
} else {
	$username="";
}
if(isset($_GET['pass'])){
	$pass=$_GET['pass'];
} else {
	$pass="";
}
if(isset($_GET['delete'])){
	$delete=$_GET['delete'];
} else {
	$delete="";
}
if(isset($_GET['page'])){
	$page=$_GET['page'];
} else {
	$page="";
}
if(isset($_GET['name'])){
	$name=$_GET['name'];
} else {
	$name="";
}

if(isset($_SESSION['username']) && isset($_SESSION['siteLevel']) && $_SESSION['siteLevel'] >= 5){ //if logged in and level >= 5
	
		//*******************************************
		//*******************************************
		//*************FORM HANDLING*****************
		//*******************************************
		//*******************************************
		
		
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
	
	if(isset($_POST['newPass'])){//input new password into database using custom function
		echo changePass($_POST['username'],$_POST['newPass']);
	}
	
	if(isset($_POST['delBtn'])){
		echo delUser($_POST['username']);
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
	
	if(isset($_POST['new-page-submit'])){
		$name=$_POST['pageName'];
		$name=str_replace(" ","_",$name); 
		$name=strtolower($name);  
		$page=$_POST['pageData'];
		$sql = "INSERT INTO Pages VALUES (NULL,'".$name."','".$page."')"; 
		if($connection->query($sql) === TRUE){
			echo "Page created at <a href='".$name.".php'>".$name."</a>";
			
			$file = $name.'.php';
			if(!is_file($file)){
				$contents = 'This is a test!';
				file_put_contents($file, "
				
				<?php include('includes/top.php'); 
				
					\$page = basename(__FILE__, '.php'); 
	
					\$sql = \"SELECT * FROM Pages WHERE name='\".\$page.\"'\";
					
					\$result = \$connection->query(\$sql); 
					
					if(\$result->num_rows > 0){
						while(\$row = \$result->fetch_assoc()){
							
							\$name=str_replace('_',' ',\$row['name']); 
							\$name=strtolower(\$name);
							\$name=ucfirst(\$name); 
							echo '<title>'.\$name.'</title>';
							echo \$row['pageData'];
						}
					} else {
						echo 'No page found.';
					}
					
				include_once('includes/bottom.php'); 
				?>
				
				
				");
			}
			
		}else {
			echo $sql . "<br>" . $connection->error;
		}
	}
	
	if(isset($_POST['edit-page-submit'])){
		$name=$_POST['pageName'];
		$page=$_POST['pageData'];
		$sql = "Update Pages SET pageData='".$page."' WHERE name='".$name."'"; 
		if($connection->query($sql) === TRUE){
			echo "edits were successful for <a href='".$name.".php'>".$name."</a>";
		}else {
			echo $sql . "<br>" . $connection->error;
		}
	}
	
	if(isset($_POST['delete-page-submit'])){
		$name=$_POST['pageName'];
		$file = $name.'.php';
		$sql = "DELETE FROM Pages WHERE name='".$name."'"; 
		if($connection->query($sql) === TRUE){
			if(unlink($file)){
			echo "Successfully deleted ".$name." <a href='admin-remake.php'>Reload page</a>";
			}else{
				echo "failed to delete the file.. please let the admin know that ".$file." was not deleted successfully...";
			}
		}else {
			echo $sql . "<br>" . $connection->error;
		}
	}
	

	
		//*******************************************
		//*******************************************
		//*****************Main PAGE*****************
		//*******************************************
		//*******************************************
	
	if(!isset($edit) || $edit!="true"){
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
					<td id='users-cell'><a href='admin-remake.php?edit=true&username=".$row['username']."'>Edit</a></td>
				</tr>
				
				";
			}
		}
		?>
		
			<div id='users-table'>
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
							<?PHP echo $data ?>
					<tbody>
				</table>
			</div>
			
			<div id='functions-table'>
				<ul>
					<li><a href="admin-remake.php?edit=true&page=new">New Page</a></li>
					<li><a href="admin-remake.php?edit=true&page=edit">Edit a Page</a></li>
				</ul>
			</div>
			
		<?PHP
		
	}elseif(isset($edit) && $edit=="true" && ($username=="" || !isset($username)) && ($pass=="" || $pass!="true") && $page=="new"){
		
		//*******************************************
		//*******************************************
		//************PAGE CREATION******************
		//*******************************************
		//*******************************************
		?>
		
			<h1>New Page</h1>
			
			<form method="POST" action="admin-remake.php">
				<input type="text" name="pageName" placeholder="Page Name" />Spaces are okay, it will change to an underscore on the backend automagically<br>
                <textarea placeholder="Page Data" cols=50 rows=15 name="pageData"></textarea><br>
                <button type="submit" name="new-page-submit" value="new-page-submit">Submit</button>
			</form>
			
		
		<?PHP
		
		
	
	}elseif(isset($edit) && $edit=="true" && ($username=="" || !isset($username)) && ($pass=="" || $pass!="true") && $page=="edit" && ($name=="" || !isset($name))){
		echo "this is the edit selection page";
		//*******************************************
		//*******************************************
		//********* PAGE EDIT SELECTION**************
		//*******************************************
		//*******************************************
		
		//$sql = "SELECT * FROM Pages WHERE name='". $name ."'";
		$sql = "SELECT * FROM Pages";
		$result = $connection->query($sql);
		
		if($result->num_rows > 0){ 
			while($row = $result->fetch_assoc()){
				$name=$row['name'];
				?><br>
				<a href="admin-remake.php?edit=true&page=edit&name=<?PHP echo $name;?>"><?PHP $name=str_replace("_"," ",$name); $name=strtolower($name); echo ucfirst($name); ?></a>
				<?PHP
			}
		}else{
		?>
			There was no page found try again...
		<?PHP
		}
	}elseif(isset($edit) && $edit=="true" && ($username=="" || !isset($username)) && ($pass=="" || $pass!="true") && $page=="edit" && ($name!="" || isset($name))){
		
		$sql = "SELECT * FROM Pages WHERE name='". $name ."'";

		$result = $connection->query($sql);
		
		if($result->num_rows == 1){ //make sure we only have one result
			while($row = $result->fetch_assoc()){
				$name=$row['name'];
				$pageData=$row['pageData'];
				?>
				
				<h1>Edit Page</h1>
				
				<form method="POST" action="admin-remake.php">
					<input type="text" name="" value="<?PHP echo $name; ?>" disabled/><br>
					<input type="hidden" name="pageName" value="<?PHP echo $name; ?>"/>
					<textarea placeholder="Page Data" cols=50 rows=15 name="pageData"><?PHP echo $pageData; ?></textarea>
					<button type="submit" name="edit-page-submit" value="edit-page-submit">Submit</button>
				</form>
				<form method="POST" action="admin-remake.php">
					<input type="hidden" name="pageName" value="<?PHP echo $name; ?>"/>
					<button type="submit" name="delete-page-submit" value="delete-page-submit">Delete</button>
				</form>
				
				
				
				<?PHP
			}
		}else{
		?>
			There was no page found try again...
		<?PHP
		}
	
	} elseif(isset($edit) && $edit=="true" && $username!="" && ($pass=="" || $pass!="true") && ($delete=="" || $delete!="true")) {
		
		
		//*******************************************
		//*******************************************
		//************USER EDIT PAGE*****************
		//*******************************************
		//*******************************************
		
		$page = "This is the edit page, you are editing: ". $_GET['username'];
		$sql = "SELECT * FROM Users WHERE username='". $_GET['username']."'";
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
				?>
				
				
				<div id='users-table'>
					<form action='admin-remake.php' method='POST'>
					<table>
						<tbody>
							<tr id='users-row'>
								<td id='users-cell'>Field</td>
								
								<td id='users-cell'>Value</td>
							</tr>
							<tr id='users-row'>
								<td id='users-cell'>ID</td>
								<input type='hidden' value='<?PHP echo $row['id']; ?>' name='id'/>
								<td id='users-cell'><input type='text' disabled size='1' name='id1' value='<?PHP echo $row['id']; ?>'/></td>
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
								<td id='users-cell'>Username</td>
								<td id='users-cell'><input type='text' size='10' name='username' value='<?PHP echo $row['username']; ?>'/></td>
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
								<td id='users-cell'><input type='date' size='10' name='birthday' value='<?PHP echo $row['birthday']; ?>'/></td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Bio</td>
								<td id='users-cell'><textarea rows='1' cols='20' name='bio'><?PHP echo $row['bio'] ?></textarea></td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>AuthQ</td>
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
								<td id='users-cell'>AuthA</td>
								<td id='users-cell'><input type='text' size='10' name='authA' value='<?PHP echo $row['authA']; ?>'/></td>
							</tr>
							<tr id='users-row'>
								<td id='users-cell'>Donator</td>
								<td id='users-cell'><input type='text' size='1' name='donator' value='<?PHP echo $row['donator']; ?>'/> Values:0,1</td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Site Level</td>
								<td id='users-cell'><input type='text' size='1' name='siteLevel' value='<?PHP echo $row['siteLevel']; ?>'/>Values:0-5</td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Active</td>
								<td id='users-cell'><input type='text' size='1' name='active' value='<?PHP echo $row['active']; ?>'/>Values:0,1</td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Banned</td>
								<td id='users-cell'><input type='text' size='1' name='banned' value='<?PHP echo $row['banned']; ?>'/>Values:0,1</td>
							</tr>
							<tr id='users-row'>	
								<td id='users-cell'>Locked</td>
								<td id='users-cell'><input type='text' size='1' name='locked' value='<?PHP echo $row['locked']; ?>'/>Values:0,1</td>
							</tr>
						<tbody>
					</table>
					<input type='submit' name='submitbtn' value='submitbtn' id='submitbtn'>
					</form>
					
					<form action='admin-remake.php' method='POST'>
						<input type='hidden' name='multicraft' value='true'/>
						<input type='hidden' name='username' value='<?PHP echo $_GET['username']; ?>'/>
						Create Multicraft Account:(ONLY for TRUSTED people.. gives access to multicraft as a user)
						<input type='submit' name='mcsubmit' value='GO' id='submitbtn'>
					</form>
					
					<a href='admin-remake.php?edit=true&pass=true&username=<?PHP echo $_GET['username']; ?>'>Change Users Password</a>
					
					<br><br>
					<a href='admin-remake.php?edit=true&pass=true&username=<?PHP echo $_GET['username']; ?>&delete=true'>Delete Account</a>
					<br><br>
					<a href='admin-remake.php'>Cancel / Go back</a>
					
					
				</div>
				
				
				
			<?PHP
			}

		} else{ //if no user in database with that name
			?>
				No user found, please try again or <a href='admin-remake.php'>go back</a>
			<?PHP
		}
	} elseif(isset($edit) && $edit=="true" && $username!="" && ($pass!="" || $pass=="true") && ($delete=="" || $delete!="true")){
		?>
			Editing password for: <?PHP echo $_GET['username']; ?>
		
		<form action='admin-remake.php' method='POST'>
			<input type='hidden' name='username' value='<?PHP echo $_GET['username']; ?>' />
			New Password: <input type='password' name='newPass' id='newPass' placeholder='Password' />
			<input type='submit' name='passSubmit' value='Submit' id='passSubmit' />
		</form>
		
		
		<?PHP
		
	}elseif(($delete!="" || $delete=="true") && $username!=""){
		?>
		ARE YOU 110% sure you wish to delete <?PHP echo $username; ?>??<br>
		If NOT, please click <a href='admin-remake.php?edit=true&username=<?PHP echo $_GET['username']; ?>'>here</a> to go back. (PS NOT IMPLEMENTED YET - JUST HERE FOR TESTING) 
		
		<br><br>
		
		Click here to delete the account. This IS PERMINENT so please click carefully: 
		<form method="POST" action="admin-remake.php">
			<input type="hidden" name="username" value="<?PHP echo $username; ?>" />
			<input type="submit" name="delBtn" value="delBtn" id="delBtn" />
		</form>
		<?PHP
	}elseif($username==""){ //if no user supplied in url 
		?>
			No user found, please try again or <a href='admin-remake.php'>go back</a>
		<?PHP
	}
	
} else {
	?>
		You are not allowed to be here, either you do not haver permission or you are not logged in. <a href='index.php'>Go back</a>
	<?PHP
}
include("includes/bottom.php");

?>