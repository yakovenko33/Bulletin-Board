<?php


namespace BulletinBoard\UserModule\UI\Controllers;


use App\Http\Controllers\Controller;
use BulletinBoard\CommonModule\UI\Response\Response;
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
        return response()->json(['data' => "work"]);
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
}
