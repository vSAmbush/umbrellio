<?php

namespace Umbrellio\FileSeeker\Seeker;

use Umbrellio\FileSeeker\CheckingMiddleware\Middleware;

abstract class AbstractSeeker
{
    /**
     * @var string $source
     */
    protected $source;

    /**
     * @var string $searchString
     */
    protected $searchString;

    /**
     * @var Middleware $checker
     */
    protected $checker;

    /**
     * AbstractFileSeeker constructor.
     * @param string $source
     * @param string $searchString
     */
    public function __construct($source, $searchString)
    {
        $this->source = $source;
        $this->searchString = $searchString;
        $this->initializeChecker();
    }

    /**
     * @return SearchResult
     */
    public abstract function search();

    /**
     * Initializing chain of responsibilities with consequent if statements
     */
    protected abstract function initializeChecker();

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->searchString;
    }

    /**
     * @param string $searchString
     */
    public function setSearchString($searchString)
    {
        $this->searchString = $searchString;
    }
}