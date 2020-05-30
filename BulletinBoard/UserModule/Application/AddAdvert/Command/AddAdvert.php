<?php
declare(strict_types = 1);

namespace BulletinBoard\UserModule\Application\AddAdvert\Command;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\CommonModule\Bus\Command\VerifyCommandQuery;
use Illuminate\Http\UploadedFile;

class AddAdvert extends VerifyCommandQuery implements CommandQueryInterface
{
    /**
     * @var string
     */
    private $headline;

    /**
     * @var string
     */
    private $text;

    /**
     * @var UploadedFile
     */
    private $image;

    /**
     * AddAdvert constructor.
     * @param array $data
     */
    public function __construct(array $data) //string $jwtToken
    {
        parent::__construct($data["jwt"]);

        $this->headline = $data["headline"];
        $this->text = $data["text"];
        $this->image = $data["image"];
    }

    /**
     * @return string
     */
    public function getHeadline(): string
    {
        return $this->headline;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return UploadedFile
     */
    public function getImage(): UploadedFile
    {
        return $this->image;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "headline" => $this->headline,
            "text" => $this->text,
            "image" => $this->image
        ];
    }
}
