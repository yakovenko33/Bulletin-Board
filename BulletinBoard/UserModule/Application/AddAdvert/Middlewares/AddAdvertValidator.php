<?php


namespace BulletinBoard\UserModule\Application\AddAdvert\Middlewares;


use BulletinBoard\CommonModule\Bus\Validator\ValidatorRoot;

class AddAdvertValidator extends ValidatorRoot
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            "headline" => "required|string|max:50",
            "text" => "required|string|max:250"
        ];
    }

    /**
     * @return array
     */
    protected function getMessagesValidator(): array
    {
        return [
            'headline.required' => 'Поле заголовок обязательно к заполнению.',
            'headline.max' => "Длина заголовка не должна превышать :max.",
            'text.required' => 'Поле текс обязательно к заполнению.',
            'text.max' => "Длина текста не должжно превышать :max.",
        ];
    }
}
