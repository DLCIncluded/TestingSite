<?PHP
ini_set('display_errors', '1');
require("MulticraftAPI.php");
$api = new MulticraftAPI('https://dlcincluded.com/multicraft/api.php', 'DLCIncluded', '+n2DLp2z*mZoBz');

	if(isset($_POST['chat']) && $_POST['chat'] != ''){
		if($api->sendConsoleCommand(1, "say <".$_POST['mcUsername']."> ".$_POST['chat'])){
			echo "success";
		}else{
			echo "failed";
		}
	}

?>