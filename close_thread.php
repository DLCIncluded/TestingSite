<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

	if(isset($username) && (isset($_GET['id']) && $_GET['id'] != '') && (!isset($_GET['confirm']) || $_GET['confirm'] == '')){
		$post_id = $_GET['id'];
		$sql = "SELECT * FROM forum_posts WHERE id='".$post_id."' AND closed='0'";
		$result = $connection->query($sql);
		if($result->num_rows >= 1){
			while($row = $result->fetch_assoc()){
				$post_author = $row['post_author'];
				
			}
		}else{
			$post_author ='';
		}
		if(($username == $post_author) || $siteLevel < 5 ){
		?>
			Are you 100% sure you wish to close this topic? It can only be reopened by an admin so please choose this carefully.
			If you are sure you want this closed please click here: <a href="close_thread.php?id=<?PHP echo $_GET['id'];?>&confirm=true">Close thread</a>
		<?PHP
		}else{
			echo "You are not allowed to close someone else's post, or this post is already closed.";
		}
	}elseif(isset($username) && (isset($_GET['id']) && $_GET['id'] != '') && (isset($_GET['confirm']) && $_GET['confirm'] == 'true')){
		$post_id = $_GET['id'];
		$sql = "SELECT * FROM forum_posts WHERE id='".$post_id."' AND closed='0'";
		$result = $connection->query($sql);
		if($result->num_rows >= 1){
			while($row = $result->fetch_assoc()){
				$post_author = $row['post_author'];
				$post_title = $row['thread_title'];
			}
		}else{
			$post_author ='';
		}
		if(($username == $post_author) || $siteLevel < 5 ){
			$sql = "UPDATE forum_posts SET closed='1' WHERE id='".$post_id."'";
			if($connection->query($sql) === true){
				echo "Successfully closed post \"".$post_title."\"";
			}else{
				echo "Error: ".$connection->error;
			}
		}else{
			echo "You are not allowed to close someone else's post, or this post is already closed.";
		}
	}else{
		echo "Something broke please go back and try again.";
	}


include_once("includes/bottom.php");
?>