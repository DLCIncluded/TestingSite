	</content><!-- main-content -->
	
	<aside id="sidebar-right">
		<?PHP include("playerCheck.php"); ?>
		<div id="chat-box">
			<div data-simplebar id="chat-container">
			<?PHP //include("chat.php"); ?>
			</div>
			<div id="msg-box">
				<?PHP
				if(isset($username)){
				?>
				<form action="sendChat.php" method="POST" class="ajax">
					<input type="hidden" id="mcUsername" name="mcUsername" value="<?PHP echo $mcUsername; ?>" />
					<input type="text" id="chat" name="chat" style="width:95%" placeholder="Message..."/>
					<input type="submit" id="msgBtn" name="msgBtn" value="Send Message" />
				</form>
				<?PHP
				}else{
					echo "<a class='login-button'>Login</a> to send chat messages.";
				}
				?>		
			</div>
		</div>
	</aside><!-- sidebar-right -->

<span id="clear"></span>
</div><!-- / container -->


<footer>
	&copy; Copyright 2018 DLCIncluded 
</footer>
    
<!-- Partical effect  -->
<div class="stars-container">
	<div id="stars"></div>
	<div id="stars2"></div>
	<div id="stars3"></div>
</div>
<!-- / partical effect -->


</body>
</html>