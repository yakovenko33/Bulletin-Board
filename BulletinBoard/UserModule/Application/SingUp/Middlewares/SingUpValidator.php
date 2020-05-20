<?php


namespace BulletinBoard\UserModule\Application\SingUp\Middlewares;


use League\Tactician\Middleware;
use BulletinBoard\CommonModule\Bus\Validator\ValidatorRoot;

class SingUpValidator extends ValidatorRoot implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     * @return mixed|void
     */
    public function execute($command, callable $next)
    {
       return  $this->validate($command->toArray()) ? $next($command) : $this->resultHandler;
    }

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            "first-name" => 'required|string|max:50|',
            "last-name" => 'required|string|max:50|',
            "email" => 'required|string|max:50|unique:users,email|email:rfc,dns', //unique:users,email|
            "password" => 'required|string|max:50|'
        ];
    }
}
