<?php
declare(strict_types = 1);

namespace BulletinBoard\UserModule\UI\Controllers;


use BulletinBoard\CommonModule\JWT\Middleware\JwtVerifyUser;
use BulletinBoard\CommonModule\UI\Response\Response;
use BulletinBoard\UserModule\Application\AddAdvert\Command\AddAdvert;
use BulletinBoard\UserModule\Application\AddAdvert\Middlewares\AddAdvertValidator;
use BulletinBoard\UserModule\Application\AddAdvert\Service\AddAdvertHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class AdvertController
{
    use Response;

    /**
     * @var CommandBusInterface
     */
    private $bus;

    /**
     * AdvertController constructor.
     * @param CommandBusInterface $bus
     */
    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addAdvert(Request $request): JsonResponse
    {
        $this->bus->addHandler(AddAdvert::class, AddAdvertHandler::class);
        $resultHandler = $this->bus->dispatch(
            AddAdvert::class,
            $request->all(),
            [JwtVerifyUser::class, AddAdvertValidator::class]
        );

        return $this->getResponse($resultHandler);
    }
}
