<?php

namespace App\Application\Protocol;

use App\Application\Protocol\Command\Authenticate;
use App\Application\Protocol\Exception\InvalidCommand;
use App\Application\Protocol\Command\NotifyPositionChange;

/**
 * Description of CommandInterpreter
 *
 * @author marek
 */
class CommandParser {

    private $commandDefs = [
        'auth' => Authenticate::class,
        'send' => NotifyPositionChange::class
    ];

    public function parseMessage(string $recivedMessage): Command {
        $decodedMessage = json_decode($recivedMessage);
        $this->validateMessasge($decodedMessage);
        $commandClass = $this->commandDefs[$decodedMessage->command];
        return call_user_func([$commandClass, 'fromData'], $decodedMessage);
    }

    private function validateMessasge(\stdClass $message) {
        if (!$message) {
            throw new InvalidArgumentException("Message is invalid JSON");
        }

        if (!isset($message->command)) {
            throw new InvalidCommand("Missing command name");
        }

        if (!isset($this->commandDefs[$message->command])) {
            throw new InvalidCommand('Unrecognized command');
        }
    }

}
