<?php

namespace Umbrellio\FileSeeker\CheckingMiddleware;

use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\Exception\UrlWrongFormatException;

class UrlCheck extends Middleware
{
    /**
     * @param string $source
     * @return bool
     * @throws AbstractException
     */
    public function check($source)
    {
        if (filter_var($source,FILTER_VALIDATE_URL)) {
            return parent::check($source);
        } else {
            throw new UrlWrongFormatException();
        }
    }
}