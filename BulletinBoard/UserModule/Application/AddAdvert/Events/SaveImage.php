<?php
declare(strict_types = 1);

namespace BulletinBoard\UserModule\Application\AddAdvert\Events;


use Illuminate\Http\UploadedFile;

class SaveImage
{
    /**
     * @var UploadedFile
     */
    private $image;

    /**
     * SaveImage constructor.
     * @param UploadedFile $image
     */
    public function __construct(UploadedFile $image)
    {
        $this->image = $image;
    }

    /**
     * @return UploadedFile
     */
    public function getImage(): UploadedFile
    {
        return $this->image;
    }
}
