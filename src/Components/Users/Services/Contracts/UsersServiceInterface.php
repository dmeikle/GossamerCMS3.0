<?php

namespace Components\Users\Services\Contracts;

use Components\Users\DTOs\UserDTO;
use Components\Users\Models\User;

interface UsersServiceInterface
{
    public function save(UserDTO $userDto) : User;

    public function list(int $offset, int $limit);

    public function get(string $id) : User;
}