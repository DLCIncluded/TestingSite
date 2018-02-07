<?PHP
include_once("dbConn.php");

		//*******************************************
		//*******************************************
		//************Custom Functions***************
		//*******************************************
		//*******************************************

function login($log_username,$log_password,$log_page){
	
$username = $log_username;
$pass = $log_password;
if($log_page=="activate.php" || $log_page="login.php"){
	$log_page="index.php";
}
	if($username && $pass){
	  
		if ($username != "") {
			if ($pass != "") {

					$sql = "SELECT * FROM Users WHERE username='".$username."'"; // AND active='1'
					global $connection;
					$result = $connection->query($sql);
					if($result->num_rows == 1){
						while($row = $result->fetch_assoc()){
							$username = $row['username'];
							$password_hash = $row['password'];
							if($row['active']=="1"){
								if(crypt($pass, $password_hash) == $password_hash) {
								//valid password
									$_SESSION['username'] = $username;
									$_SESSION['id'] = $row['id'];
									$_SESSION['fName'] = $row['fName'];
									$_SESSION['lName'] = $row['lName'];
									$_SESSION['mcUsername'] = $row['mcUsername'];
									$_SESSION['siteLevel'] = $row['siteLevel'];
									header("Location: ../".$log_page);
								}else{
									header("Location: ../status.php?msg=badpass");
								}
							} else {
								header("Location: ../status.php?msg=notactive");
							}		
						}
					}else{
						header("Location: ../status.php?msg=usernotexist");
					}
					

			} else {
				header("Location: ../status.php?msg=nopass");
				return "Missing Password";
			}
		
		} else {
			header("Location: ../status.php?msg=nousername");
			return "Missing Username";
		}
	}
}


function logout(){
	
	unset($_SESSION['username']);
	unset($_SESSION['id']);
	unset($_SESSION['fName']);
	unset($_SESSION['lName']);
	unset($_SESSION['mcUsername']);
	unset($_SESSION['siteLevel']);
	
	if(!isset($_SESSION['username'])){ 
		header("Location: ../index.php");
	}
}

function activate($username,$code){
	
	$check = "SELECT active FROM Users WHERE username = '".$username."' AND activeCode='".$code."'";
	global $connection;
	$result = $connection->query($check);
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			
			$sql = "UPDATE Users SET active = '1' WHERE username = '".$username."' AND active='0'";// set as active
			if($connection->query($sql) === TRUE){
				echo "Successfully activated ".$username;
				echo " Please click the button in the top right to login.<br><br>";
				
				//if(mkdir("images/profiles/".$username, 0755)){
					//if(copy("images/default.png","images/profiles/".$username."/profilepic.png")){
						//echo "Successfully created profile folder and setup default profile pic";
					//}else{
						//echo "ERROR:**failed to copy the default profile pic";
					//}
				//}else{
					//echo "ERROR:**failed to create profile directory, please inform an admin or staff member.**";
				//}
			} else {
				echo "An Error Occured please let the Admin know.";
			}
		}
		
	} else {
		echo "Incorrect username or code...";
	}
}

function checklogin(){
	if(isset($_SESSION['username'])){
		$GLOBALS['username']=$_SESSION['username'];
		$GLOBALS['id']=$_SESSION['id'];
		$GLOBALS['fName']=$_SESSION['fName'];
		$GLOBALS['lName=']=$_SESSION['lName'];
		$GLOBALS['mcUsername']=$_SESSION['mcUsername'];
		$GLOBALS['siteLevel']=$_SESSION['siteLevel'];
	}
}

function delUser($user){
	$username=$user;
	$sql = "DELETE FROM Users WHERE username='".$username."'"; 
	global $connection;
	if($connection->query($sql) === TRUE){
		return "Successfully deleted ".$username;
	}else {
		return $sql . "<br>" . $connection->error;
	}
}


function changePass($username,$newPass){
	
	$salt = md5($username); //Create Salt for password crypt
	$password = crypt($newPass, '$2a$07$'.$salt.'$'); //Encrypt password using blowfish + salt just created
	global $connection;
	$sql = "Update Users SET password='".$password."' WHERE username='".$username."'"; 
	if ($connection->query($sql) === TRUE){ //if the query is successful
		return "Applying updates for: ".$username." was successful.";
	} else { //echo out error if failed
		return "error: " . $sql . "<br><br>" . $connection->error;
	}
}

function numRows($query) {
	global $connection;
	$result  = $connection->query($query);
	$rowcount = $result->num_rows;
	return $rowcount;	
}

function getMCPic($mcUser){
	$file = $mcUser.'.png';
		$UUID = file_get_contents("https://api.mojang.com/users/profiles/minecraft/$mcUser");
		$UUIDdata = json_decode($UUID);
		echo $UUIDdata->id;
}


function checkMCPic($mcUser,$type){
	$output_filename_head = "images/mcUsers/".$mcUser."-head.png";
	$output_filename_body = "images/mcUsers/".$mcUser."-body.png";
	if($type=="head"){
		
		if(!is_file($output_filename_head)){
			
			$UUID = file_get_contents("https://api.mojang.com/users/profiles/minecraft/$mcUser");
			$UUIDdata = json_decode($UUID);
			$id = $UUIDdata->id;
			
			
			$host = "https://crafatar.com/avatars/$mcUser";
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_AUTOREFERER, false);
			curl_setopt($ch, CURLOPT_REFERER, "http://dlcincluded.com");
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$result = curl_exec($ch);
			curl_close($ch);

			$fp = fopen($output_filename_head, 'w');
			fwrite($fp, $result);
			fclose($fp);
			
		}
		return $output_filename_head;
	} elseif($type=="body"){

		if(!is_file($output_filename_body)){
			
			$UUID = file_get_contents("https://api.mojang.com/users/profiles/minecraft/$mcUser");
			$UUIDdata = json_decode($UUID);
			$id = $UUIDdata->id;
			
			$host = "https://crafatar.com/renders/body/$mcUser";
		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_AUTOREFERER, false);
			curl_setopt($ch, CURLOPT_REFERER, "http://dlcincluded.com");
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$result = curl_exec($ch);
			curl_close($ch);

			$fp = fopen($output_filename_body, 'w');
			fwrite($fp, $result);
			fclose($fp);
			
		}
		return $output_filename_body;
			
		}
		

	}


?>