<?php


namespace BulletinBoard\UserModule\Application\SingUp\Middlewares; //middleware


use BulletinBoard\CommonModule\Bus\Validator\ValidatorRoot;

class SingUpValidator extends ValidatorRoot
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            "first-name" => 'required|string|max:50|',
            "last-name" => 'required|string|max:50|',
            "email" => 'required|string|max:50|unique:users,email|email:rfc,dns', //unique:users,email|
            "password" => 'required|string|max:50|'
        ];
    }
}
