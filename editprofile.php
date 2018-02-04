<?PHP
include_once("includes/top.php");

if(isset($username)){
	if(isset($_GET['username']) && $_GET['username']!=""){
		$sql = "SELECT * FROM Users";
		$result = $connection->query($sql); 
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$data .= "
				<tr id='users-row'>
					<td id='users-cell'>".$row['id']."</td>
					<td id='users-cell'>".$row['username']."</td>
					<td id='users-cell'>".$row['active']."</td>
					<td id='users-cell'>".$row['locked']."</td>
					<td id='users-cell'>".$row['banned']."</td>
					<td id='users-cell'><a href='admin-remake.php?edit=true&username=".$row['username']."'>Edit</a></td>
				</tr>
				
				";
			}
		}
	}
}
?>

<title>Edit Your Profile</title>

<h1>Edit Your Profile</h1>

<?PHP
include_once("includes/bottom.php");
?>