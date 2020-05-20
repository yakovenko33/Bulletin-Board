<?php


namespace BulletinBoard\UserModule\Application\SingIn\Middlewares;


use BulletinBoard\CommonModule\Bus\Validator\ValidatorRoot;

class SingInValidator extends ValidatorRoot
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            "email" => 'required|string|max:50|email:rfc,dns',
            "password" => 'required|string|max:50'
        ];
    }
}
