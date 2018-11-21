<?php
namespace App\Application\Protocol;

/**
 * Description of Command
 *
 * @author marek
 */
interface Command {
    
   public function name() : string;
   
   public static function fromData(\stdClass $data);
    
}
