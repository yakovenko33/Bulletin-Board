<?php


namespace BulletinBoard\UserModule\Infrastructure\Interfaces;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;

interface AdvertRepositoryInterface
{
    /**
     * @param CommandQueryInterface $commandQuery
     * @return bool
     */
    public function addAdvert(CommandQueryInterface $commandQuery): bool;
}
