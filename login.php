<style type="text/css">
	#main-content > #login-form {
		line-height:80px;
	}
</style>

<title>DLCIncluded's Server</title>
<?php
include_once('includes/top.php'); 
if(!isset($username)){
	include('includes/login.php');
}else{
	echo "You are already logged in. Please <a href='index.php'>go back</a>";
}
include_once('includes/bottom.php'); 
?>