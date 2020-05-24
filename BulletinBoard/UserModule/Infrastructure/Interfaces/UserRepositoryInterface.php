<?php


namespace BulletinBoard\UserModule\Infrastructure\Interfaces;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\UserModule\Infrastructure\Modals\User;

interface UserRepositoryInterface
{
    /**
     * @param CommandQueryInterface $commandQuery
     * @return User|null
     */
    public function addUser(CommandQueryInterface $commandQuery): ?User;

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;
}
