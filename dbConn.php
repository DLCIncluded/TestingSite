<?PHP
$db_username="root";

$db_password="password";

$db_server="localhost";

$db="DLCIncluded";

$connection = new mysqli($db_server,$db_username,$db_password,$db);

if ($connection->connect_error){
	die("Failed to connect: " + $connection->connect_error);
}
?>