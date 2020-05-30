<?php
declare(strict_types = 1);

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
            "text" => "required|string|max:250",
            "image" => "required|max:1900|mimes:jpeg,png"
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
            'image.required' => "Вы не добавили файл.",
            'image.max' => "Длина файла не должжно превышать :max. КБ.",
            'image.mimes' => "Формат файла указан не верно (разрешон jpeg,png).",
        ];
    }
}
