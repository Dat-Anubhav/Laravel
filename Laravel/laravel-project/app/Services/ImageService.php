<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class ImageService
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Save a cover-cropped square JPEG (e.g. avatars).
     */
    public function saveAvatar(UploadedFile $file, string $absolutePath, int $size = 200, int $quality = 85): void
    {
        $this->manager
            ->decode($file)
            ->cover($size, $size)
            ->encode(new JpegEncoder(quality: $quality))
            ->save($absolutePath);
    }

    /**
     * Save a width-scaled JPEG (e.g. post cover images).
     */
    public function savePostCover(UploadedFile $file, string $absolutePath, int $maxWidth = 800, int $quality = 80): void
    {
        $this->manager
            ->decode($file)
            ->scale(width: $maxWidth)
            ->encode(new JpegEncoder(quality: $quality))
            ->save($absolutePath);
    }
}
