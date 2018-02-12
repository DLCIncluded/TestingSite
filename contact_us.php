<?php 
include('includes/top.php'); 

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['message'])){
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$user = $_POST['username'];
	$msg = $_POST['message'];
	
	$to = "admin@dlcincluded.com, chj1axr0@dlcincluded.com, myaskill@dlcincluded.com, h2owiz1@dlcincluded.com";
	$subject = $user." Has used the contact form.";
			
	$message = "
	$user has used the contact us form on the site and left the following information:<br><br>
	Name: $name <br>
	Email: $email  <br>
	$msg
	";
	
	$headers = "From: admin@dlcincluded.com\r\n";
	$headers .= "Reply-To: admin@dlcincluded.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	if(mail($to, $subject, $message, $headers)){
		echo "Your message has been sent, we will contact you soon.";
	}else{
		echo "failed to send";
	}
}else{

?>
	<link rel="stylesheet" type="text/css" href="trix/trix.css">
	<script type="text/javascript" src="trix/trix.js"></script>
	
	<h1>Contact Us</h1>
	<div>
		<form action="contact_us.php" method="POST">
			<input type="text" name="name" placeholder="Your name" required /><br>
			<input type="text" name="username" placeholder="Site Username" required /><br>
			<input type="text" name="email" placeholder="Your email address" required /><br><br>
			<input id="message" name="message" type="hidden" />
			<trix-editor input="message"></trix-editor><a href="https://github.com/basecamp/trix" style="float:right; font-size:8pt" target="_blank">Powered by Trix</a><br>
			<input type="submit" name="submit" value="Send Message" />
		</form>
	</div>
<?PHP
}	
include_once('includes/bottom.php'); 
?>


