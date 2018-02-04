<?php 
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;

	// Edit this ->
	define( 'MQ_SERVER_ADDR', '192.99.44.79' );
	define( 'MQ_SERVER_PORT', 25565 );
	define( 'MQ_TIMEOUT', 1 );
	// Edit this <-

	// Display everything in browser, because some people can't look in logs for errors
	Error_Reporting( E_ALL | E_STRICT );
	Ini_Set( 'display_errors', true );
	
	require __DIR__ . '/MinecraftQueryException.php';
	require __DIR__ . '/MinecraftQuery.php';
	
	$Timer = MicroTime( true );
	
	$Query = new MinecraftQuery( );
	
	try {
		$Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
	}
	catch( MinecraftQueryException $e ) {
		$Exception = $e;
	}
	$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>

Connected players:
	<ul>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): 

	$sql = "SELECT * FROM Users WHERE mcUsername='".$Player."'";


	$result = $connection->query($sql); 
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$username=$row['username'];
		}
	?>
	<li><img src="https://crafatar.com/avatars/<?PHP echo getMCPic($username); ?>" height="20px" width="20px"/><a href="profile.php?username=<?PHP echo $username ?>"><?php echo htmlspecialchars( $Player ); ?></a></li>
	<?php
	}else{

?>
	<li><?php echo htmlspecialchars( $Player ); ?></li>
<?php 
	}
endforeach; ?>
</ul>
<?php else: ?>
						<div class="no-players">
							<p>No players online</p>
						</div>
<?php endif; ?>	