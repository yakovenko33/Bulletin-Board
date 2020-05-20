<?php


namespace BulletinBoard\CommonModule\Bus\Validator;


use Illuminate\Contracts\Validation\Validator as Result;
use Illuminate\Support\Facades\Validator;
use BulletinBoard\CommonModule\Bus\Handler\ResultHandlerInterface;

abstract class ValidatorRoot
{
    /**
     * @var ResultHandlerInterface
     */
    protected $resultHandler;

    /**
     * @var array
     */
    const MESSAGES_VALIDATOR = [
        'required' => ':attribute-is-required',
        'max' => ":attribute-greater-than-:max",
    ];

    /**
     * UserRegisterValidator constructor.
     * @param ResultHandlerInterface $resultHandler
     */
    public function __construct(ResultHandlerInterface $resultHandler)
    {
        $this->resultHandler = $resultHandler;
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function validate(array $data): bool
    {
        $validator = $this->make($data);
        if ($validator->fails()) {
            $this->resultHandler
                ->setErrors($validator->errors()->getMessages())//;
                ->setStatusCode(400);

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
        return Validator::make($data, $this->getRules(), self::MESSAGES_VALIDATOR);
    }

    /**
     * @return array
     */
    abstract protected function getRules(): array;


}
