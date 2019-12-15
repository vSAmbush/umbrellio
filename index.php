<?php

use Umbrellio\FileSeeker\Exception\FileAbstractException;
use Umbrellio\FileSeeker\File\FileStringSeeker;

$ds = DIRECTORY_SEPARATOR;
$root = dirname(__FILE__);

require_once ($root . $ds . 'vendor' . $ds . 'autoload.php');

$fileSeeker = new FileStringSeeker();
try {
    $output = $fileSeeker->search($root . $ds . 'file.txt', 'far');
    echo ($output) ? $output : 'FALSE';

} catch (FileAbstractException $e) {
    echo 'The exception has been caused with message: ' . $e->getMessage();
}