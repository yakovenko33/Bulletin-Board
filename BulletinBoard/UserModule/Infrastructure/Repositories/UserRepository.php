<?php


namespace BulletinBoard\UserModule\Infrastructure\Repositories;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use BulletinBoard\UserModule\Infrastructure\Interfaces\UserRepositoryInterface;
use BulletinBoard\UserModule\Infrastructure\Modals\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param CommandQueryInterface $commandQuery
     * @return bool|null
     */
    public function addUser(CommandQueryInterface $commandQuery): ?User
    {
        try {
            $user = User::create([
                "first_name" => $commandQuery->getFirstName(),
                "last_name" => $commandQuery->getLastName(),
                "email" => $commandQuery->getEmail(),
                "password" => Hash::make($commandQuery->getPassword(), [
                    'rounds' => 12
                ]),
            ]);

            $user->save();
        } catch(QueryException $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            $user = null;
        }

        return $user;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        try {
            $user = User::where('email', $email)->first();
            //throw new \Exception("123");
        } catch (QueryException $e) { //Exception
            Log::error($e->getMessage() . $e->getTraceAsString());
            $user = null;
        }

        return $user;
    }
}
