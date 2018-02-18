<?PHP
function registerMail($email,$fName,$username,$activeCode){
	//from accountHandler.php
	$subject = "Activate your Account on DLCIncluded's Website";

	$message = "Hello ".$fName.", please click this link (or copy into your address bar) to activate your account: https://dlcincluded.com/activate.php?username=".$username."&code=".$activeCode;

	$headers = "From: admin@dlcincluded.com\r\n";
	$headers .= "Reply-To: admin@dlcincluded.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($email, $subject, $message, $headers);
}

function applyWhiteListMail($mcUser){
	//from applyWhitelist.php
	$to = "admin@dlcincluded.com, chj1axr0@dlcincluded.com, myaskill@dlcincluded.com, h2owiz1@dlcincluded.com";
		
	$subject = $mcUser . " Requested to be Whitelisted";
	
	
	$message = "Please click this link to process this request: http://dlcincluded.com/whitelist.php?username=".$mcUser;
	$headers = "From: admin@dlcincluded.com\r\n";
	$headers .= "Reply-To: admin@dlcincluded.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail($to, $subject, $message, $headers);
}

function contactUsMail($user,$name,$email,$msg){
	//from contact_us.php
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
}

function forgotPassMail($email,$tempPass){
	$subject = "Reset your password on DLCIncluded";

	$message = "Hello ".$username.", Please use this temporary password to login to your account at DLCIncluded: ".$tempPass." If you have any issues, please reply to this email.";
	
	$headers = "From: admin@dlcincluded.com\r\n";
	$headers .= "Reply-To: admin@dlcincluded.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail($email, $subject, $message, $headers);
}

function whitelistMail($email,$mcUser,$username){
	$to = "admin@dlcincluded.com, chj1axr0@dlcincluded.com, myaskill@dlcincluded.com, h2owiz1@dlcincluded.com";
	
	$subject = $mcUser . " has been Whitelisted by ".$username;
	$subject2 = "You have been Whitelisted";
	
	$message = $mcUser." was added to the Whitelist, nothing more is needed from anyone.";
	$message2 = "Hello ".$mcUser.", you have been added to the Whitelist, please see our <a href='http://dlcincluded.com/about.php'>About</a> page for information on the server.";
	
	
	$headers = "From: admin@dlcincluded.com\r\n";
	$headers .= "Reply-To: admin@dlcincluded.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	mail($to, $subject, $message, $headers);
	mail($email, $subject2, $message2, $headers);
}
?>