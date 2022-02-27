<?php

namespace Extensions\Recipes\Http\Requests;

use Extensions\Recipes\DTOs\RecipeDTO;
use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Http\Requests\PostRequest;

class SaveRecipeRequest extends PostRequest
{

    public function post(): DTOInterface
    {
        return new RecipeDTO(
            $this->id,
            $this->title,
            $this->description,
            $this->cook_time,
            $this->prep_time,
            $this->instructions,
            $this->keywords,
            $this->slug,
            array()
        );
    }
}
