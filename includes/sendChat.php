<?PHP
ini_set('display_errors', '1');
require("MulticraftAPI.php");
$api = new MulticraftAPI('https://multicraft.dlcincluded.com/api.php', 'DLCIncluded', '4mA4kC8Lnz3KGn');

	if(isset($_POST['chat']) && $_POST['chat'] != ''){
		if($api->sendConsoleCommand(1, "say <".$_POST['mcUsername']."> ".$_POST['chat'])){
			echo "success";
		}else{
			echo "failed";
		}
	}

?>