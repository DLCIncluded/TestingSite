<?PHP
ini_set('display_errors', '1');
//Written by Glavić on stack overflow
//https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
//Can accept any time format EX:
//echo time_elapsed_string('2013-05-01 00:22:35');
//echo time_elapsed_string('@1367367755'); # timestamp input
//echo time_elapsed_string('2013-05-01 00:22:35', true);

function time_elapsed_string($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
	
    foreach ($string as $key => &$value) {
        if ($diff->$key) {
            $value = $diff->$key . ' ' . $value . ($diff->$key > 1 ? 's' : '');
        } else {
            unset($string[$key]);
        }
    }
	
	if($diff->d >= 1){
		$string = array_slice($string, 0, 1);
	} else {
		$string = array_slice($string, 0, 2);
	}

    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$timestamp = "2018-02-10 15:52:13";
echo time_elapsed_string($timestamp);
?>