<form method="POST"  id="login-form" action="includes/accountHandler.php"><!-- action="accountManager.php" -->
	<input type="text" name="username" id="username" placeholder="Username" required/>
	<input type="password" name="pass" id="pass" placeholder="Password" required/>
	<input type="hidden" name="login" value="<?PHP echo basename($_SERVER['PHP_SELF']); ?>"/>
	<button type="submit" id="login-submit">Submit</button> <br>
	<p>Don't Have an Account? <a onClick="swap1()">Register</a></p>
</form>

