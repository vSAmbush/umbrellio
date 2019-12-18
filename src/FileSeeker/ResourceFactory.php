<?php

namespace Umbrellio\FileSeeker;

use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\File\FileSeeker;
use Umbrellio\FileSeeker\Seeker\AbstractSeeker;
use Umbrellio\FileSeeker\Url\UrlSeeker;

class ResourceFactory
{
    const FILE_RESOURCE = 'file';
    const URL_RESOURCE = 'url';

    /**
     * @var array $possibleResources
     */
    private static $possibleResources = [
        self::FILE_RESOURCE => FileSeeker::class,
        self::URL_RESOURCE => UrlSeeker::class
    ];

    /**
     * @param string $source
     * @param string $searchString
     * @param string $type
     * @return AbstractSeeker
     * @throws AbstractException
     */
    public static function createResource($source, $searchString, $type)
    {
        if (!isset(self::$possibleResources[$type])) {
            throw new AbstractException('Wrong type of seeker!');
        }

        $className = self::$possibleResources[$type];

        return new $className($source, $searchString);
    }
}