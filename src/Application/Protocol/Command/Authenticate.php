<?php
namespace App\Application\Protocol\Command;
use App\Application\Protocol\Command;
use App\Application\Protocol\Exception\InvalidCommand;

/**
 * Description of Authenticate
 *
 * @author marek
 */
class Authenticate implements Command
{
    
    private $token; 
    
    public function __construct(string $token) {
        $this->token = $token;
    }
    
    public function name(): string {
        return 'auth';
    }
    
    public function token() : string {
        return $this->token;
    }

    public static function fromData(\stdClass $data) {
        if (!isset($data->token)) {
            throw new InvalidCommand("Missing token field for command Authenticate");
        }
        
        $me = new self($data->token);
        return $me;
    }

}
