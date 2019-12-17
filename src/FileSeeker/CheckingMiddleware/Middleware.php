<?php

namespace Umbrellio\FileSeeker\CheckingMiddleware;

use Umbrellio\FileSeeker\Exception\AbstractException;

abstract class Middleware
{
    /**
     * @var Middleware
     */
    private $next;

    /**
     * @param Middleware $middleware
     * @return Middleware
     */
    public function setNext($middleware)
    {
        $this->next = $middleware;

        return $middleware;
    }

    /**
     * @param string $source
     * @return bool
     * @throws AbstractException
     */
    public function check($source)
    {
        if (!$this->next) {
            return true;
        }

        return $this->next->check($source);
    }
}