<?php


namespace BulletinBoard\UserModule\Infrastructure\Repositories;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\UserModule\Application\AddAdvert\Command\AddAdvert;
use BulletinBoard\UserModule\Infrastructure\Interfaces\AdvertRepositoryInterface;
use BulletinBoard\UserModule\Infrastructure\Modals\Advert;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Ramsey\Collection\Collection;

class AdvertRepository implements AdvertRepositoryInterface
{
    /**
     * @param CommandQueryInterface $commandQuery
     * @return bool
     */
    public function addAdvert(CommandQueryInterface $commandQuery): ?Advert
    {
        try {
            $advert = Advert::create([
                "user_id" => $commandQuery->getUserId(),
                "headline" => $commandQuery->getHeadline(),
                "text" => $commandQuery->getText(),
                "image" => $commandQuery->getImage()->hashName()
            ]);

            $advert->save();
        } catch (QueryException $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            $advert = null;
        }

        return $advert;
    }
}
