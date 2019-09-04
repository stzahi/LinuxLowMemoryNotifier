# LinuxLowMemoryNotifier
a tiny php script to send system notification whenever your machine's memory is running out

Simply add it to your crontab

e.g:
If you want it to be checked in 10 minutes interval

*/10 * * * * php /path/to/script/memAlert.php
