<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
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
session_start();

if(isset($_SESSION['username'])){
	echo "You are already logged in, you cannot register again. Not ".$_SESSION['username']."? <a href='logout.php'>Logout</a>";
} else {
echo '<form method="POST" action="regScript.php">
	First Name: <input type="text" name="fName" id="fName" placeholder="First Name" required/> <br/>
	Last Name: <input type="text" name="lName" id="lName" placeholder="Last Name" required/><br/>
	Email: <input type="text" name="email" id="email" placeholder="Email" required/><br/>
	Username: <input type="text" name="username" id="username" placeholder="Username" required onkeyup="checkAvailability()"><img src="LoaderIcon.gif" id="loaderIcon" style="display:none;height:20px" /><span id="user-availability-status"></span>    <br/>
	Password: <input type="password" name="pass1" id="pass1" placeholder="Password" required/><br/>
	Repeat Password: <input type="password" name="pass2" id="pass2" placeholder="Repeat Password" required/><br/>
	Birthday: <input type="date" name="birthday" id="birthday" placeholder="mm/dd/yyyy" required/><br/>
	MC Username: <input type="text" name="mcUsername" id="mcUsername" placeholder="MC Username" required/><br/>
	
	Authentication Question:
	<select name="authQ" id="authQ">
		<option value="q1">What is your favorite Minecraft mob?</option>
		<option value="q2">Who was your childhood hero?</option>
		<option value="q3">What is your oldest cousins first and last name?</option>
		<option value="q4">Where did your mother and father meet?</option>
		<option value="q5">What is a skill you have that not many others have?</option>
	</select><br/>
	
	Answer: <input type="text" name="authA" id="authA" placeholder="Question Answer" required />
	<input type="submit" name="submitbtn" id="submitbtn">
</form>';
}
?>

