<?php

namespace Umbrellio\FileSeeker\File;

class SearchResult
{
    private $stringNumber;

    private $stringPosition;

    /**
     * SearchResult constructor.
     * @param integer $stringNumber
     * @param integer $stringPosition
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