<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

	if(isset($username) && $username!=''){
		if(isset($_GET['sid']) && isset($_GET['sectionTitle'])){
			$sid = $_GET['sid'];
			$sectionTitle = $_GET['sectionTitle'];
			?>
			
			<h1>Create a Post</h1>
			<link rel="stylesheet" type="text/css" href="trix/trix.css">
			<script type="text/javascript" src="trix/trix.js"></script>
			<form action="includes/postHandler.php" method="post" name="newPost" class="newPost">
			
				<input type="hidden" name="topicAuthor" value="<?PHP echo $username; ?>" /><br>
				<input type="text" name="postTitle" id="post_title" size="20" placeholder="Title for post" required/><br>
				<input id="x" name="postBody" type="hidden" name="content">
				<trix-editor input="x"></trix-editor><a href="https://github.com/basecamp/trix" style="float:right; font-size:8pt" target="_blank">Powered by Trix</a>
				<!--<textarea name="post_body" placeholder="" rows="7" cols="40" placeholder="Post body..."></textarea><br><br> -->
				<input type="submit" value="Create Topic!" name="submitBtn"/>
				
				<input type="hidden" name="sectionId" value="<?PHP echo $sid; ?>" />
				<input type="hidden" name="sectionTitle" value="<?PHP echo $sectionTitle; ?>" />
				<input type="hidden" name="postType" value="a" /><!-- a for new, b for reply -->
				
			
			</form>
			
			<?PHP
			
		}else{
			echo "Please Go back and try again, something broke.";
		}
	}else{
		echo "Please <a href='#' class='loginButton'>Login</a> to view this page.";
	}

include_once("includes/bottom.php");
?>