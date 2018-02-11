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
					$post_id = $row['id'];
					$date_time = $row['date_time'];
					$date_time = strftime("%b %d %Y",strtotime($date_time));//convert to Month ##, YYYY
					$section_title = $row['section_title'];
					$section_id = $row['section_id'];
					$thread_title = $row['thread_title'];
					$post_body = $row['post_body'];
					$status = $row['closed'];
					if($status == '0'){
						$status = "Open";
					}else{
						$status = "Closed";
					}
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
				$reply_date_time = convert_time($row['date_time']);
				//$reply_date_time = strftime("%b %d %Y",strtotime($reply_date_time));//convert to Month ##, YYYY
				//convert to time ago eventually
				$reply_post_body = $row['post_body'];
				
				$replies.="<div id='response_top'>Re: ".$thread_title."&nbsp; &nbsp; &bull; &nbsp; &nbsp; ".$reply_date_time ." <a href='profile.php?username=".$reply_author."'>".$reply_author."</a> said:</div>
				<div id='response_bottom'>".$reply_post_body."</div>";
				
			}
		}else{
			$replies = "There are no replies yet.";
		}
		
	
	
	?>
	<h1 id="topic_title"><?PHP echo $thread_title; ?></h1>
	<div id="author_div">Topic started by: <a href='profile.php?username=<?PHP echo $post_author; ?>'><?PHP echo $post_author; ?></a> &nbsp; &nbsp;Created on: <?PHP echo $date_time; ?> &nbsp; &nbsp;Posted in <a href="section.php?id=<?PHP echo $section_id; ?>"><?PHP echo $section_title; ?></a> <span style="float:right;">Status: <?PHP echo $status; ?></span>
	<hr/>
	</div>
	
	<div id="post_div"><?PHP echo $post_body; ?>
	<hr/>
	</div>
	<div id="replies"><?PHP echo $replies; ?></div>
	<br>
	<br>
	<?PHP
		if($post_author == $username && $status == 'Open'){
	?>
		<a href="close_thread.php?id=<?PHP echo $post_id; ?>" style="float:right;">Close this thread?</a>
	<?PHP
		}
	?>
	<br>
	<br>
	<?PHP
		if($status == "Open"){
	?>
			<link rel="stylesheet" type="text/css" href="trix/trix.css">
			<script type="text/javascript" src="trix/trix.js"></script>
			<form action="includes/postHandler.php" method="post" name="reply">
					
				<!--<textarea name="post_body" placeholder="Reply..." rows="7" cols="40" ></textarea><br><br>-->
				<input id="x" name="post_body" type="hidden" name="content">
				<trix-editor input="x"></trix-editor><a href="https://github.com/basecamp/trix" style="float:right; font-size:8pt" target="_blank">Powered by Trix</a>
				<input type="submit" name="reply" value="Reply to Post" />
				
				<input type="hidden" name="orig_topic_id" value="<?PHP echo $thread_id; ?>" />
				<input type="hidden" name="section_id" value="<?PHP echo $section_id; ?>" />
				<input type="hidden" name="post_title" value="<?PHP echo $thread_title; ?>" />
				<input type="hidden" name="section_title" value="<?PHP echo $section_title; ?>" />
				<input type="hidden" name="post_type" value="b" /><!-- a for new, b for reply -->
				

			</form>
	
	<?PHP
		}
}else{
		echo "Please <a href='#' class='login-button'>Login</a> to view this page.";
	}
include_once("includes/bottom.php");
?>