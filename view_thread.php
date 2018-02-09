<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

	if(isset($username)){
		$thread_id=$_GET['id'];
		$sql="SELECT * FROM forum_posts WHERE id='$thread_id' AND type='a'";//pull just the original post
		if($result=$connection->query($sql)){
			
			if($result->num_rows == 1){
				
				while($row=$result->fetch_assoc()){
					$post_author = $row['post_author'];
					$post_author_id = $row['post_author_id'];
					$date_time = $row['date_time'];
					$date_time = strftime("%b %d %Y",strtotime($date_time));//convert to Month ##, YYYY
					$section_title = $row['section_title'];
					$section_id = $row['section_id'];
					$thread_title = $row['thread_title'];
					$post_body = $row['post_body'];
				}
				
			}else{
				echo "That thread does not exist.";
			}
			
		}else{
			echo "Something has gone seriously wrong, please tell the Admin this(or try again):" . $sql . "<br>" . $connection->error;
		}
		$sql="SELECT * FROM forum_posts WHERE orig_topic_id='$thread_id' AND type='b'";
		$result=$connection->query($sql);
		$replies="";
		if($result->num_rows > 0){
			while($row=$result->fetch_assoc()){
				
				$reply_author = $row['post_author'];
				$reply_author_id = $row['post_author_id'];
				$reply_date_time = $row['date_time'];
				$reply_date_time = strftime("%b %d %Y",strtotime($reply_date_time));//convert to Month ##, YYYY
				//convert to time ago eventually
				$reply_post_body = $row['post_body'];
				
				$replies.="<div id='response_top'>Re: ".$thread_title."&nbsp; &nbsp; &bull; &nbsp; &nbsp; ".$reply_date_time ." <a href='profile.php?username=".$reply_author."'>".$reply_author."</a> said:</div>
				<div id='response_bottom'>".$reply_post_body."</div>";
				
			}
		}else{
			$replies = "There are no replies yet.";
		}
		
	}else{
		echo "Please <a href='#' class='login-button'>Login</a> to view this page.";
	}
	
	?>
	<h1 id="topic_title"><?PHP echo $thread_title; ?></h1>
	<div id="author_div">Topic started by: <a href='profile.php?username=<?PHP echo $post_author; ?>'><?PHP echo $post_author; ?></a> &nbsp; &nbsp; &nbsp; &nbsp;Created on: <?PHP echo $date_time; ?>
	<hr/>
	</div>
	
	<div id="post_div"><?PHP echo $post_body; ?>
	<hr/>
	</div>
	<div id="replies"><?PHP echo $replies; ?></div>
	<br><br>
	<form action="includes/postHandler.php" method="post" name="reply">
			
		<textarea name="post_body" placeholder=""></textarea><br><br>
		<input type="submit" name="reply" value="Reply to Post" />
		
		<input type="hidden" name="orig_topic_id" value="<?PHP echo $thread_id; ?>" />
		<input type="hidden" name="section_id" value="<?PHP echo $section_id; ?>" />
		<input type="hidden" name="post_title" value="<?PHP echo $thread_title; ?>" />
		<input type="hidden" name="section_title" value="<?PHP echo $section_title; ?>" />
		<input type="hidden" name="post_type" value="b" /><!-- a for new, b for reply -->
		

	</form>
	
	<?PHP

include_once("includes/bottom.php");
?>