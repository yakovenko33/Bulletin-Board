<?php


namespace BulletinBoard\UserModule\Application\SingUp\Service;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\CommonModule\Bus\JWT\JwtDecorator;
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
        if ($user = $this->repository->addUser($commandQuery)) {
            $this->resultHandler->setResult(["jwt_token" => JwtDecorator::createToken($user->toJwtArray())])
                ->setStatusCode(201);
        } else {
            $this->resultHandler
                ->setErrors(["database" => ["Проблемы на сервере, попробуйте позже."]]) //problem-connecting-database
                ->setStatusCode();
        }

        return $this->resultHandler;
        /*return $this->repository->addUser($commandQuery)
            ? $this->resultHandler->setResult()
                ->setStatusCode(201) // ->setResult(["id" => 1])
            : $this->resultHandler
                ->setErrors(["database" => ["Проблемы на сервере, попробуйте позже."]]) //problem-connecting-database
                ->setStatusCode();*/
    }
}
