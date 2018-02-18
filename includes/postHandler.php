<?PHP
ini_set('display_errors', '1');
session_start();
include_once("dbConn.php");
include_once("accountFunctions.php");
if(isset($_POST['postType'])){$postType = $_POST['postType'];}
if(isset($_POST['postTitle'])){$postTitle = $_POST['postTitle'];}
if(isset($_POST['postBody'])){$postBody = $_POST['postBody'];}
if(isset($_POST['sectionId'])){$sectionId = $_POST['sectionId'];}
if(isset($_POST['sectionTitle'])){$sectionTitle = $_POST['sectionTitle'];}
if(isset($_POST['description'])){$description = $_POST['description'];}
if(isset($_POST['ordered'])){$ordered = $_POST['ordered'];}
$postAuthor = $_SESSION['username'];
$userId = $_SESSION['id'];
echo $postAuthor ." ".$postTitle ." ".$postBody ." ".$sectionId ." ".$sectionTitle ." ".$userId;
	if(isset($_SESSION['username'])){
		if($postType == 'a'){//handle new post
			if(isset($postAuthor) && isset($postTitle) && isset($postBody) && isset($sectionId) && isset($sectionTitle) && isset($userId)){
				$sql = "INSERT INTO forum_posts (post_author,post_author_id,date_time,type,section_title,section_id,thread_title,post_body) VALUES ('$postAuthor','$userId',now(),'a','$sectionTitle','$sectionId','$postTitle','$postBody')";
				
				if($result=$connection->query($sql)){
					$sqlId = $connection->insert_id;
					header("Location: ../viewThread.php?id=".$sqlId);
				}else{
					echo "Something has gone seriously wrong, please tell the Admin this(or try again):" . $sql . "<br>" . $connection->error;
				}
			}else{
				echo "Missing important info";
			}
		}
		
		if($postType == 'b'){ //handle replies
		
			$origTopicId=$_POST['orig_topic_id'];
		
			if(isset($postAuthor) && isset($postTitle) && isset($postBody) && isset($sectionId) && isset($sectionTitle) && isset($userId) && isset($origTopicId)){
				$sql = "INSERT INTO forum_posts (post_author,post_author_id,orig_topic_id,date_time,type,section_title,section_id,thread_title,post_body) VALUES ('$postAuthor','$userId','$origTopicId',now(),'b','$sectionTitle','$sectionId','$postTitle','$postBody')";
				
				if($result=$connection->query($sql)){
					//$sql_id = $connection->insert_id;
					header("Location: ../viewThread.php?id=".$origTopicId);
				}else{
					Echo "Something has gone seriously wrong, please tell the Admin this(or try again):" . $sql . "<br>" . $connection->error;
				}
			}else{
				echo "Missing important info";
			}
		}
		
		if($postType == 'c'){ //handle new sections
		
			if(isset($sectionTitle) && isset($description) && isset($ordered)){
				$sql = "INSERT INTO forum_sections VALUES (NULL,'".$sectionTitle."','".$description."','".$ordered."')";
				
				if($result=$connection->query($sql)){
					header("Location: ../forumSections.php");
				}else{
					Echo "Something has gone seriously wrong, please tell the Admin this(or try again):" . $sql . "<br>" . $connection->error;
				}
			}else{
				echo "Missing important info";
			}
		}
	}else{
		echo "You are not logged in, screw off.";
	}
?>