<?php

use PHPUnit\Framework\TestCase;
use Umbrellio\FileSeeker\Exception\AbstractException;
use Umbrellio\FileSeeker\Exception\FileMaxSizeException;
use Umbrellio\FileSeeker\Exception\FileMimeTypeException;
use Umbrellio\FileSeeker\Exception\FileNotFoundException;
use Umbrellio\FileSeeker\File\FileSeeker;
use Umbrellio\FileSeeker\ResourceFactory;
use Umbrellio\FileSeeker\Seeker\AbstractSeeker;
use Umbrellio\FileSeeker\Seeker\SearchResult;

class UmbrellioTest extends TestCase
{
    public function testWrongTypeSeekerException()
    {
        $this->expectException(AbstractException::class);

        $fileSeeker = ResourceFactory::createResource('sfaf', 'saf', 'sag');
    }

    /**
     * @return AbstractSeeker
     * @throws Exception
     */
    public function testCreateFileSeeker()
    {
        $fileSeeker = ResourceFactory::createResource('', 'far', ResourceFactory::FILE_RESOURCE);
        $this->assertInstanceOf(FileSeeker::class, $fileSeeker);

        return $fileSeeker;
    }

    /**
     * @param AbstractSeeker $fileSeeker
     * @depends testCreateFileSeeker
     */
    public function testNotFoundException($fileSeeker)
    {
        $this->expectException(FileNotFoundException::class);

        $fileSeeker->setSource('fi');
        $fileSeeker->search();
    }

    /**
     * @param AbstractSeeker $fileSeeker
     * @depends testCreateFileSeeker
     */
    public function testMaxSizeException($fileSeeker)
    {
        $this->expectException(FileMaxSizeException::class);

        $fileSeeker->setSource('tests/testFiles/testSize.txt');
        $fileSeeker->search();
    }

    /**
     * @param AbstractSeeker $fileSeeker
     * @depends testCreateFileSeeker
     */
    public function testMimeTypeException($fileSeeker)
    {
        $this->expectException(FileMimeTypeException::class);

        $fileSeeker->setSource('tests/testFiles/testMimeType.docx');
        $fileSeeker->search();
    }

    /**
     * @param AbstractSeeker $fileSeeker
     * @depends testCreateFileSeeker
     * @throws Exception
     */
    public function testProperPerformOfFileSeeker($fileSeeker)
    {
        $fileSeeker->setSource('tests/testFiles/file.txt');
        $result = $fileSeeker->search();
        $this->assertEquals(new SearchResult(2, 2), $result);
    }
}