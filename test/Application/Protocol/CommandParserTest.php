<?php
use PHPUnit\Framework\TestCase;
use App\Application\Protocol\CommandParser;
use App\Application\Protocol\Command\Authenticate;
use App\Application\Protocol\Exception\InvalidCommand;

/**
 * Description of CommandParserTest
 *
 */
class CommandParserTest extends TestCase
{
    
    public function test_parsesAuthenticateCommand()
    {
        $commandData = [
            'command' => 'auth', 
            'token' => 'some-token'
        ]; 
        
        $commandParser = new CommandParser();
        $parsedCommand = $commandParser->parseMessage(json_encode($commandData));

        $this->assertTrue($parsedCommand instanceof Authenticate);
        $this->assertEquals("auth", $parsedCommand->name());
        $this->assertEquals("some-token", $parsedCommand->token());
    }
    
    public function test_parsesAuthenticateCommandWithDifferentToken()
    {
        $commandData = [
            'command' => 'auth', 
            'token' => 'another-token'
        ]; 
        
        $commandParser = new CommandParser();
        $parsedCommand = $commandParser->parseMessage(json_encode($commandData));
        
        $this->assertTrue($parsedCommand instanceof Authenticate);
        $this->assertEquals('auth', $parsedCommand->name());
        $this->assertEquals('another-token', $parsedCommand->token());
    }
    
    public function test_givenAuthenticateCommand_withoutToken_ExceptionIsThrown()
    {
        $commandData = [
            'command' => 'auth'
        ]; 
        
        $this->expectException(InvalidCommand::class);
        
        $commandParser = new CommandParser(); 
        $commandParser->parseMessage(json_encode($commandData));
    }
    
    public function test_givenMessageWithoutCommandField_ExceptionIsThrown()
    {
        $commandData = [
            'token' => 'some-token'
        ];
        
        $this->expectException(InvalidCommand::class);
        
        $commandParser = new CommandParser();        
        $commandParser->parseMessage(json_encode($commandData));
    }
    
}
