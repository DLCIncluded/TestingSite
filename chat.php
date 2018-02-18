<?PHP
ini_set('display_errors', '1');
require("includes/MulticraftAPI.php");
include_once("includes/accountFunctions.php");
$api = new MulticraftAPI('https://multicraft.dlcincluded.com/api.php', 'DLCIncluded', '4mA4kC8Lnz3KGn');

$response = $api->getServerChat(1);
//echo "<pre>".var_dump($response);

if ($response['success']) {
	$users = $response["data"];
	foreach ($users as $key => $value) {
		$time = substr($value["time"], 0, strpos($value["time"], "."));
		if (strpos($value["text"], 'disconnected (') !== false) {
			//strip out anything that has 'disconnected (' and replace with bad message, eventually DELETE THIS LINE BEFORE GOING LIVE
			if (strpos($value["text"], 'disconnected (Server shutting down)') !== false) {
				//echo "<div id='message'>".$value["name"]." - ".$value["text"]."</div>";
				?>
				<div id="message">
					<span id="chatTime"><?PHP echo convertTime("@".$time, true); ?></span><br>
					<span id="chatMsg"><?PHP echo $value["text"]; ?></span>
					
				</div>
				<?PHP
			}elseif (strpos($value["text"], 'disconnected (Timed out)') !== false) {
				//echo "<div id='message'>".$value["name"]." - ".$value["text"]."</div>";
				?>
				<div id="message">
					<span id="chatTime"><?PHP echo convertTime("@".$time, true); ?></span><br>
					<span id="chatMsg"><?PHP echo $value["text"]; ?></span>
					
				</div>
				<?PHP
			}elseif (strpos($value["text"], 'disconnected (Disconnected)') !== false) {
				//echo "<div id='message'>".$value["name"]." - ".$value["text"]."</div>";
				?>
				<div id="message">
					<span id="chatTime"><?PHP echo convertTime("@".$time, true); ?></span><br>
					<span id="chatMsg"><?PHP echo $value["text"]; ?></span>
					
				</div>
				<?PHP
			}else{
				//echo "bad message";
			}
		}elseif (strpos($value["text"], 'connected') !== false) {
			?>
				<div id="message">
					<span id="chatTime"><?PHP echo convertTime("@".$time, true); ?></span><br>
					<span id="chatMsg"><?PHP echo $value["text"]; ?></span>
					
				</div>
				<?PHP
		}else{
			
			?>
			<div id="message">
				<span id="chatName"><?PHP echo $value["name"]; ?></span> - <span id="chatTime"><?PHP echo convertTime("@".$time, true); ?></span><br>
				<span id="chatMsg"><?PHP echo $value["text"]; ?></span>
				
			</div>
			<?PHP
			
			//echo "<div id='message'>".$value["name"]." - ".$value["text"]." - ".convertTime("@".$time)."</div>";
			//echo $value["name"];
			//echo " ";
			//echo $value["text"];
			//echo "<br>";
		}
	}
	?>
	<?PHP
	//echo '<pre>'; var_dump($response);
} else { echo "failed"; }
	
?>
