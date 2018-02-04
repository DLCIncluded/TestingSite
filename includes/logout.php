<?PHP
session_start();
include_once('accountFunctions.php');


if(isset($_SESSION['username'])){
	echo logout();
} else {
		header("Location: ../index.php");
	}
?>



