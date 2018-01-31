<?PHP
session_start();
include_once("dbConn.php");
//ini_set('display_errors', '1');
$username = $_POST['username'];
$pass = $_POST['pass'];

if($username && $pass){
  
	if ($username != "") {
		if ($pass != "") {

				
				$sql = "SELECT * FROM Users WHERE username='".$username."'"; 
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
						echo "You have successfully been logged in ".$_SESSION['username'];

					}else{
						echo "bad password";
					}
				}

		} else {
			echo "Missing Password";
		}
	
	} else {
		echo "Missing Username";
	}
}





?>