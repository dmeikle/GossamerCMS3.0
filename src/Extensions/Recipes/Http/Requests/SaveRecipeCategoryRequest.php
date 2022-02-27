<?php

namespace Extensions\Recipes\Http\Requests;

use Extensions\Recipes\DTOs\RecipeCategoryDTO;
use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Http\Requests\PostRequest;

class SaveRecipeCategoryRequest extends PostRequest
{

    public function post(): DTOInterface
    {
        return new RecipeCategoryDTO(
            $this->id,
            $this->title,
            $this->description,
            $this->cook_time,
            $this->prep_time,
            $this->instructions
        );
    }
}
