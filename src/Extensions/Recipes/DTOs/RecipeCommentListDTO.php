<?php

namespace Extensions\Recipes\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class RecipeCommentListDTO implements DTOInterface
{


    private array $commentDTOs;

    public function __construct(array $commentDTOs)
    {
        $this->commentDTOs = $commentDTOs;
    }

    public function getId(): ?string
    {
        return null;
    }

    public function getCommentDTOs()
    {
        return $this->commentDTOs;
    }
}
