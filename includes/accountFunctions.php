<?PHP
ini_set('display_errors', '1');

include_once("dbConn.php");

		//*******************************************
		//*******************************************
		//************Custom Functions***************
		//*******************************************
		//*******************************************

function login($log_username,$log_password,$log_page){
	
$username = $log_username;
$pass = $log_password;

	if($username && $pass){
	  
		if ($username != "") {
			if ($pass != "") {

					$sql = "SELECT * FROM Users WHERE username='".$username."' AND active='1'"; 
					global $connection;
					$result = $connection->query($sql);
					
					while($row = $result->fetch_assoc()){
						$username = $row['username'];
						$password_hash = $row['password'];
						
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
							return "bad password <a href='login.php'>try again</a>";
						}
					}

			} else {
				return "Missing Password";
			}
		
		} else {
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
			
			$sql = "UPDATE Users SET active = '1' WHERE username = '".$username."'";// set as active
			if($connection->query($sql) === TRUE){
				echo "Successfully activated ".$username;
				echo "Please click the button in the top right to login.";
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

?>