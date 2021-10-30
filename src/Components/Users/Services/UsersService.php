<?php

namespace Components\Users\Services;

use Components\Users\DTOs\UserDTO;
use Components\Users\Models\User;
use Components\Users\Services\Contracts\UsersServiceInterface;
use Gossamer\Pesedget\Database\Utils\ListResult;
use Illuminate\Support\Facades\DB;

class UsersService  implements UsersServiceInterface
{

    public function save(UserDTO $userDto) : User{

        $user = User::updateOrCreate(
            [
                'id' => $this->getKey($userDto),
                'firstname' => $userDto->getFirstname()
            ]
        );

        return $user;
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