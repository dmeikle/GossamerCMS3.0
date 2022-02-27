<?php

namespace Extensions\Recipes\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class DeleteRecipeCommentDTO implements DTOInterface
{

    private string $id;
    private string $deleted_date;

    public function __construct(string $id, string $deleted_date) {
        $this->id = $id;
        $this->deleted_date = $deleted_date;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDeletedDate(): string
    {
        return $this->deleted_date;
    }

}
