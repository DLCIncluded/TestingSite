<?PHP
include_once("includes/top.php");

if($_GET['msg']=="register"){
	Echo "You have successfully been registered, Please check your email to activate your account.(you might have to check your spam folder)";
}elseif($_GET['msg']=="badpass"){
	echo "You have entered the wrong password <a class='login-button'>try again</a>";	
}elseif($_GET['msg']=="nouser"){
	echo "You need to ender a username. <a class='login-button'>Try again</a>";	
}elseif($_GET['msg']=="nopass"){
	echo "You need to ender a password. <a class='login-button'>Try again</a>";	
}elseif($_GET['msg']=="usernotexist"){
	echo "That account does not exist, would you like to register instead? <a class='register-form-button'>Register</a>";	
}elseif($_GET['msg']=="notactive"){
	echo "Your account is not activated, please check your email for the acivation email. Or you can <a href='resend.php'>resend email</a>";	
}

include_once("includes/bottom.php");
?>