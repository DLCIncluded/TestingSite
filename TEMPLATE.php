<?PHP 
include_once("includes/top.php"); 

	$page = basename(__FILE__, '.php'); 
	
	$sql = "SELECT * FROM Pages WHERE name='".$page."'";
	
	$result = $connection->query($sql); 
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo $row['pageData'];
		}
	} else {
		echo "No page found.";
	}
	
include_once("includes/bottom.php"); 
?>