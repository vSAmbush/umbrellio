<?php

namespace Umbrellio\FileSeeker\Exception;

class FileNotFoundException extends AbstractException
{
    protected $message = 'File not found!';
}