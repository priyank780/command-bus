<?php

namespace KP\CommandBus\Response;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class Response implements ResponseInterface
{
    /**
     * @var mixed
     */
    protected $content;

    /**
     * Response constructor.
     *
     * @param mixed $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
