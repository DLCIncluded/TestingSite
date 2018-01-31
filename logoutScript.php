<?PHP
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['id']);
	unset($_SESSION['fName']);
	unset($_SESSION['lName']);
	unset($_SESSION['mcUsername']);
	
	if(!isset($_SESSION['username'])){ return "You have been logged out"; }


?>