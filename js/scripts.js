	$(document).ready(function() {
	  $('.login-button').click(function() {
		$('.login-form-wrap').slideToggle(400);
		console.log("Done")
	  });
	});
	
	$(document).ready(function() {
	  $('.profile-button').click(function() {
		$('.profile-form-wrap').slideToggle(400);
		console.log("Done")
	  });
	});
	
	function swap1(){
		$('.login-form-wrap').slideToggle(400);
		$('.register-form-wrap').delay(400).slideToggle(400);
	}
	function swap2(){
		$('.register-form-wrap').slideToggle(400);
	}
	
	
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