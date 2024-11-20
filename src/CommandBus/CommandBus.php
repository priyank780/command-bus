<?php

namespace KP\CommandBus;

use KP\CommandBus\Event\PostCommandEvent;
use KP\CommandBus\Event\PreCommandEvent;
use KP\CommandBus\Exception\ClassDoesNotImplementCommandHandlerInterfaceException;
use KP\CommandBus\Exception\GenericCommandHandlerException;
use KP\CommandBus\Exception\NotRegisteredCommandHandlerException;
use KP\CommandBus\Response\Response;
use KP\CommandBus\Response\ResponseInterface;
use ProxyManager\Proxy\ProxyInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class CommandBus
{
    /**
     * @var CommandHandlerInterface[]
     */
    protected $commandHandlers;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * CommandBus constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param CommandHandlerInterface[] $commandHandlers
     *
     * @throws ClassDoesNotImplementCommandHandlerInterfaceException
     */
    public function registerCommandHandlers($commandHandlers)
    {
        foreach ($commandHandlers as $commandHandler) {
            if ($commandHandler instanceof CommandHandlerInterface) {
                // support for @url http://ocramius.github.io/ProxyManager/
                if ($commandHandler instanceof ProxyInterface) {
                    $ref = new \ReflectionClass($commandHandler);

                    $commandHandlerClassName = $ref->getParentClass()->getName();
                } else {
                    $commandHandlerClassName = get_class($commandHandler);
                }

                $this->commandHandlers[$commandHandlerClassName] = $commandHandler;

            } else {
                throw new ClassDoesNotImplementCommandHandlerInterfaceException(
                    get_class($commandHandler)
                );
            }
        }
    }

    /**
     * @param CommandInterface $command
     *
     * @return ResponseInterface
     *
     * @throws NotRegisteredCommandHandlerException
     */
    public function execute(CommandInterface $command)
    {
        $this->eventDispatcher->dispatch(new PreCommandEvent($command), Events::PRE_COMMAND);

        try {
            $commandHandlerClass = $command->getCommandHandlerClass();
            if (isset($this->commandHandlers[$commandHandlerClass])) {
                $results = $this->commandHandlers[$commandHandlerClass]->handle($command);
            } else {
                throw new NotRegisteredCommandHandlerException($commandHandlerClass);
            }
        } catch (GenericCommandHandlerException $e) {
            $results = new Response(null);
        }

        if ($results instanceof ResponseInterface) {
            $response = $results;
        } else {
            $response = new Response($results);
        }

        $this->eventDispatcher->dispatch(new PostCommandEvent($command, $response), Events::POST_COMMAND);

        return $response;
    }
}
