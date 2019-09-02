<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.09.2019
 * Time: 9:54
 */

function autoload($className) {

    $className = str_replace('\\', DS, $className);

    $path = ROOT . DS . $className . '.php';
    if(file_exists($path)) {
        require_once($path);
    }
}

spl_autoload_register('autoload');