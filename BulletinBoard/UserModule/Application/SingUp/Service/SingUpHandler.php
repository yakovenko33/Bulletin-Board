<?php


namespace BulletinBoard\UserModule\Application\SingUp\Service;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\UserModule\Infrastructure\Interfaces\UserRepositoryInterface;

class SingUpHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * @var ResultHandlerInterface
     */
    private $resultHandler;

    /**
     * SingUpHandler constructor.
     * @param UserRepositoryInterface $repository
     * @param ResultHandlerInterface $resultHandler
     */
    public function __construct(
        UserRepositoryInterface $repository,
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
        return $this->repository->addUser($commandQuery)
            ? $this->resultHandler
                ->setStatusCode(201) // ->setResult(["id" => 1])
            : $this->resultHandler
                ->setErrors(["database" => ["problem-connecting-database"]])
                ->setStatusCode();
    }
}
