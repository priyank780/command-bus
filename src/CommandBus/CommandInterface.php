<?php

namespace KP\CommandBus;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
interface CommandInterface
{
    /**
     * @return string
     */
    public function getCommandHandlerClass();
}
