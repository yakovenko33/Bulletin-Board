<?php


namespace BulletinBoard\UserModule\Infrastructure\Modals;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        "first_name",
        "last_name",
        'email',
        'password',
    ];

    /**
     * @return array
     */
    public function toJwtArray(): array
    {
        return [
            "id" => $this->id,
            "email" => $this->email,
        ];
    }
}
