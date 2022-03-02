<?php

namespace Extensions\Recipes\Http\Requests;

use Components\Blogs\DTOs\SaveBlogCommentDTO;
use Gossamer\Core\DTOs\DTOInterface;
use Gossamer\Core\Http\Requests\PostRequest;

class SaveRecipeCommentRequest extends PostRequest implements DTOInterface
{

    public function post(): DTOInterface
    {

        return new SaveBlogCommentDTO(
            $this->recipe_id,
            $this->comment
        );
    }

    public function getId(): ?string
    {
        return $this->recipe_id;
    }
}
