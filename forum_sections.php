<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

?>
<h1>Forums</h1>

<?PHP
	$sql = "SELECT * FROM forum_sections ORDER BY ordered ASC LIMIT 10";
	
	$result = $connection->query($sql);
	while($row = $result->fetch_assoc()){
		$id=$row['id'];
		$title=$row['title'];
		$description=$row['description'];
		
		?>
		<div id="posts">
			<h3><a href='section.php?id=<?PHP echo $id; ?>'><?PHP echo $title; ?></a></h3>
			<p><?PHP echo $description; ?></p>
		</div>
		<?PHP
	}
	if($siteLevel>=5){
?>
		<br><br><a href="new_section.php">Create Section</a> (only site admins see this)
<?PHP
	}
include_once("includes/bottom.php");
?>