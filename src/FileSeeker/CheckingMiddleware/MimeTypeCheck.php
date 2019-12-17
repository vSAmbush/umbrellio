<?php

namespace Umbrellio\FileSeeker\CheckingMiddleware;

use Umbrellio\FileSeeker\Config\Config;
use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\Exception\FileMimeTypeException;

class MimeTypeCheck extends Middleware
{
    /**
     * @var array $config
     */
    protected $config;

    public function __construct()
    {
        $config = Config::getInstance()->getConfig();
        $this->config = $config['file_config'];
    }

    /**
     * @param string $source
     * @return bool
     * @throws AbstractException
     */
    public function check($source)
    {
        if (mime_content_type($source) === $this->config['mime_type']) {
            return parent::check($source);
        } else {
            throw new FileMimeTypeException();
        }
    }
}