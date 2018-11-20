<?php
namespace App\Application\Protocol;
use App\Application\Protocol\Command\Authenticate;
use App\Application\Protocol\Exception\InvalidCommand;

/**
 * Description of CommandInterpreter
 *
 * @author marek
 */
class CommandParser {
    
    public function parseMessage(string $recivedMessage) : Command {
        $decodedData = json_decode($recivedMessage);
        
        if (!isset($decodedData->token)) {
            throw new InvalidCommand("Missing token field in Authenticate command");
        }
        
        if (!isset($decodedData->command)) {
            throw new InvalidCommand("Missing command name'");
        }
        
        return new Authenticate($decodedData->token);
    }
    
}
