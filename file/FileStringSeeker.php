<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.09.2019
 * Time: 10:03
 */

namespace file;

use exception\FileMaxSizeException;
use exception\FileMimeTypeException;
use exception\FileNotFoundException;
use lib\IFileSeeker;

/**
 * Class FileStringSeeker
 * @package file
 */
class FileStringSeeker implements IFileSeeker
{
    private $config;

    /**
     * FileStringSeeker constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config['file_config'];
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

            if (mime_content_type($fileName) !== $this->config['mime_type']) {
                throw new FileMimeTypeException('File has a wrong mime type!');
            }

            if (filesize($fileName) > $this->config['max_length']) {
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