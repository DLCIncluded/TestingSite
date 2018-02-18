<?php
include_once("../includes/accountFunctions.php");

if(!empty($_POST["username"])) {
	$query = "SELECT * FROM Users WHERE userName='" . $_POST["username"] . "'";
	$userCount = numRows($query);

	if($userCount>0) {
		echo "fail";
	}else{
		echo "success";
	}
}
?>