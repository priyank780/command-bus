<?php

namespace KP\CommandBus\Event;

use KP\CommandBus\CommandInterface;
use Symfony\Contracts\EventDispatcher\Event;
/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class PreCommandEvent extends Event
{
    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     * @return CommandInterface
     */
    public function getCommand()
    {
        return $this->command;
    }
}
