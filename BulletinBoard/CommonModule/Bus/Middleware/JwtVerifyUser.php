<?php


namespace BulletinBoard\CommonModule\JWT\Middleware;


use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use BulletinBoard\CommonModule\Bus\JWT\JwtDecorator;
use Illuminate\Support\Facades\Log;
use League\Tactician\Middleware;

class JwtVerifyUser implements Middleware
{
    /**
     * @var ResultHandlerInterface
     */
    private $resultHandler;

    /**
     * UserRegisterValidator constructor.
     * @param ResultHandlerInterface $resultHandler
     */
    public function __construct(ResultHandlerInterface $resultHandler)
    {
        $this->resultHandler = $resultHandler;
    }

    /**
     * @param object $command
     * @param callable $next
     * @return ResultHandlerInterface|mixed
     */
    public function execute($command, callable $next)
    {
        try {
            $decoded = JwtDecorator::getDataByToken($command->getJwtToken());
            Log::error($decoded->data->id);
            $command->setUserId($decoded->data->id);
        } catch (\Exception $e) {
            $this->resultHandler
                ->setErrors(["authorization" => ["User authorization failed."]])
                ->setStatusCode(403);

            return $this->resultHandler;
        }

        return $next($command);
    }
}
