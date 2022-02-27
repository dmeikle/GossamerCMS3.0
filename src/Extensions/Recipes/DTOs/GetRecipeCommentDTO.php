<?php

namespace Extensions\Recipes\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class GetRecipeCommentDTO implements DTOInterface
{

    private string $id;
    private string $comment;
    private string $name;

    public function __construct(string $id, string $comment, string $name) {
        $this->id = $id;
        $this->comment = $comment;
        $this->name = $name;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
