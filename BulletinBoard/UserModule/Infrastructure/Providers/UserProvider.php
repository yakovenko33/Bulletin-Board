<?php


namespace BulletinBoard\UserModule\Infrastructure\Providers;


use BulletinBoard\CommonModule\Bus\Handler\ResultHandler;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\UserModule\Infrastructure\Interfaces\UserRepositoryInterface;
use BulletinBoard\UserModule\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $singletons = [
        ResultHandlerInterface::class => ResultHandler::class,
        UserRepositoryInterface::class => UserRepository::class
    ];

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../../UI/Routes/api.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Infrastructure/Migrations');
    }
}
