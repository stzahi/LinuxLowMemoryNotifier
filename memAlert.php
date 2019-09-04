 
<?php
include __DIR__.'/vendor/autoload.php';
 
use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;

$notify = false;

$data = shell_exec('free -h -t');
$data = explode("\n",$data);
$data = explode(" ",$data[3]);
$tachles = [];
foreach($data as $val)
    if(!empty($val)) $tachles[] = $val;

    if((float)$tachles[3] < 1)
        $notify = true;


if(!$notify) die();

// Create a Notifier
$notifier = NotifierFactory::create();

// Create your notification
$notification =
    (new Notification())
    ->setTitle('Low memory')
    ->setBody("Total: {$tachles[1]} | Available: {$tachles[3]}")
    ->setIcon(__DIR__.'/icon.png')
    // ->addOption('subtitle', 'This is a subtitle') // Only works on macOS (AppleScriptNotifier)
    // ->addOption('sound', 'Frog') // Only works on macOS (AppleScriptNotifier)
;

// Send it
$notifier->send($notification);
?>