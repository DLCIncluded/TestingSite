<?PHP
ini_set('display_errors', '1');
//This is mainly for testing... no idea if it will work
include_once("includes/dbConn.php");
include_once("includes/accountFunctions.php");



/*
 This will update the db with UUID's if none are there.. don't really need but will hold onto in case
$sql = "SELECT * FROM Users";
$result=$connection->query($sql);

if($result->num_rows > 0){
	
	while($row=$result->fetch_assoc()){
		$mcUser=$row['mcUsername'];
		$UUID = file_get_contents("https://api.mojang.com/users/profiles/minecraft/$mcUser");
		$UUIDdata = json_decode($UUID);
		$id = $UUIDdata->id;
		echo $row['username']." - ".$id;
		
		$sqlmc="UPDATE Users SET UUID = '".$id."'WHERE mcUsername='".$mcUser."'";
		if($connection->query($sqlmc)){
			echo "added to db";
		}else{
			echo "error: " . $sql . "<br><br>" . $connection->error;
		}
	}
	
}
*/

$sql = "SELECT * FROM Users";
$find=$connection->query($sql);

if($find->num_rows > 0){
	
	while($row=$find->fetch_assoc()){
		$mcUser=$row['mcUsername'];
		$uuid=$row['UUID'];
		$output_filename_head = "images/mcUsers/".$mcUser."-head.png";
		$output_filename_body = "images/mcUsers/".$mcUser."-body.png";
		//echo $row['username']." - ".$id;
		
		checkMCPic($mcUser,"head");
		checkMCPic($mcUser,"body");
		
		echo "Successfully ran and updated the users pictures for $mcUser.<br>";
	}
}

?>