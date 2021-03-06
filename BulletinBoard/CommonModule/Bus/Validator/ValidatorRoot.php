<?php


namespace BulletinBoard\CommonModule\Bus\Validator;


use BulletinBoard\CommonModule\Bus\Command\CommandQueryInterface;
use Illuminate\Contracts\Validation\Validator as Result;
use Illuminate\Support\Facades\Validator;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;
use League\Tactician\Middleware;

abstract class ValidatorRoot implements Middleware
{
    /**
     * @var ResultHandlerInterface
     */
    protected $resultHandler;

    /**
     * UserRegisterValidator constructor.
     * @param ResultHandlerInterface $resultHandler
     */
    public function __construct(ResultHandlerInterface $resultHandler)
    {
        $this->resultHandler = $resultHandler;
    }

    /**
     * @param CommandQueryInterface $command
     * @param callable $next
     * @return ResultHandlerInterface
     */
    public function execute($command, callable $next)
    {
        return  $this->validate($command->toArray()) ? $next($command) : $this->resultHandler;
    }

    /**
     * @param array $data
     * @return bool
     */
    private function validate(array $data): bool //protected
    {
        $validator = $this->make($data);
        if ($validator->fails()) {
            $this->resultHandler
                ->setErrors($validator->errors()->getMessages())//;
                ->setStatusCode(422);

            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return Result
     */
    private function make(array $data = [])
    {
        return Validator::make($data, $this->getRules(),  $this->getMessagesValidator());//self::MESSAGES_VALIDATOR
    }

    /**
     * @return array
     */
    abstract protected function getRules(): array;

    /**
     * @return array
     */
    abstract protected function getMessagesValidator(): array;
}
