<?PHP
ini_set('display_errors', '1');
include_once("includes/top.php");

	if(isset($username) && $username!='' && $_SESSION['siteLevel'] >= 5){
		?>
		
		<h1>Create a Post</h1>
		<link rel="stylesheet" type="text/css" href="trix/trix.css">
		<script type="text/javascript" src="trix/trix.js"></script>
		<form action="includes/postHandler.php" method="post" name="newSection">
			
			<input type="text" name="sectionTitle" size="20" placeholder="Title for section" /><br>
			<input type="text" name="description" size="20" placeholder="Short description" /><br>
			<input type="text" name="ordered" size="20" placeholder="Order on list(ex 1,2,3...)" /><br>
			<input type="submit" value="Create Topic!" name="submitBtn"/>
			
			<input type="hidden" name="postType" value="c" /><!-- a for new, b for reply -->
		</form>
		
		<?PHP
		}else{
		echo "Either you do not have access to this page, or you need to <a href='#' class='loginButton'>Login</a>, only site admins can see this page. ";
	}

include_once("includes/bottom.php");
?>