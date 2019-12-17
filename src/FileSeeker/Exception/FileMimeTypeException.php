<?php

namespace Umbrellio\FileSeeker\Exception;

class FileMimeTypeException extends AbstractException
{
    protected $message = 'File has a wrong mime type!';
}