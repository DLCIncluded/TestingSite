<?PHP
include_once("dbConn.php");
//Activate user


$username = $_GET['username'];
$activateCode = $_GET['code'];



if(isset($_GET["username"]) && isset($_GET["code"])) {
	$check = "SELECT active FROM Users WHERE username = '".$username."'";
	
	$result = $connection->query($check);
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			
			$sql = "UPDATE Users SET active = '1' WHERE username = '".$username."'";// set as active
			if($connection->query($sql) === TRUE){
			echo "Successfully activated ".$username;
			echo "Please click <a href='dlcincluded.com/login.php'>here</a> to login";
			} else {
				echo "An Error Occured please let the Admin know.";
			}
		}
		
	} else {
		echo "User not found.";
	}
	
	
}else {
	echo "oops something went wrong, please go back and try again!";
}


?>