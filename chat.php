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


	if(isset($_POST['chat']) && $_POST['chat'] != ''){
		if($api->sendConsoleCommand(1, "say <".$_POST['mcUsername']."> ".$_POST['chat'])){
			echo "success";
		}else{
			echo "failed";
		}
	}
	
?>
