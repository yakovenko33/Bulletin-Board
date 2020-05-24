<?php


namespace BulletinBoard\UserModule\Application\AddAdvert\Command;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\CommonModule\Bus\Command\VerifyCommandQuery;

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
     * @var string
     */
    private $token;

    /**
     * @var
     */
    private $img; // next time add images (img, png);

    /**
     * AddAdvert constructor.
     * @param array $data
     */
    public function __construct(array $data) //string $jwtToken
    {
        parent::__construct($data["jwt"]);

        $this->headline = $data["headline"];
        $this->text = $data["text"];
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
     * @return array
     */
    public function toArray(): array
    {
        return [
            "headline" => $this->headline,
            "text" => $this->text
        ];
    }
}
