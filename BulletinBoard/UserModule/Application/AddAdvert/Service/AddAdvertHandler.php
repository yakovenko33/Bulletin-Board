<?php
declare(strict_types = 1);

namespace BulletinBoard\UserModule\Application\AddAdvert\Service;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\CommonModule\Exception\ProblemWithDatabase;
use BulletinBoard\UserModule\Application\AddAdvert\Events\SaveImage;
use BulletinBoard\UserModule\Infrastructure\Interfaces\AdvertRepositoryInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class AddAdvertHandler
{
    /**
     * @var
     */
    private $repository;

    /**
     * @var ResultHandlerInterface
     */
    private $resultHandler;

    /**
     * AddAdvertHandler constructor.
     * @param AdvertRepositoryInterface $repository
     * @param ResultHandlerInterface $resultHandler
     */
    public function __construct(
        AdvertRepositoryInterface $repository,
        ResultHandlerInterface $resultHandler
    ) {
        $this->repository = $repository;
        $this->resultHandler = $resultHandler;
    }

    /**
     * @param CommandQueryInterface $commandQuery
     * @return ResultHandlerInterface
     */
    public function handle(CommandQueryInterface $commandQuery): ResultHandlerInterface
    {
        try {
            $advert = $this->repository->addAdvert($commandQuery);
            if (empty($advert)) {
                throw new ProblemWithDatabase();
            }

            Event::dispatch(new SaveImage($commandQuery->getImage()));
            $this->resultHandler->setResult(["id" => $advert->id])->setStatusCode(201);
        } catch (ProblemWithDatabase $e) {
            $this->resultHandler->setErrors($e->getError())->setStatusCode();
        }

        return $this->resultHandler;
    }
}
