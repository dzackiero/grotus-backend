<?php

namespace App\Interfaces;

interface HasImage
{
    /*
     * return an array with three keys
     * width: width of the image
     * height: height of the image
     * ratio: aspect ratio of the image
     * */
    public function getImageSize(): array;
}
