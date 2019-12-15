<?php

namespace Umbrellio\FileSeeker\File;

use Umbrellio\FileSeeker\Config\Config;
use Umbrellio\FileSeeker\Exception\FileMaxSizeException;
use Umbrellio\FileSeeker\Exception\FileMimeTypeException;
use Umbrellio\FileSeeker\Exception\FileNotFoundException;

class FileStringSeeker implements IFileSeeker
{
    /**
     * @var Config
     */
    private $config;

    /**
     * FileStringSeeker constructor.
     */
    public function __construct()
    {
        $this->config = Config::getInstance();
    }

    /**
     * Checking on entering string in file
     *
     * @param $fileName
     * @param $searchString
     * @return bool|SearchResult
     * @throws FileMaxSizeException
     * @throws FileMimeTypeException
     * @throws FileNotFoundException
     */
    public function search($fileName, $searchString)
    {
        //checking local or remote path of file
        if(!filter_var($fileName, FILTER_VALIDATE_URL)) {
            if (!file_exists($fileName)) {
                throw new FileNotFoundException('File not found!');
            }

            if (mime_content_type($fileName) !== $this->config->get('mime_type')) {
                throw new FileMimeTypeException('File has a wrong mime type!');
            }

            if (filesize($fileName) > $this->config->get('max_length')) {
                throw new FileMaxSizeException('File is too long!');
            }
        }

        $content = file_get_contents($fileName);
        //echo $content;

        $exploded = explode("\r\n", $content);
        $count = count($exploded);

        for($i = 0; $i < $count; $i++) {

            if(($temp = mb_stripos($exploded[$i], $searchString)) !== false) {
                $srtPos = $temp;
                $strNum = $i;
            }
        }

        if(isset($strNum) && isset($srtPos))
            return new SearchResult($strNum, $srtPos);
        else
            return false;
    }
}