<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

	if(isset($username) && $username!=''){
		if(isset($_POST['sid']) && isset($_POST['section_title'])){
			$sid = $_POST['sid'];
			$section_title = $_POST['section_title'];
			?>
			
			<form action="includes/postHandler.php" method="post" name="newPost">
			
				<input type="text" name="topic_author" value="<?PHP echo $username; ?>" disabled="disabled" maxlength="64" /><br>
				<input type="text" name="post_title" placeholder="Topic for post" /><br>
				<textarea name="post_body" placeholder=""></textarea><br><br>
				<input type="submit" value="Create Topic!" name="submitBtn"/>
				
				<input type="hidden" name="section_id" value="<?PHP echo $sid; ?>" />
				<input type="hidden" name="section_title" value="<?PHP echo $section_title; ?>" />
				<input type="hidden" name="post_type" value="a" /><!-- a for new, b for reply -->
				
			
			</form>
			
			<?PHP
			
		}else{
			echo "Please Go back and try again, something broke.";
		}
	}else{
		echo "Please <a href='#' class='login-button'>Login</a> to view this page.";
	}

include_once("includes/bottom.php");
?>