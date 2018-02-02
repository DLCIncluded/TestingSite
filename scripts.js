$(document).ready(function() {
	  $('.login-button').click(function() {
		$('.login-form-wrap').slideToggle(400);
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