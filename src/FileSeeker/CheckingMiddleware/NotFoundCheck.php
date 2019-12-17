<?php

namespace Umbrellio\FileSeeker\CheckingMiddleware;

use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\Exception\FileNotFoundException;

class NotFoundCheck extends Middleware
{
    /**
     * @param string $source
     * @return bool
     * @throws AbstractException
     */
    public function check($source)
    {
        if (file_exists($source)) {
            return parent::check($source);
        } else {
            throw new FileNotFoundException();
        }
    }
}