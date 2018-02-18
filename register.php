
<script>
	$(document).ready(function() {
		$('form.reg').on('submit', function(event) {
			event.preventDefault();
			fName=$("#fName").val();
			lName=$("#lName").val();
			email=$("#regEmail").val();
			username=$("#regUsername").val();
			pass1=$("#pass1").val();
			pass2=$("#pass2").val();
			birthday=$("#birthday").val();
			mcUsername=$("#mcUsername").val();
			authQ=$("#authQ").val();
			authA=$("#authA").val();
			
			errors = false;
			
			if(fName == '' || /^[a-zA-Z]+$/.test(fName) == false){
				$("#error.fName").show();
				errors = true;
				console.log("Bad chars in First Name");
			}
			if(lName == '' || /^[a-zA-Z]+$/.test(lName) == false){
				$("#error.lName").show();
				errors = true;
				console.log("Bad chars in Last Name");
			}
			if(email == ''){
				$("#error.email").show();
				errors = true;
				console.log("Bad chars in email");
			}
			if(username == '' || /^[a-zA-Z0-9\!\-\_\?]+$/.test(username) == false){
				$("#error.regUsername").show();
				errors = true;
				console.log("Bad chars in username");
			}
			if($("#regUsername").hasClass("fail") == true){
				$("#error.fName").show();
				errors = true;
				console.log("Username already taken.");
			}
			if(pass1 == '' || /^[a-zA-Z0-9\%\$\#\@\!\-\_\?]+$/.test(pass1) == false){
				$("#error.pass1").show();
				errors = true;
				console.log("Bad chars in pass1");
			}
			if(pass2 == '' || /^[a-zA-Z0-9\%\$\#\@\!\-\_\?]+$/.test(pass2) == false){
				$("#error.pass2").show();
				errors = true;
				console.log("Bad chars in pass2");
			}
			if(pass1 != pass2){
				$("#error.notSame").show();
				errors = true;
				console.log("Passwords do not match");
			}
			if(birthday == ''){
				$("#error.birthday").show();
				errors = true;
				console.log("Bad chars in birthday");
			}
			if(mcUsername == '' || /^[a-zA-Z0-9\%\$\#\@\!\-\_\?]+$/.test(mcUsername) == false){
				$("#error.mcUsername").show();
				errors = true;
				console.log("Bad chars in mcUsername");
			}
			if(authQ == ''){
				errors = true;
				console.log("Bad chars in AuthQ");
			}
			if(authA == ''  || /^[a-zA-Z0-9\%\$\#\@\!\-\_\?]+$/.test(authA) == false){
				$("#error.authA").show();
				errors = true;
				console.log("Bad chars in AuthA");
			}
			console.log("Errors status: "+errors);
			
			if(errors == false){
				console.log("Posting data..");
				
				console.log($("#fName").val()+" "+$("#lName").val()+" "+$("#regEmail").val()+" "+$("#regUsername").val()+" "+$("#pass1").val()+" "+$("#pass2").val()+" "+$("#birthday").val()+" "+$("#mcUsername").val()+" "+$("#authQ").val()+" "+$("#authA").val());
				
				jQuery.ajax({
					url: "includes/reg.php",
					data: {
						fName:$("#fName").val(),
						lName:$("#lName").val(),
						email:$("#regEmail").val(),
						username:$("#regUsername").val(),
						pass1:$("#pass1").val(),
						pass2:$("#pass2").val(),
						birthday:$("#birthday").val(),
						mcUsername:$("#mcUsername").val(),
						authQ:$("#authQ").val(),
						authA:$("#authA").val(),
						register:true
					},
					type: "POST",
					success:function(data){
						//console.log(data);
						if(data=="success"){
							console.log(data);
							
							//redirect after we are done testing
							//window.location = "https://beta.dlcincluded.com/status.php?msg=register";
							//for live site:
							//window.location = "https://dlcincluded.com/status.php?msg=register";
						}else{
							console.log(data);
						}
					},
					error:function (){}
				});
			}
		});
	});
	
	function clearError(id){
		$(id).next().hide();
	}

</script>
<style>
form.reg {
	position: relative;
	left: 50%;
	-webkit-transform: translateX(-50%);
	transform: translateX(-50%);
	width:400;
}
#error{
	position: absolute;
    margin-top: 10px;
    background-color: #9D9D9D;
    border: 1px solid #5bc1ff;
    border-radius: 5px 5px;
    padding: 10px 10px;
    z-index: 100;
    line-height: initial;
	color:black;
}

/*#error {
	top:40px;
	position: relative;
	background: #ffffff;
	border: 1px solid #719ECE;
	width: 200px;
	height: 200px;
	border-radius: 3px;
}*/
#error:after, 
#error:before { /*Actually adds the triangle*/
	bottom: 100%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

#error:after { /*Fills in the triangle*/
	border-color: rgba(255, 255, 255, 0);
	border-bottom-color: #9D9D9D;
	border-width: 19px;
	left: 20%;
	margin-left: -19px;
	
}

#error:before { /* Adds the border to the triangle */
	border-color: rgba(113, 158, 206, 0);
	border-bottom-color: #719ECE;
	border-width: 20px;
	left: 20%;
	margin-left: -20px;
	
}

.errorRight {
	right:0;
}
	
</style>



<form method="POST" action="" id="registerForm" class="reg">
	<input type="text" name="fName" id="fName" placeholder="First Name" onKeyUp="clearError(this)" required/> <div class="fName" id="error" style="display:none">Only A-Z allowed first</div>
	<input type="text" name="lName" id="lName" placeholder="Last Name" onKeyUp="clearError(this)" required/><div class="lName errorRight" id="error" style="display:none">Only A-Z allowed last</div><br>
	<input type="text" name="email" id="regEmail" placeholder="Email" onKeyUp="clearError(this)" required/><div class="email" id="error" style="display:none">Not a Valid Email</div>
	<input type="text" name="username" id="regUsername" placeholder="Username" onKeyUp="clearError(this)" required onKeyUp="checkAvailability()"><div class="regUsername  errorRight" id="error" style="display:none">Only A-Z,0-9 allowed</div> <br>
	<input type="password" name="pass1" id="pass1" placeholder="Password" onKeyUp="clearError(this)" required/><div class="pass1" id="error" style="display:none">Only A-Z,0-9, and !,_,+,$ allowed</div>
	<input type="password" name="pass2" id="pass2" placeholder="Repeat Password" onKeyUp="clearError(this)" required/><div class="pass2  errorRight" id="error" style="display:none">Only A-Z,0-9, and !,_,+,$ allowed</div><br>
	<input type="date" name="birthday" id="birthday" placeholder="birthday mm/dd/yyyy" style="width:190px;" onKeyUp="clearError()" required/><div class="birthday" id="error" style="display:none">Only 0-9 allowed</div>
	<input type="text" name="mcUsername" id="mcUsername" placeholder="MC Username" onKeyUp="clearError(this)" required/><div class="mcUsername  errorRight" id="error" style="display:none">Only A-Z,0-9 allowed</div><br>
	<select name="authQ" id="authQ">
		<option value="q1">What is your favorite Minecraft mob?</option>
		<option value="q2">Who was your childhood hero?</option>
		<option value="q3">What is your oldest cousins first and last name?</option>
		<option value="q4">Where did your mother and father meet?</option>
		<option value="q5">What is a skill you have that not many others have?</option>
	</select><br>
	
	<input type="text" name="authA" id="authA" placeholder="Question Answer" onKeyUp="clearError(this)" required /><div class="authA" id="error" style="display:none">Only A-Z,0-9 allowed</div>
	<input type="hidden" name="register" value="register" />
	<button type="submit" id="registerSubmit">Submit</button><br>
	<a class="registerFormButton">Cancel/Close</a>
</form>

