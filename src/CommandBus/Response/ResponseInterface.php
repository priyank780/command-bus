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
}
