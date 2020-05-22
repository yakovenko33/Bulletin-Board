<?php


namespace BulletinBoard\UserModule\Application\SingUp\Command;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;

class SingUp implements CommandQueryInterface
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * SingUp constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->firstName = $data["name"]; //first_name
        $this->lastName = $data["surname"];
        $this->email = $data["email"];
        $this->password = $data["password"];
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->firstName,
            "surname" => $this->lastName,
            "email" => $this->email,
            "password" => $this->password
        ];
    }
}
