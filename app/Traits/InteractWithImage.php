<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;

trait InteractWithImage
{
    public function uploadImage(UploadedFile $image, string $directory, string $name): bool
    {
        $fileName = time() . "_" . $name . "." . $image->getClientOriginalExtension();
        $path = "media/" . $directory . '/' . $fileName;

        $image = Image::read($image);
        $aspectRatio = $image->width() / $image->height();

        if (!method_exists($this, "getImageSize")) {
            return false;
        }

        $sizes = $this->getImageSize();

        if ($aspectRatio == $sizes["ratio"]) {
            $image->scale($sizes["width"]);
        } else {
            $image->scaleDown($sizes["width"]);
            $image->crop($sizes["width"], $sizes["height"], position: "center");
        }
        $image->save(public_path($path));

        if (method_exists($this, "uploadImageCallback")) {
            return $this->uploadImageCallback($path);
        }

        return true;
    }

    public function uploadImageFromPath(string $filePath, string $directory, string $name): bool
    {
        $filePath = public_path($filePath);
        if (!file_exists($filePath)) {
            return false;
        }

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $fileName = time() . "_" . $name . "." . $fileExtension;
        $path = "media/" . $directory . '/' . $fileName;

        // Load the image from the local file path
        $image = Image::read($filePath);
        $aspectRatio = $image->width() / $image->height();

        if (!method_exists($this, "getImageSize")) {
            return false;
        }

        $sizes = $this->getImageSize();

        if ($aspectRatio == $sizes["ratio"]) {
            $image->scale($sizes["width"]);
        } else {
            $image->scaleDown($sizes["width"]);
            $image->crop($sizes["width"], $sizes["height"], position: "center");
        }
        $image->save(public_path($path));

        if (method_exists($this, "uploadImageCallback")) {
            return $this->uploadImageCallback($path);
        }

        return true;
    }
}
