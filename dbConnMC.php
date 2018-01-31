<?PHP
$db_username="root";

$db_password="Cc147258";

$db_server="localhost";

$db="multicraft_panel";

$connectionMC = new mysqli($db_server,$db_username,$db_password,$db);

if ($connectionMC->connect_error){
	die("Failed to connect: " + $connection->connect_error);
}
?>