<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");
$list="";
	if(isset($_GET['id']) && $_GET['id']!=""){
		$sid = preg_replace('#[^0-9]#i','',$_GET['id']); //filter out for query which i need to do for everything..
		$sql = "SELECT * FROM forum_sections WHERE id='$sid' LIMIT 1";
		$result = $connection->query($sql);
		if($result->num_rows == 1){
			while($row=$result->fetch_assoc()){
				$section_title = $row['title'];
			}
		}else{
			$list = "That section does not exist. Please go back and try again.";
		}
		
		$sql = "SELECT * FROM forum_posts WHERE type='a' AND section_id='$sid' ORDER BY date_time DESC LIMIT 25"; //type='a' means it was the main post not a reply
		$result = $connection->query($sql);
		if($result->num_rows >= 1){
			while($row=$result->fetch_assoc()){
				$id = $row['id'];
				$thread_title = $row['thread_title'];
				$list .= "<a href='view_thread.php?id=$id'>$thread_title</a><br><br>";
			}
		}else{
			$list = "No posts found. You can create one if you'd like!";
		}
	
	}else{
		$list = "No Forum Selected.";
	}

	
	?>
	<h1><?PHP echo $section_title;?></h1>
	<form method="POST" action="new_topic.php">
		<input type="hidden" name="sid" value="<?PHP echo $sid; ?>"/>
		<input type="hidden" name="section_title" value="<?PHP echo $section_title; ?>"/>
		<input type="submit" name="createTopic" value="Create New Topic"/><br><br>
	</form>
	<?PHP
echo $list;
	

include_once("includes/bottom.php");
?>