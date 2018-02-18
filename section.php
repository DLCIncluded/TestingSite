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
				$sectionTitle = $row['title'];
			}
		}else{
			$sectionTitle = "Post not Found";
			$list = "That section does not exist. Please go back and try again.";
		}
		
		$sql = "SELECT * FROM forum_posts WHERE type='a' AND section_id='$sid' ORDER BY date_time DESC LIMIT 25"; //type='a' means it was the main post not a reply
		$result = $connection->query($sql);
		if($result->num_rows >= 1){
			while($row=$result->fetch_assoc()){
				$id = $row['id'];
				$threadTitle = $row['thread_title'];
				$postAuthor = $row['post_author'];
				$dateTime = $row['date_time'];
				$dateTime = convertTime($dateTime);
				$status = $row['closed'];
				if($status == "0"){
					$status = "Open";
				}else{
					$status = "Closed";
				}
				$list .= "
				<div id='posts'>
					<h3><a href='viewThread.php?id=$id'>$threadTitle</a></h3>
					<p>Started by: $postAuthor&nbsp;&nbsp;$dateTime&nbsp;&nbsp;Status: $status
				</div>
				";
			}
		}else{
			$list = "No posts found. You can create one if you'd like!";
		}
	
	}else{
		$list = "No Forum Selected.";
	}

	
	?>
	<h1><?PHP echo $sectionTitle;?></h1>
	<?PHP 
	if($sectionTitle != "Post not Found"){
	?>

		<a href="newPost.php?sid=<?PHP echo $sid; ?>&sectionTitle=<?PHP echo $sectionTitle; ?>" id="createTopic" name="createTopic">Create New Post</a><br><br>

	<div id="postsContainer">
	<?PHP
		echo $list;
	?>
	</div>
	<?PHP
	}
include_once("includes/bottom.php");
?>