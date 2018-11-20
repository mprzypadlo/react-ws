<?php
namespace App\Application;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;
use App\Application\Protocol\CommandParser;
/**
 * Description of Pusher
 *
 * @author marek
 */
class Pusher implements \Ratchet\MessageComponentInterface {
    
    /**
     *
     * @var CommandParser
     */
    private $protocol; 
    
    private $connectionRegistry;
    
    public function onClose(CommandParser $protocol)
    {
       $this->protocol = $protocol;
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        
    }

    public function onMessage(ConnectionInterface $from, $msg) {
    
        $command = $this->protocol->parseMessage($msg);
        $this->commands->execute($command);
    }

    public function onOpen(ConnectionInterface $conn) {
        
    }

}
