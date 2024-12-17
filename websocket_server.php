<?php

use Ratchet\App;
use App\Libraries\ChatServer;

require __DIR__ . '/vendor/autoload.php';

$server = new Ratchet\App('localhost', 8081);
$server->route('/chat', new ChatServer, ['*']);
$server->run();
