<?php

namespace Umbrellio\FileSeeker\File;

use Generator;
use Umbrellio\FileSeeker\CheckingMiddleware\MaxSizeCheck;
use Umbrellio\FileSeeker\CheckingMiddleware\MimeTypeCheck;
use Umbrellio\FileSeeker\CheckingMiddleware\NotFoundCheck;
use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\Seeker\AbstractSeeker;
use Umbrellio\FileSeeker\Seeker\SearchResult;

class FileSeeker extends AbstractSeeker
{
    /**
     * @return Generator
     */
    private function readFile()
    {
        $file = fopen($this->source,'r');
        while ($line = fgets($file)) {
            yield $line;
        }
    }

    /**
     * Checking on entering string in file
     *
     * @return SearchResult
     * @throws AbstractException
     */
    public function search()
    {
        if (!$this->checker->check($this->source)) {
            return new SearchResult();
        }

        $strNum = $srtPos = -1;
        foreach ($this->readFile() as $i => $line) {
            if (($temp = mb_stripos($line, $this->searchString)) !== false) {
                $srtPos = $temp;
                $strNum = $i;
            }
        }

        return new SearchResult($strNum, $srtPos);
    }

    protected function initializeChecker()
    {
        $this->checker = new NotFoundCheck();
        $this->checker
            ->setNext(new MimeTypeCheck())
            ->setNext(new MaxSizeCheck());
    }
}