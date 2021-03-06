<?PHP
ini_set('display_errors', '1');
include("includes/top.php");
//require("includes/MulticraftAPI.php");
//$api = new MulticraftAPI('https://dlcincluded.com/multicraft/api.php', 'DLCIncluded', '+n2DLp2z*mZoBz');



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
if(isset($_GET['delete'])){
	$delete=$_GET['delete'];
} else {
	$delete="";
}

if(isset($_SESSION['username']) && isset($_SESSION['siteLevel']) && $_SESSION['siteLevel'] >= 5){ //if logged in and level >= 5
	
		//*******************************************
		//*******************************************
		//*************FORM HANDLING*****************
		//*******************************************
		//*******************************************
		
		
	if(isset($_POST['submitBtn'])){ //process the updates on users account
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
	

	if(isset($_POST['mcSubmit'])){ //add user to Multicraft via API
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
	
	if(isset($_POST['newPageSubmit'])){
		$name=$_POST['pageName'];
		
		$page=$_POST['pageData'];
		
		$fileName=ucwords($name," ");
		$fileName=str_replace(" ","",$fileName);
		$fileName=lcfirst($fileName);
		
		$page=str_replace("'","\'",$page); 
		$page=str_replace('"','\"',$page); 
		$sql = "INSERT INTO Pages VALUES (NULL,'".$name."','".$fileName."','".$page."')"; 
		if($connection->query($sql) === TRUE){
			echo "Page created at <a href='".$fileName.".php'>".$name."</a>";
			
			$file = $fileName.'.php';
			if(!is_file($file)){
				$contents = 'This is a test!';
				file_put_contents($file, "
				
				<?php include('includes/top.php'); 
				
					\$page = basename(__FILE__, '.php'); 
	
					\$sql = \"SELECT * FROM Pages WHERE fileName='\".\$page.\"'\";
					
					\$result = \$connection->query(\$sql); 
					
					if(\$result->num_rows > 0){
						while(\$row = \$result->fetch_assoc()){
							
							echo '<title>'.\$row['name'].'</title>';
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
	
	if(isset($_POST['editPageSubmit'])){
		$name=$_POST['pageName'];
		$page=$_POST['pageData'];
		$page=str_replace("'","\'",$page); 
		$page=str_replace('"','\"',$page); 
		$sql = "Update Pages SET pageData='".$page."' WHERE name='".$name."'"; 
		if($connection->query($sql) === TRUE){
			echo "Edits were successful for <a href='".$name.".php'>".$name."</a>";
		}else {
			echo $sql . "<br>" . $connection->error;
		}
	}
	
	if(isset($_POST['deletePageSubmit'])){
		$name=$_POST['pageName'];
		
		$sql = "SELECT * FROM Pages WHERE name='".$name."'";
		
		$result = $connection->query($sql);
		if($result->num_rows == 1){
			while($row = $result->fetch_assoc()){
				$fileName = $row['fileName'];
			}
		
			$fileName = $fileName.'.php';
			$sql = "DELETE FROM Pages WHERE name='".$name."'"; 
			if($connection->query($sql) === TRUE){
				if(unlink($fileName)){
					echo "Successfully deleted ".$name." <a href='admin.php'>Reload page</a>";
				}else{
					echo "Failed to delete the file.. please let the admin know that ".$fileName." was not deleted successfully...";
				}
			}else {
				echo $sql . "<br>" . $connection->error;
			}
		}else{
			echo "Page not found";
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
				<tr id='usersRow'>
					<td id='usersCell'>".$row['id']."</td>
					<td id='usersCell'>".$row['username']."</td>
					<td id='usersCell'>".$row['active']."</td>
					<td id='usersCell'>".$row['locked']."</td>
					<td id='usersCell'>".$row['banned']."</td>
					<td id='usersCell'><a href='admin.php?edit=true&username=".$row['username']."'>Edit</a></td>
				</tr>
				
				";
			}
		}
		?>
		
			<div id='usersTable'>
				<table>
					<tbody>
						<tr id='usersRow'>
							<td id='usersCell'>ID</td>
							<td id='usersCell'>Username</td>
							<td id='usersCell'>Active</td>
							<td id='usersCell'>Locked</td>
							<td id='usersCell'>Banned</td>
							<td id='usersCell'>Edit</td>
						</tr>
							<?PHP echo $data ?>
					<tbody>
				</table>
			</div>
			
			<div id='functionsTable'>
				<ul>
					<li><a href="admin.php?edit=true&page=new">New Page</a></li>
					<li><a href="admin.php?edit=true&page=edit">Edit a Page</a></li>
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
			
			<form method="POST" action="admin.php">
				<input type="text" name="pageName" placeholder="Page Name" />Spaces are okay, it will change to an underscore on the backend automagically<br>
                <textarea placeholder="Page Data" cols=50 rows=15 name="pageData"></textarea><br>
                <button type="submit" name="newPageSubmit" value="newPageSubmit">Submit</button>
			</form>
			
		
		<?PHP
		
		
	
	}elseif(isset($edit) && $edit=="true" && ($username=="" || !isset($username)) && ($pass=="" || $pass!="true") && $page=="edit" && ($name=="" || !isset($name))){
		echo "This is the edit selection page";
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
				<a href="admin.php?edit=true&page=edit&name=<?PHP echo $name;?>"><?PHP $name=str_replace("_"," ",$name); $name=strtolower($name); echo ucfirst($name); ?></a>
				<?PHP
			}
		}else{
		?>
			There was no page found try again...
		<?PHP
		}
	}elseif(isset($edit) && $edit=="true" && ($username=="" || !isset($username)) && ($pass=="" || $pass!="true") && $page=="edit" && ($name!="" || isset($name)) && ($delete=="" || !isset($delete))){
		
		$sql = "SELECT * FROM Pages WHERE name='". $name ."'";

		$result = $connection->query($sql);
		
		if($result->num_rows == 1){ //make sure we only have one result
			while($row = $result->fetch_assoc()){
				$name=$row['name'];
				$pageData=$row['pageData'];
				?>
				
				<h1>Edit Page</h1>
				
				<form method="POST" action="admin.php">
					<input type="text" name="" value="<?PHP echo $name; ?>" disabled/><br>
					<input type="hidden" name="pageName" value="<?PHP echo $name; ?>"/>
					<textarea placeholder="Page Data" cols=50 rows=15 name="pageData"><?PHP echo $pageData; ?></textarea><br>
					<button type="submit" name="editPageSubmit" value="editPageSubmit">Submit</button>
				</form>
				
				<br />
				<?PHP
				if($name!="home"){
				?>
				<a href='admin.php?edit=true&page=edit&name=<?PHP echo $name ?>&delete=true'>Delete Page</a>	
				<?PHP
				}
				?>
				<br><br>
				<a href='admin.php?edit=true&page=edit'>Cancel/Go Back</a>	
				
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
				
				
				<div id='usersTable'>
					<form action='admin.php' method='POST'>
					<table>
						<tbody>
							<tr id='usersRow'>
								<td id='usersCell'>Field</td>
								
								<td id='usersCell'>Value</td>
							</tr>
							<tr id='usersRow'>
								<td id='usersCell'>ID</td>
								<input type='hidden' value='<?PHP echo $row['id']; ?>' name='id'/>
								<td id='usersCell'><input type='text' disabled size='1' name='id1' value='<?PHP echo $row['id']; ?>'/></td>
							</tr>
							<tr id='usersRow'>							
								<td id='usersCell'>First Name</td>
								<td id='usersCell'><input type='text' size='7' name='fName' value='<?PHP echo $row['fName']; ?>'/></td>
							</tr>	
							<tr id='usersRow'>	
								<td id='usersCell'>Last Name</td>
								<td id='usersCell'><input type='text' size='7' name='lName' value='<?PHP echo $row['lName']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Username</td>
								<td id='usersCell'><input type='text' size='10' name='username' value='<?PHP echo $row['username']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Email</td>
								<td id='usersCell'><input type='text' size='20' name='email' value='<?PHP echo $row['email']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>mcUsername</td>
								<td id='usersCell'><input type='text' size='20' name='mcUsername' value='<?PHP echo $row['mcUsername']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Birthday</td>
								<td id='usersCell'><input type='date' size='10' name='birthday' value='<?PHP echo $row['birthday']; ?>'/></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Bio</td>
								<td id='usersCell'><textarea rows='1' cols='20' name='bio'><?PHP echo $row['bio'] ?></textarea></td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>AuthQ</td>
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
								<td id='usersCell'>AuthA</td>
								<td id='usersCell'><input type='text' size='10' name='authA' value='<?PHP echo $row['authA']; ?>'/></td>
							</tr>
							<tr id='usersRow'>
								<td id='usersCell'>Donator</td>
								<td id='usersCell'><input type='text' size='1' name='donator' value='<?PHP echo $row['donator']; ?>'/> Values:0,1</td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Site Level</td>
								<td id='usersCell'><input type='text' size='1' name='siteLevel' value='<?PHP echo $row['siteLevel']; ?>'/>Values:0-5</td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Active</td>
								<td id='usersCell'><input type='text' size='1' name='active' value='<?PHP echo $row['active']; ?>'/>Values:0,1</td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Banned</td>
								<td id='usersCell'><input type='text' size='1' name='banned' value='<?PHP echo $row['banned']; ?>'/>Values:0,1</td>
							</tr>
							<tr id='usersRow'>	
								<td id='usersCell'>Locked</td>
								<td id='usersCell'><input type='text' size='1' name='locked' value='<?PHP echo $row['locked']; ?>'/>Values:0,1</td>
							</tr>
						<tbody>
					</table>
					<input type='submit' name='submitbtn' value='submitbtn' id='submitbtn'>
					</form>
					<!--
					error with API calling twice when chat is on page & this really isn't needed so commenting out.
					<form action='admin.php' method='POST'>
						<input type='hidden' name='multicraft' value='true'/>
						<input type='hidden' name='username' value='<?PHP echo $_GET['username']; ?>'/>
						Create Multicraft Account:(ONLY for TRUSTED people.. gives access to multicraft as a user)
						<input type='submit' name='mcSubmit' value='GO' id='submitBtn'>
					</form>
					-->
					<a href='admin.php?edit=true&pass=true&username=<?PHP echo $_GET['username']; ?>'>Change Users Password</a>
					
					<br><br>
					<a href='admin.php?edit=true&pass=true&username=<?PHP echo $_GET['username']; ?>&delete=true'>Delete Account</a>
					<br><br>
					<a href='admin.php'>Cancel / Go back</a>
					
					
				</div>
				
				
				
			<?PHP
			}

		} else{ //if no user in database with that name
			?>
				No user found, please try again or <a href='admin.php'>go back</a>
			<?PHP
		}
	} elseif(isset($edit) && $edit=="true" && $username!="" && ($pass!="" || $pass=="true") && ($delete=="" || $delete!="true")){
		?>
			Editing password for: <?PHP echo $_GET['username']; ?>
		
		<form action='admin.php' method='POST'>
			<input type='hidden' name='username' value='<?PHP echo $_GET['username']; ?>' />
			New Password: <input type='password' name='newPass' id='newPass' placeholder='Password' />
			<input type='submit' name='passSubmit' value='Submit' id='passSubmit' />
		</form>
		
		
		<?PHP
		
	}elseif(($delete!="" || $delete=="true") && $name!=""){
		?>
		ARE YOU 110% sure you wish to delete <?PHP echo $name; ?>??<br>
		If NOT, please click <a href='admin.php?edit=true&page=edit&name=<?PHP echo $_GET['name']; ?>'>here</a> to go back.
		
		<br><br>
		
		Click here to delete the page. This IS PERMINENT so please click carefully: <br><br>
		<form method="POST" action="admin.php">
			<input type="hidden" name="pageName" value="<?PHP echo $name; ?>"/>
			<button type="submit" name="deletePageSubmit" value="deletePageSubmit">Delete <?PHP $name=str_replace("_"," ",$name); $name=strtolower($name); echo ucfirst($name); ?></button>
		</form>
		<?PHP
	}elseif(($delete!="" || $delete=="true") && $username!=""){
		?>
		ARE YOU 110% sure you wish to delete <?PHP echo $username; ?>??<br>
		If NOT, please click <a href='admin.php?edit=true&username=<?PHP echo $_GET['username']; ?>'>here</a> to go back.
		
		<br><br>
		
		Click here to delete the account. This IS PERMINENT so please click carefully: 
		<form method="POST" action="admin.php">
			<input type="hidden" name="username" value="<?PHP echo $username; ?>" />
			<input type="submit" name="delBtn" value="Delete User" id="delBtn" />
		</form>
		<?PHP
	}elseif($username==""){ //if no user supplied in url 
		?>
			No user found, please try again or <a href='admin.php'>go back</a>
		<?PHP
	}
	
} else {
	?>
		You are not allowed to be here, either you do not haver permission or you are not logged in. <a href='index.php'>Go back</a>
	<?PHP
}
include("includes/bottom.php");

?>