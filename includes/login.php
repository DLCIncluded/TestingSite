<form method="POST"  id="loginForm" action="includes/accountHandler.php">
	<input type="text" name="username" id="username" placeholder="Username" required/>
	<input type="password" name="pass" id="pass" placeholder="Password" required/>
	<input type="hidden" name="login" value="<?PHP echo basename($_SERVER['PHP_SELF']); ?>"/>
	<button type="submit" id="loginSubmit">Submit</button> <br>
	<p>Don't Have an Account? <a class="registerFormButton">Register</a></p>
</form>

