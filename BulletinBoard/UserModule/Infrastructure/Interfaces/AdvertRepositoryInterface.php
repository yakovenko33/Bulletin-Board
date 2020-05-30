<?php


namespace BulletinBoard\UserModule\Infrastructure\Interfaces;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\UserModule\Infrastructure\Modals\Advert;

interface AdvertRepositoryInterface
{
    /**
     * @param CommandQueryInterface $commandQuery
     * @return bool
     */
    public function addAdvert(CommandQueryInterface $commandQuery): ?Advert;
}
