<?php

namespace Components\Users\Controllers;

use Components\Users\DTOs\TestDTO;
use Components\Users\DTOs\UserDTO;
use Components\Users\Http\Requests\SaveUserRequest;
use Components\Users\Models\User;
use Components\Users\Services\TestService;
use Components\Users\Services\UsersService;
use Gossamer\Core\Http\Responses\SuccessResponse;
use Gossamer\Core\MVC\AbstractController;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Neith\Logging\LoggingInterface;

class UsersController extends AbstractController
{
    #[Injected('Components\Users\Services\UsersService')]
    private $usersService;

    protected $testService;

    public function __construct(EventDispatcher $eventDispatcher, LoggingInterface $logger, UsersService $usersService, TestService $testService) {
        parent::__construct($eventDispatcher, $logger);
        $this->usersService = $usersService;
        $this->testService = $testService;
    }

    public function get2($id)
    {echo 'here';
        dd($id);

    }

    public function get(User $user)
    {
        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(new UserDTO(
                $user->id,
                $user->firstname,
                new TestDTO('this is a test')
            )));

    }

    public function listall($offset, $limit)
    {
        $result = $this->usersService->list($offset, $limit);
        $list = $result->getList()->toArray();

        array_walk($list, function($user, $key) use (&$results) {

            $results[] = new UserDTO(
                $user['id'],
                $user['firstname'],
                new TestDTO('this is a test')
            );
        });

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody($results));
    }

    public function save(SaveUserRequest $request) {

        $user = $this->usersService->save($request->post());

        return $this->render((new SuccessResponse())
            ->setStatus('success')
            ->setCode(200)
            ->setBody(
                new UserDTO(
                    $user->id,
                    $user->firstname,
                    new TestDTO('this is a test')
                ))
           );
    }
}