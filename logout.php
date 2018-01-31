<?PHP
ini_set('display_errors', '1');
session_start();
include_once('accountManager.php');


if(isset($_SESSION['username'])){
	echo logout();
} else {
	echo 'You were not logged in';
	}
?>



