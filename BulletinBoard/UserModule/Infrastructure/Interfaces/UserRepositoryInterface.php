<?php


namespace BulletinBoard\UserModule\Infrastructure\Interfaces;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;

interface UserRepositoryInterface
{
    /**
     * @param CommandQueryInterface $commandQuery
     * @return bool
     */
    public function addUser(CommandQueryInterface $commandQuery): bool;
}
