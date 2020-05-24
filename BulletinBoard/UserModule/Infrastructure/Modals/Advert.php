<?php


namespace BulletinBoard\UserModule\Infrastructure\Modals;


use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    /**
     * @var string
     */
    protected $table = 'adverts';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        "user_id",
        "headline",
        "text"
    ];
}
