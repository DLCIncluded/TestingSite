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
			$section_title = "Post not Found";
			$list = "That section does not exist. Please go back and try again.";
		}
		
		$sql = "SELECT * FROM forum_posts WHERE type='a' AND section_id='$sid' ORDER BY date_time DESC LIMIT 25"; //type='a' means it was the main post not a reply
		$result = $connection->query($sql);
		if($result->num_rows >= 1){
			while($row=$result->fetch_assoc()){
				$id = $row['id'];
				$thread_title = $row['thread_title'];
				$post_author = $row['post_author'];
				$date_time = $row['date_time'];
				$date_time = convert_time($date_time);
				$status = $row['closed'];
				if($status == "0"){
					$status = "Open";
				}else{
					$status = "Closed";
				}
				$list .= "
				<div id='posts'>
					<h3><a href='view_thread.php?id=$id'>$thread_title</a></h3>
					<p>Started by: $post_author&nbsp;&nbsp;$date_time&nbsp;&nbsp;Status: $status
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
	<h1><?PHP echo $section_title;?></h1>
	<?PHP 
	if($section_title != "Post not Found"){
	?>

		<a href="new_post.php?sid=<?PHP echo $sid; ?>&section_title=<?PHP echo $section_title; ?>" id="createTopic" name="createTopic">Create New Post</a><br><br>

	<div id="posts-container">
	<?PHP
		echo $list;
	?>
	</div>
	<?PHP
	}
include_once("includes/bottom.php");
?>