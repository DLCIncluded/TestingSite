	$(document).ready(function() { //if register form is out, toggle it in and toggle out the login form, if not just toggle the login form
		$('.login-button').click(function() {
			if($(".register-form-wrap").is(':visible')){
				$('.register-form-wrap').slideToggle(400);
				$('.login-form-wrap').delay(400).slideToggle(400);
			}else{
				$('.login-form-wrap').slideToggle(400);
			}
		console.log("Done")
		});
	});
	
	$(document).ready(function() { //if the login form is out, toggle it in and toggle out the register form, or toggle closed the register form
		$('.register-form-button').click(function() {
			if($(".login-form-wrap").is(':visible')){
				$('.login-form-wrap').slideToggle(400);
				$('.register-form-wrap').delay(400).slideToggle(400);
			}else{
				$('.register-form-wrap').slideToggle(400);
			}
		console.log("Done")
	  });
	});
	
	$(document).ready(function() { //should be fine to keep it this simple, when youre logged in, it is the only drop down... 
	  $('.profile-button').click(function() {
		$('.profile-form-wrap').slideToggle(400);
		console.log("Done")
	  });
	});
	
	function login(){
		var username=$('#username').val();
		var pass=$('#pass').val();
			if(username!="" && pass!=""){
				$.ajax({
					type:'post',
					url:'accountManager.php',
					data:{
						login:'login',
						username:username,
						pass:pass
					},
					success:function(response){
						if(response=='success'){
							window.location.href='TEMPLATE.php';
						}else{
							alert("Invalid Username or Password");
						}
					}
				});
			} else {
				alert("Please fill out username & password");
			}
		return false;
	}
	
	function checkAvailability() {
		jQuery.ajax({
		url: "includes/check_availability.php",
		data:'username='+$("#reg-username").val(),
		type: "POST",
		success:function(data){
			if(data=="success"){
				$("#reg-username").addClass("success");
				$("#reg-username").removeClass("fail");
			}else{
				$("#reg-username").removeClass("success");
				$("#reg-username").addClass("fail");
			}
		},
		error:function (){}
		});
	}
	
	function sendMessage() {
		var formData = {
            'chat'              : $('input[name=chat]').val(),
            'mcUsername'        : $('input[name=mcUsername]').val()
        };
		jQuery.ajax({
		url: "chat.php",
		data: formData,
		type: "POST",
		success:function(data){
			if(data=="success"){
				$("#chat").addClass("success");
				$("#chat").removeClass("fail");
			}else{
				$("#chat").removeClass("success");
				$("#chat").addClass("fail");
			}
		},
		error:function (){}
		});
	}
	