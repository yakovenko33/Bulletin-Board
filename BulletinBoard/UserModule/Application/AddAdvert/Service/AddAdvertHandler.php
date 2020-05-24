<?php


namespace BulletinBoard\UserModule\Application\AddAdvert\Service;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\UserModule\Infrastructure\Interfaces\AdvertRepositoryInterface;

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
        return $this->repository->addAdvert($commandQuery)
            ? $this->resultHandler->setStatusCode(201)
            : $this->resultHandler
                ->setErrors(["database" => "Проблемы на сервере, попробуйте позже."])
                ->setStatusCode(500);
    }
}
