<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.09.2019
 * Time: 10:01
 */

namespace lib;

/**
 * Interface IFileSeeker
 * @package lib
 */
interface IFileSeeker
{
    public function search($fileName, $searchString);
}