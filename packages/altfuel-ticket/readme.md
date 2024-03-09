ADD BELLOW TO THE config/filesystems.php :

'ticket' => [
    'driver' => 'local',
    'root' => public_path(config('ATConfig.ticket-uploads-folder')),
],


======================
