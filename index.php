<?php

use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\File\FileSeeker;

$ds = DIRECTORY_SEPARATOR;
$root = dirname(__FILE__);

require_once ($root . $ds . 'vendor' . $ds . 'autoload.php');

$fileSeeker = new FileSeeker($root . $ds . 'file.txt', 'far');

try {
    $output = $fileSeeker->search();
    echo ($output) ? $output : 'FALSE';
} catch (AbstractException $e) {
    echo 'The exception has been caused with message: ' . $e->getMessage();
}