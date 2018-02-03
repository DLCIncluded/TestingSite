<?PHP
//ini_set('display_errors', '1');
session_start();
include_once("dbConn.php");
include_once('accountManager.php');

if(isset($_POST['username'])){
	echo login($_POST['username'],$_POST['pass']);
}


if(isset($_SESSION['username']) && !isset($_POST['username'])){
	echo "You are already logged in ".$_SESSION['fName'];
} elseif (!isset($_SESSION['username']) && !isset($_POST['username'])) {

?>
	<form method="POST"  id="login-form"><!-- action="login.php" -->
		<input type="text" name="username" id="username" placeholder="Username" required/>
		<input type="password" name="pass" id="pass" placeholder="Password" required/>
		<button type="submit" id="login-submit" onClick="login()">Submit</button> <br>
		<p>Don't Have an Account? <a onClick="swap1()">Register</a></p>
	</form>
	
	<!--<form method="POST" action="login.php">
		Username: <input type="text" name="username" id="username" placeholder="Username" required/><br/>
		Password: <input type="password" name="pass" id="pass" placeholder="Password" required/><br/>
		<input type="submit" name="submitbtn" id="submitbtn">	
	</form>-->
			
<?PHP
	}
?>



