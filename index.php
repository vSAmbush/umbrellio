<?php

use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\ResourceFactory;

$ds = DIRECTORY_SEPARATOR;
$root = dirname(__FILE__);

require_once ($root . $ds . 'vendor' . $ds . 'autoload.php');

try {
    $fileSeeker = ResourceFactory::createResource($root . $ds . 'file.txt', 'far', ResourceFactory::FILE_RESOURCE);
    echo ($output = $fileSeeker->search()) ? $output : 'FALSE';
} catch (AbstractException $e) {
    echo 'The exception has been caused with message: ' . $e->getMessage();
}