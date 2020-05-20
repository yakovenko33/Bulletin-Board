<?php


namespace BulletinBoard\UserModule\UI\Controllers;


use App\Http\Controllers\Controller;
use BulletinBoard\CommonModule\UI\Response\Response;
use BulletinBoard\UserModule\Application\SingIn\Middlewares\SingInValidator;
use BulletinBoard\UserModule\Application\SingIn\Query\SingIn;
use BulletinBoard\UserModule\Application\SingIn\Service\SingInHandler;
use BulletinBoard\UserModule\Application\SingUp\Command\SingUp;
use BulletinBoard\UserModule\Application\SingUp\Middlewares\SingUpValidator;
use BulletinBoard\UserModule\Application\SingUp\Service\SingUpHandler;
use Illuminate\Http\JsonResponse;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Response;

    /**
     * @var
     */
    private $bus;

    /**
     * UserController constructor.
     * @param CommandBusInterface $bus
     */
    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function test(Request $request): JsonResponse
    {
        if (!$result = null) {
            $result = "not null";
        } else {
            $result = "null";
        }
        return response()->json(['data' => $result]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function singUp(Request $request): JsonResponse
    {
        $this->bus->addHandler(SingUp::class, SingUpHandler::class);
        $resultHandler = $this->bus->dispatch(
            SingUp::class,
            $request->all(),
            [SingUpValidator::class]
        );

        return $this->getResponse($resultHandler); //return response()->json(["result" => "work/"]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function singIn(Request $request): JsonResponse
    {
        $this->bus->addHandler(SingIn::class, SingInHandler::class);
        $resultHandler = $this->bus->dispatch(
            SingIn::class,
            $request->all(),
            [SingInValidator::class]
        );

        return $this->getResponse($resultHandler);
    }
}
