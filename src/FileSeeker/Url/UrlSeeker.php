<?php

namespace Umbrellio\FileSeeker\Url;

use Umbrellio\FileSeeker\CheckingMiddleware\UrlCheck;
use Umbrellio\FileSeeker\Seeker\AbstractSeeker;
use Umbrellio\FileSeeker\Seeker\SearchResult;

class UrlSeeker extends AbstractSeeker
{
    /**
     * @inheritDoc
     */
    public function search()
    {
        // TODO: Realize searching string in web resource.
        return new SearchResult();
    }

    protected function initializeChecker()
    {
        $this->checker = new UrlCheck();
    }
}