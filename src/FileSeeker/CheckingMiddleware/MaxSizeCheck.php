<?php

namespace Umbrellio\FileSeeker\CheckingMiddleware;

use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\Exception\FileMaxSizeException;

class MaxSizeCheck extends MimeTypeCheck
{
    /**
     * @param string $source
     * @return bool
     * @throws AbstractException
     */
    public function check($source)
    {
        if (filesize($source) < $this->config['max_length']) {
            return parent::check($source);
        } else {
            throw new FileMaxSizeException();
        }
    }
}