<?php 
include('includes/top.php'); 

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['message'])){
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$user = $_POST['username'];
	$msg = $_POST['message'];
	
	contactUsMail($user,$name,$email,$msg);
	
}else{

?>
	<link rel="stylesheet" type="text/css" href="trix/trix.css">
	<script type="text/javascript" src="trix/trix.js"></script>
	
	<h1>Contact Us</h1>
	<div>
	<p>Please use this form if you are unable to login, if you are able to login, please post in the <a href="forumSections.php">forums</a>.</p>
		<form action="contactUs.php" id="contactUsForm" method="POST">
			<input type="text" name="name" placeholder="Your name" required /><br>
			<input type="text" name="username" placeholder="Site Username" required /><br>
			<input type="text" name="email" placeholder="Your email address" required /><br><br>
			<textarea id="message" name="message" rows="7" cols="24" placeholder="Message..."></textarea><br>
			
			<input type="submit" name="submit" value="Send Message" />
		</form>
	</div>
<?PHP
}	
include_once('includes/bottom.php'); 
?>


