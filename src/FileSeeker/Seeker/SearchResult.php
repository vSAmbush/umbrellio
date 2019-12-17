<?php

namespace Umbrellio\FileSeeker\Seeker;

class SearchResult
{
    /**
     * @var integer $stringNumber
     */
    private $stringNumber;

    /**
     * @var integer $stringPosition
     */
    private $stringPosition;

    /**
     * SearchResult constructor.
     * @param integer $stringNumber
     * @param integer $stringPosition
     */
    public function __construct($stringNumber = -1, $stringPosition = -1)
    {
        $this->stringNumber = $stringNumber;
        $this->stringPosition = $stringPosition;
    }

    /**
     * @return bool
     */
    public function isPure()
    {
        return $this->stringNumber < 0 || $this->stringPosition < 0;
    }

    /**
     * @return integer
     */
    public function getStringNumber()
    {
        return $this->stringNumber;
    }

    /**
     * @param integer $stringNumber
     */
    public function setStringNumber($stringNumber)
    {
        $this->stringNumber = $stringNumber;
    }

    /**
     * @return integer
     */
    public function getStringPosition()
    {
        return $this->stringPosition;
    }

    /**
     * @param integer $stringPosition
     */
    public function setStringPosition($stringPosition)
    {
        $this->stringPosition = $stringPosition;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->isPure()
            ? 'Specified string is not found in the file!'
            : 'String number is ' . ($this->stringNumber + 1) . ' and string position is ' . ($this->stringPosition + 1);
    }
}