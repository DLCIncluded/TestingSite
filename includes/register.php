
<script type="text/javascript">
function checkAvailability() {
	//$("#loaderIcon").show();
	jQuery.ajax({
	url: "check_availability.php",
	data:'username='+$("#username").val(),
	type: "POST",
	success:function(data){
		$("#user-availability-status").html(data);
		//$("#loaderIcon").hide();
	},
	error:function (){}
	});
}
</script>

<?PHP
//ini_set('display_errors', '1');


if(isset($_SESSION['username'])){
	echo "You are already logged in, you cannot register again. Not ".$_SESSION['username']."? <a href='logout.php'>Logout</a>";
} else {
?><form method="POST" action="regScript.php" id="register-form">
	<input type="text" name="fName" id="fName" placeholder="First Name" required/> 
	<input type="text" name="lName" id="lName" placeholder="Last Name" required/><br>
	<input type="text" name="email" id="email" placeholder="Email" required/>
	<input type="text" name="username" id="username" placeholder="Username" required onkeyup="checkAvailability()"><span id="user-availability-status"></span> <br>   
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
	<button type="submit" id="register-submit">Submit</button><br>
	<a onclick="swap2()">Cancel/Close</a>
</form>
<?PHP
}
?>

