<?php

namespace App\Application\Protocol\Command;
use App\Application\Protocol\Command;

/**
 * Description of Notify
 *
 * @author marek
 */
class NotifyPositionChange implements Command {
    
    private $recipient; 
    
    private $position;
   
    public function __construct(string $recipient, int $position) {
        $this->recipient = $recipient;
        $this->position = $position;
    }
    
    function recipient() {
        return $this->recipient;
    }

    function position() {
        return $this->position;
    }

    public function name(): string {
        return "notify-change";
    }

    public static function fromData(\stdClass $data) {
        return new NotifyPositionChange($data->to, $data->position);
    }

}
