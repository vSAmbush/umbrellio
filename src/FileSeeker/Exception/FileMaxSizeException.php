<?php

namespace Umbrellio\FileSeeker\Exception;

class FileMaxSizeException extends AbstractException
{
    protected $message = 'File is too long!';
}