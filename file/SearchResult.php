<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.09.2019
 * Time: 12:01
 */

namespace file;


/**
 * Class SearchResult
 * @package file
 */
class SearchResult
{
    private $stringNumber;

    private $stringPosition;

    /**
     * SearchResult constructor.
     * @param $stringNumber
     * @param $stringPosition
     */
    public function __construct($stringNumber, $stringPosition)
    {
        $this->stringNumber = $stringNumber;
        $this->stringPosition = $stringPosition;
    }

    /**
     * @return integer
     */
    public function getStringNumber()
    {
        return $this->stringNumber;
    }

    /**
     * @return integer
     */
    public function getStringPosition()
    {
        return $this->stringPosition;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'String number is ' . ($this->stringNumber + 1) . ' and string position is ' . ($this->stringPosition + 1);
    }
}