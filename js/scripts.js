	$(document).ready(function() { //if register form is out, toggle it in and toggle out the login form, if not just toggle the login form
		$('.loginButton').click(function() {
			if($(".registerFormWrap").is(':visible')){
				$('.registerFormWrap').slideToggle(400);
				$('.loginFormWrap').delay(400).slideToggle(400);
			}else{
				$('.loginFormWrap').slideToggle(400);
			}
		console.log("Done")
		});
	});
	
	$(document).ready(function() { //if the login form is out, toggle it in and toggle out the register form, or toggle closed the register form
		$('.registerFormButton').click(function() {
			if($(".loginFormWrap").is(':visible')){
				$('.loginFormWrap').slideToggle(400);
				$('.registerFormWrap').delay(400).slideToggle(400);
			}else{
				$('.registerFormWrap').slideToggle(400);
			}
		console.log("Done")
	  });
	});
	
	$(document).ready(function() { //should be fine to keep it this simple, when youre logged in, it is the only drop down... 
	  $('.profileButton').click(function() {
		$('.profileFormWrap').slideToggle(400);
		console.log("Done")
	  });
	});
	
	
	function checkAvailability() {
		jQuery.ajax({
		url: "includes/check_availability.php",
		data:'username='+$("#regUsername").val(),
		type: "POST",
		success:function(data){
			if(data=="success"){
				$("#regUsername").addClass("success");
				$("#regUsername").removeClass("fail");
			}else{
				$("#regUsername").removeClass("success");
				$("#regUsername").addClass("fail");
			}
		},
		error:function (){}
		});
	}
	
	$(document).ready(function() {
		$('form.ajax').on('submit', function() {
			var chat = 
			jQuery.ajax({
			url: "includes/sendChat.php",
			data: {
				chat:$("#chat").val(),
				mcUsername:$("#mcUsername").val()
			},
			type: "POST",
			success:function(data){
				//console.log(data);
				if(data=="success"){
					$(".simplebar-content").delay(500).load('chat.php');
					$('.simplebar-scroll-content').delay(510).animate({ scrollTop: 10000 }, 2000);
					$('#chat').val('');
				}else{
					$(".simplebar-content").delay(500).load('chat.php');
					$('.simplebar-scroll-content').delay(510).animate({ scrollTop: 10000 }, 2000);
					$('#chat').val('');
				}
			},
			error:function (){}
			});
			return false;
		});
		$("#chatBtn").click(function(){
    			$(".chatWrap").toggle( "slide" );
    			$(".simplebar-content").load('chat.php');
    			$('.simplebar-scroll-content').animate({ scrollTop: 10000 }, 2000);
  		});
		
		setInterval(function(){
    		$(".simplebar-content").load('chat.php'); 
     	},10000);
	});

	

	