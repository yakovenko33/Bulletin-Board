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
            "name" => 'required|string|max:25|',
            "surname" => 'required|string|max:25|',
            "email" => 'required|string|max:50|unique:users,email|email:rfc,dns', //unique:users,email|
            "password" => 'required|string|max:50|'
        ];
    }

    /**
     * @return array
     */
    protected function getMessagesValidator(): array
    {
        return [
            'name.required' => 'Поле имя обязательно к заполнению.',
            'name.max' => "Длина имени не должна превышать :max.",
            'surname.required' => 'Поле фамилия обязательно к заполнению.',
            'surname.max' => "Длина фамилии не должна превышать :max.",
            'email.required' => 'Поле email обязательно к заполнению.',
            'email.max' => "Длина email не должна превышать :max.",
            'email.email' => "Email введён не коректно",
            'email.unique' => "Пользователь с таким email существует",
            'password.required' => 'Поле пароль обязательно к заполнению.',
            'password.max' => "Длина пароля не должна превышать :max.",
        ];
    }
}
