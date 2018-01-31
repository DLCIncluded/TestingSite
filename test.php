

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function checkAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "check_availability.php",
	data:'username='+$("#username").val(),
	type: "POST",
	success:function(data){
		$("#user-availability-status").html(data);
		$("#loaderIcon").hide();
	},
	error:function (){}
	});
}
</script>

<div id="frmCheckUsername">
  <label>Check Username:</label>
  <input name="username" type="text" id="username" class="demoInputBox" onkeyup="checkAvailability()"><img src="LoaderIcon.gif" id="loaderIcon" style="display:none;height:20px" /><span id="user-availability-status"></span>    
</div>
