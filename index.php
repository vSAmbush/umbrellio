<?php

use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\ResourceFactory;

$ds = DIRECTORY_SEPARATOR;
$root = dirname(__FILE__);

require_once ($root . $ds . 'vendor' . $ds . 'autoload.php');
$filePath = "{$root}{$ds}tests{$ds}testFiles{$ds}file.txt";

try {
    $fileSeeker = ResourceFactory::createResource($filePath, 'far', ResourceFactory::FILE_RESOURCE);
    echo ($output = $fileSeeker->search()) ? $output : 'FALSE';
} catch (AbstractException $e) {
    echo 'The exception has been caused with message: ' . $e->getMessage();
}