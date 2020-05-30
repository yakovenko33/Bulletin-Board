<?php


namespace BulletinBoard\UserModule\Infrastructure\Providers;


use BulletinBoard\CommonModule\Bus\Handler\ResultHandler;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\UserModule\Infrastructure\Interfaces\AdvertRepositoryInterface;
use BulletinBoard\UserModule\Infrastructure\Interfaces\UserRepositoryInterface;
use BulletinBoard\UserModule\Infrastructure\Repositories\AdvertRepository;
use BulletinBoard\UserModule\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use BulletinBoard\UserModule\Application\AddAdvert\Events\SaveImage as SaveImageEvent;
use BulletinBoard\UserModule\Application\AddAdvert\Listeners\SaveImage as SaveImageListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class UserProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $singletons = [
        ResultHandlerInterface::class => ResultHandler::class,
        UserRepositoryInterface::class => UserRepository::class,
        AdvertRepositoryInterface::class => AdvertRepository::class
    ];

    /**
     * @var array
     */
    private $listen = [
        SaveImageEvent::class => [
            SaveImageListener::class
        ]
    ];

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../../UI/Routes/api.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Infrastructure/Migrations');

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
    }
}
