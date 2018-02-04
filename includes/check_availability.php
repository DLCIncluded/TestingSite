<?php
include_once("../includes/accountFunctions.php");

if(!empty($_POST["username"])) {
	$query = "SELECT * FROM Users WHERE userName='" . $_POST["username"] . "'";
	$user_count = numRows($query);

	if($user_count>0) {
		echo "fail";
	}else{
		echo "success";
	}
}
?>