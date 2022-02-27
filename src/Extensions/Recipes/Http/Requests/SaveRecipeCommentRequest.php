<?php

namespace Extensions\Recipes\Http\Requests;

use Extensions\Recipes\DTOs\SaveRecipeCommentDTO;
use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Http\Requests\PostRequest;

class SaveRecipeCommentRequest extends PostRequest implements DTOInterface
{

    public function post(): DTOInterface
    {

        return new SaveRecipeCommentDTO(
            $this->recipe_id,
            $this->comment
        );
    }

    public function getId(): ?string
    {
        return $this->recipe_id;
    }
}
