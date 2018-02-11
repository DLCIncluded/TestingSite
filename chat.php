<?PHP
ini_set('display_errors', '1');
require("includes/MulticraftAPI.php");
$api = new MulticraftAPI('https://dlcincluded.com/multicraft/api.php', 'DLCIncluded', '+n2DLp2z*mZoBz');

$response = $api->getServerChat(1);

if ($response['success']) {
	$users = $response["data"];
	foreach ($users as $key => $value) {
		if (strpos($value["text"], 'disconnected (') !== false) {
			//echo "bad message<br>"; //strip out anything that has 'disconnected (' and replace with bad message, eventually DELETE THIS LINE BEFORE GOING LIVE
		}else{
			
			echo "<div id='message'>".$value["name"]." ".$value["text"]."</div>";
			//echo $value["name"];
			//echo " ";
			//echo $value["text"];
			//echo "<br>";
		}
	}
	//echo '<pre>'; var_dump($response);
}
if(isset($_POST['message'])){
	if($api->sendConsoleCommand(1, "say ".$_POST['message'])){
		echo "message sent";
	}else{
		echo "<br>Failed to send message";
	}
}


?>
<!--
<form action="chat.php" method="POST">
	<input type="text" name="message" placeholder="type your message"/>
	<input type="submit" name="msgBtn" value="Send Message" />
</form>
-->

<form action="../multicraft/index.php?r=server/chat&amp;id=1" method="post">
	<input type="hidden" value="ac4706609c03b0bf65416bb8f0fc5f930e15329b" name="YII_CSRF_TOKEN" />
	<div class="input-group">
		<input type="text" id="message" name="message" value="" class="form-control" data-focus>
		<span class="input-group-btn">
			<input class="btn btn-primary" type="submit" name="yt0" value="Send" id="yt0" />            </span>
	</div>
	<div class="flash-error" id="chat-error" style="display: none"></div>
</form>