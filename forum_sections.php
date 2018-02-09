<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");


	$sql = "SELECT * FROM forum_sections ORDER BY ordered ASC LIMIT 10";
	
	$result = $connection->query($sql);
	while($row = $result->fetch_assoc()){
		$id=$row['id'];
		$title=$row['title'];
		echo "<a href='section.php?id=$id'>$title</a><br><br>";
	}

include_once("includes/bottom.php");
?>