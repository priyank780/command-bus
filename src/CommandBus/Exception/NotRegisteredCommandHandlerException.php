<?php

namespace KP\CommandBus\Exception;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class NotRegisteredCommandHandlerException extends \Exception
{
    public function __construct($commandClassName = "", $code = 0, \Exception $previous = null)
    {
        $message = sprintf(
            'Command %s was not registered as a valid use case',
            $commandClassName
        );

        parent::__construct($message, $code, $previous);
    }
}
