<?php

namespace Components\Users\Services;

use Components\Users\DTOs\UserDTO;
use Components\Users\Models\User;
use Components\Users\Services\Contracts\UsersServiceInterface;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Pesedget\Database\Utils\ListResult;

class UsersService extends AbstractService implements UsersServiceInterface
{

    public function save(UserDTO $userDto) : User {
        return User::updateOrCreate(
            [
                'id' => $this->getKey($userDto),
                'firstname' => $userDto->getFirstname(),
                'lastname' => $userDto->getLastname(),
                'created_at' => $userDto->getCreatedAt()
            ]
        );
    }

    public function list(int $offset, int $limit)
    {
        $query = User::query();
        $max = $query->get()->count();

        // apply offset & limit only if provided
        if ($limit > 0) {
            $query = $query->take($limit);

            if ($offset > 0) {
                $query = $query->skip($offset);
            }
        }

        $result = $query->get();

        return new ListResult($max, $result);
    }

    public function get(string $id) : User {

        return User::where('id', $id)->first();
    }
}
