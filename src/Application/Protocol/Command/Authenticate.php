<?php
namespace App\Application\Protocol\Command;
use App\Application\Protocol\Command;

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

}
