 
<?php
// include __DIR__.'/vendor/autoload.php';
 
// use Joli\JoliNotif\Notification;
// use Joli\JoliNotif\NotifierFactory;
ini_set('max_execution_time','0');
$notify = false;

$icon = __DIR__.'/icon.png';
while (true) {
    $conf = explode(',', file_get_contents(__DIR__ . '/conf.txt') );
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

    sleep( (int)$intervalSEC );
}



// // Create a Notifier for other OS
// $notifier = NotifierFactory::create();

// // Create your notification
// $notification =
//     (new Notification())
//     ->setTitle('Low memory')
//     ->setBody("Total: {$tachles[1]} | Available: {$tachles[3]}")
//     ->setIcon(__DIR__.'/icon.png')
//     // ->addOption('subtitle', 'This is a subtitle') // Only works on macOS (AppleScriptNotifier)
//     // ->addOption('sound', 'Frog') // Only works on macOS (AppleScriptNotifier)
// ;

// // Send it
// $notifier->send($notification);

?>
