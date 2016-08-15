<?php

namespace KP\CommandBus\Command;

use KP\CommandBus\CommandInterface;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class Command implements CommandInterface
{
    /**
     * @inheritDoc
     */
    public function getCommandHandlerClass()
    {
        $commandClass = get_class($this);

        return sprintf('%sHandler', $commandClass);
    }
}
