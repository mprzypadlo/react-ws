<?php 

require __DIR__ . '/vendor/autoload.php'; 
use App\Application\Pusher;

$loop = React\EventLoop\Factory::create();
$pusher = new App\Application\Pusher();

$context = new React\ZMQ\Context($loop);
$pull = $context->getSocket(ZMQ::SOCKET_PULL);
$pull->bind('tcp://127.0.0.1:5555');
$pull->on('message', [$pusher, 'onBlogEntry']);

$webSock = new React\Socket\Server('127.0.0.1:8080', $loop);

$webServer = new Ratchet\Server\IoServer(
        new Ratchet\Http\HttpServer(
                new Ratchet\WebSocket\WsServer(
                        $pusher
                )
        ),
        $webSock,
        $loop
);


$webServer->run();
