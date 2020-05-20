<?php


namespace BulletinBoard\UserModule\Infrastructure\Interfaces;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\UserModule\Infrastructure\Modals\User;

interface UserRepositoryInterface
{
    /**
     * @param CommandQueryInterface $commandQuery
     * @return bool
     */
    public function addUser(CommandQueryInterface $commandQuery): bool;

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
