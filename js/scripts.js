	$(document).ready(function(){
		$('.login-button').click(function(){
    		$('.login-form-wrap').slideToggle('fast', function(){
        		if($(this).is(':visible')){
            		$(this).css('display:none');
        		}else{
            		$(this).css('display:block');
        		}
    		});
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
	