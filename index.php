<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.09.2019
 * Time: 9:48
 */

use file\FileStringSeeker;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once (ROOT . DS . 'lib' . DS . 'autoload.php');

$config = yaml_parse_file(ROOT . DS . 'lib' . DS . 'config.yaml');

$fileSeeker = new FileStringSeeker($config);
try {
    //Checked with remote api 'https://api.themoviedb.org/3/movie/550?api_key=...', search - overview. Result: 1, 293
    $output = $fileSeeker->search(ROOT . DS . 'file.txt', 'far');
    echo ($output) ? $output : 'FALSE';

} catch (Exception $e) {
    echo 'The exception has been caused with message: ' . $e->getMessage();
}