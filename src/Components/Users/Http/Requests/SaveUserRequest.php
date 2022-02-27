<?php

namespace Components\Users\Http\Requests;

use Components\Users\DTOs\UserDTO;
use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Http\Requests\PostRequest;

class SaveUserRequest extends PostRequest
{


    public function post(): DTOInterface
    {
       return new UserDTO(
           $this->id,
            $this->firstname,
           $this->lastname
       );

    }
}
