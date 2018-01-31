<?PHP
//ini_set('display_errors', '1');
include_once("dbConn.php");

function login($log_username,$log_password){
	
$username = $log_username;
$pass = $log_password;

	if($username && $pass){
	  
		if ($username != "") {
			if ($pass != "") {

					
					$sql = "SELECT * FROM Users WHERE username='".$username."'"; 
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
							return "You have successfully been logged in ".$_SESSION['username'];

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
	
	if(!isset($_SESSION['username'])){ return "You have been logged out"; }
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