 
<?php
// include __DIR__.'/vendor/autoload.php';

// use Joli\JoliNotif\Notification;
// use Joli\JoliNotif\NotifierFactory;
ini_set('max_execution_time', '0');

$icon = __DIR__ . '/icon.png';
while (true) {

    $notify = false;

    $conf = explode(',', file_get_contents(__DIR__ . '/conf.txt'));
    $limitGB = (float)$conf[0];
    $intervalSEC = $conf[1];

    $data = shell_exec('free -h -t');
    $data = explode("\n", $data);
    $data = explode(" ", $data[3]);
    $tachles = [];

    foreach ($data as $val) {
        if (!empty($val)) {
            $tachles[] = $val;
        }
    }

    if ((float)$tachles[3] < $limitGB || strpos($tachles[3], 'M') > 0) {
        $notify = true;
    }
    var_dump($notify);

    if ($notify === true) {
        shell_exec("/usr/bin/notify-send -i \"$icon\" \"Low memory\" \"Total: {$tachles[1]} | Available: {$tachles[3]}\"");
    }

    sleep((int)$intervalSEC);
}


?>
