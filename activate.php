<?PHP
include_once("includes/top.php");

if(isset($_GET["username"]) && isset($_GET["code"])) {
	$username = $_GET['username'];
	$activateCode = $_GET['code'];
	echo activate($username,$activateCode);
}else {
	echo "oops something went wrong, please go back and try again!";
}

include_once("includes/bottom.php");
?>