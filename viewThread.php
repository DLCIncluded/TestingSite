<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

	if(isset($username)){
		$threadId=$_GET['id'];
		$sql="SELECT * FROM forum_posts WHERE id='$threadId' AND type='a'";//pull just the original post
		if($result=$connection->query($sql)){
			
			if($result->num_rows == 1){
				
				while($row=$result->fetch_assoc()){
					$postAuthor = $row['post_author'];
					$postAuthor_id = $row['post_author_id'];
					$postId = $row['id'];
					$dateTime = $row['date_time'];
					$dateTime = strftime("%b %d %Y",strtotime($dateTime));//convert to Month ##, YYYY
					$sectionTitle = $row['section_title'];
					$sectionId = $row['section_id'];
					$threadTitle = $row['thread_title'];
					$postBody = $row['post_body'];
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
		$sql="SELECT * FROM forum_posts WHERE orig_topic_id='$threadId' AND type='b'";
		$result=$connection->query($sql);
		$replies="";
		if($result->num_rows > 0){
			while($row=$result->fetch_assoc()){
				
				$replyAuthor = $row['post_author'];
				$replyAuthorId = $row['post_author_id'];
				$replyDateTime = $row['date_time'];
				$replyDateTime = convertTime($row['date_time']);
				
				$replyPostBody = $row['post_body'];
				
				$replies.="<div id='responseTop'>Re: ".$threadTitle."&nbsp; &nbsp; &bull; &nbsp; &nbsp; ".$replyDateTime ." <a href='profile.php?username=".$replyAuthor."'>".$replyAuthor."</a> said:</div>
				<div id='responseBottom'>".$replyPostBody."</div>";
				
			}
		}else{
			$replies = "There are no replies yet.";
		}
		
	
	
	?>
	<h1 id="topicTitle"><?PHP echo $threadTitle; ?></h1>
	<div id="authorDiv">Topic started by: <a href='profile.php?username=<?PHP echo $postAuthor; ?>'><?PHP echo $postAuthor; ?></a> &nbsp; &nbsp;Created on: <?PHP echo $dateTime; ?> &nbsp; &nbsp;Posted in <a href="section.php?id=<?PHP echo $sectionId; ?>"><?PHP echo $sectionTitle; ?></a> <span style="float:right;">Status: <?PHP echo $status; ?></span>
	<hr/>
	</div>
	
	<div id="postDiv"><?PHP echo $postBody; ?>
	<hr/>
	</div>
	<div id="replies"><?PHP echo $replies; ?></div>
	<br>
	<br>
	<?PHP
		if(($postAuthor == $username || $siteLevel >= 5 ) && $status == 'Open'){
	?>
		<a href="closeThread.php?id=<?PHP echo $postId; ?>" style="float:right;">Close this thread?</a>
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
				<input id="x" name="postBody" type="hidden" name="content">
				<trix-editor input="x"></trix-editor><a href="https://github.com/basecamp/trix" style="float:right; font-size:8pt" target="_blank">Powered by Trix</a>
				<input type="submit" name="reply" value="Reply to Post" />
				
				<input type="hidden" name="origTopicId" value="<?PHP echo $threadId; ?>" />
				<input type="hidden" name="sectionId" value="<?PHP echo $sectionId; ?>" />
				<input type="hidden" name="postTitle" value="<?PHP echo $threadTitle; ?>" />
				<input type="hidden" name="sectionTitle" value="<?PHP echo $sectionTitle; ?>" />
				<input type="hidden" name="postType" value="b" /><!-- a for new, b for reply -->
				

			</form>
	
	<?PHP
		}
}else{
		echo "Please <a href='#' class='loginButton'>Login</a> to view this page.";
	}
include_once("includes/bottom.php");
?>