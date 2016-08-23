<?php

namespace KP\CommandBus\Response;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
interface ResponseInterface
{
    /**
     * @return mixed
     */
    public function getContent();

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return bool
     */
    public function isOk();

    /**
     * @return bool
     */
    public function isInvalid();
}
