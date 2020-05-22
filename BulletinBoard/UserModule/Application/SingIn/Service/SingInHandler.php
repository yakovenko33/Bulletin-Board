<?php


namespace BulletinBoard\UserModule\Application\SingIn\Service;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\CommonModule\Bus\JWT\JwtDecorator;
use BulletinBoard\CommonModule\Exception\ProblemWithDatabase;
use BulletinBoard\UserModule\Application\SingIn\Exception\CheckPassword;
use BulletinBoard\UserModule\Infrastructure\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use BulletinBoard\UserModule\Infrastructure\Modals\User;

class SingInHandler
{
    /**
     * @var ResultHandlerInterface
     */
    private $resultHandler;

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * SingInHandler constructor.
     * @param ResultHandlerInterface $resultHandler
     * @param UserRepositoryInterface $repository
     */
    public function __construct(
        ResultHandlerInterface $resultHandler,
        UserRepositoryInterface $repository
    ) {
        $this->resultHandler = $resultHandler;
        $this->repository = $repository;
    }

    /**
     * @param CommandQueryInterface $commandQuery
     * @return ResultHandlerInterface
     */
    public function handle(CommandQueryInterface $commandQuery): ResultHandlerInterface
    {
        try {
            if (!$user = $this->repository->findByEmail($commandQuery->getEmail())) {
                throw new ProblemWithDatabase();
            }

            $this->checkPassword($commandQuery, $user);
            $this->resultHandler
                ->setResult([
                    "jwt_token" => JwtDecorator::createToken($user->toJwtArray())
                ]);
        } catch (ProblemWithDatabase $e) {
            $this->resultHandler->setErrors($e->getError())->setStatusCode();
        } catch (CheckPassword $e) {
            $this->resultHandler->setErrors($e->getError())->setStatusCode(401);
        }

        return $this->resultHandler;
    }

    /**
     * @param CommandQueryInterface $commandQuery
     * @param User $user
     * @throws CheckPassword
     */
    private function checkPassword(CommandQueryInterface $commandQuery, User $user): void
    {
        if (!Hash::check($commandQuery->getPassword(), $user->password)) {
            throw new CheckPassword();
        }
    }
}
