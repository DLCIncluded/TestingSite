<?PHP
if(isset($_SESSION['username'])){
	echo "You are already logged in, you cannot register again. Not ".$_SESSION['username']."? <a href='logout.php'>Logout</a>";
} else {
?><form method="POST" action="includes/accountHandler.php" id="register-form">
	<input type="text" name="fName" id="fName" placeholder="First Name" required/> 
	<input type="text" name="lName" id="lName" placeholder="Last Name" required/><br>
	<input type="text" name="email" id="reg-email" placeholder="Email" required/>
	<input type="text" name="username" id="reg-username" placeholder="Username" required onKeyUp="checkAvailability()"> <br>
	<input type="password" name="pass1" id="pass1" placeholder="Password" required/>
	<input type="password" name="pass2" id="pass2" placeholder="Repeat Password" required/><br>
	<input type="date" name="birthday" id="birthday" placeholder="birthday mm/dd/yyyy" style="width:190px;" required/>
	<input type="text" name="mcUsername" id="mcUsername" placeholder="MC Username" required/><br>
	<select name="authQ" id="authQ">
		<option value="q1">What is your favorite Minecraft mob?</option>
		<option value="q2">Who was your childhood hero?</option>
		<option value="q3">What is your oldest cousins first and last name?</option>
		<option value="q4">Where did your mother and father meet?</option>
		<option value="q5">What is a skill you have that not many others have?</option>
	</select><br>
	
	<input type="text" name="authA" id="authA" placeholder="Question Answer" required />
	<input type="hidden" name="register" value="register" />
	<button type="submit" id="register-submit">Submit</button><br>
	<a class="register-form-button">Cancel/Close</a>
</form>
<?PHP
}
?>

