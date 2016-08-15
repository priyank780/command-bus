<?php

namespace KP\CommandBus\Exception;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class ClassDoesNotImplementCommandHandlerInterfaceException extends \Exception
{
    public function __construct($commandClassName = "", $code = 0, \Exception $previous = null)
    {
        $message = sprintf(
            'Class %s does not implement CommandHandlerInterface',
            $commandClassName
        );

        parent::__construct($message, $code, $previous);
    }
}
