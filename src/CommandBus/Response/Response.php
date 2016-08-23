<?php

namespace KP\CommandBus\Response;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class Response implements ResponseInterface
{
    /**
     * @var int
     */
    protected $status;

    /**
     * @var mixed
     */
    protected $content;

    /**
     * @param null $content
     */
    public function __construct($content = null)
    {
        $this->content = $content;
        $this->status = 200;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function isOk()
    {
        return $this->getStatus() === 200;
    }

    /**
     * @return bool
     */
    public function isInvalid()
    {
        return $this->getStatus() !== 200;
    }

    /**
     * @return $this
     */
    public function setAsInvalid()
    {
        $this->setStatus(400);

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
