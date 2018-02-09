<?PHP
ini_set('display_errors', '1');
session_start();
include_once("dbConn.php");
include_once("accountFunctions.php");

$post_type = $_POST['post_type'];
$post_author = $_SESSION['username'];
$user_id = $_SESSION['id'];
$post_title = $_POST['post_title'];
$post_body = $_POST['post_body'];			
$section_id = $_POST['section_id'];
$section_title = $_POST['section_title'];
//echo "author: ".$post_author,"<br>";
//echo "user_id: ".$user_id,"<br>";
//echo "post_title: ".$post_title,"<br>";
//echo "post_body: ".$post_body,"<br>";
//echo "section_id: ".$section_id,"<br>";
//echo "section_title: ".$section_title,"<br>";

	if(isset($_SESSION['username'])){
		if($post_type == 'a'){//handle new post
			if(isset($post_author) && isset($post_title) && isset($post_body) && isset($section_id) && isset($section_title) && isset($user_id)){
				$sql = "INSERT INTO forum_posts (post_author,post_author_id,date_time,type,section_title,section_id,thread_title,post_body) VALUES ('$post_author','$user_id',now(),'a','$section_title','$section_id','$post_title','$post_body')";
				
				if($result=$connection->query($sql)){
					$sql_id = $connection->insert_id;
					header("Location: ../view_thread.php?id=".$sql_id);
				}else{
					echo "Something has gone seriously wrong, please tell the Admin this(or try again):" . $sql . "<br>" . $connection->error;
				}
			}else{
				echo "Missing important info";
			}
		}
		
		if($post_type == 'b'){ //handle replies
		
			$orig_topic_id=$_POST['orig_topic_id'];
		
			if(isset($post_author) && isset($post_title) && isset($post_body) && isset($section_id) && isset($section_title) && isset($user_id) && isset($orig_topic_id)){
				$sql = "INSERT INTO forum_posts (post_author,post_author_id,orig_topic_id,date_time,type,section_title,section_id,thread_title,post_body) VALUES ('$post_author','$user_id','$orig_topic_id',now(),'b','$section_title','$section_id','$post_title','$post_body')";
				
				if($result=$connection->query($sql)){
					//$sql_id = $connection->insert_id;
					header("Location: ../view_thread.php?id=".$orig_topic_id);
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