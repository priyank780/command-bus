<?php

namespace KP\CommandBus\Event;

use KP\CommandBus\CommandInterface;
use KP\CommandBus\Response\ResponseInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class PostCommandEvent extends Event
{
    /**
     * @var CommandInterface
     */
    protected $command;
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param CommandInterface  $command
     * @param ResponseInterface $response
     */
    public function __construct(CommandInterface $command, ResponseInterface $response)
    {
        $this->command = $command;
        $this->response = $response;
    }

    /**
     * @return CommandInterface
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
