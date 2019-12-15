<?php

namespace Umbrellio\FileSeeker\File;

interface IFileSeeker
{
    public function search($fileName, $searchString);
}