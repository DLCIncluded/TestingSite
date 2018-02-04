<?php
ini_set('display_errors', '1');
include("accountFunctions.php");
if(!empty($_POST["username"])) {
  $query = "SELECT * FROM Users WHERE userName='" . $_POST["username"] . "'";
  $user_count = numRows($query);

  if($user_count>0) {
      echo "<span class='status-not-available'> Username Not Available.</span>";
  }else{
      echo "<span class='status-available'> Username Available.</span>";
  }
}
?>