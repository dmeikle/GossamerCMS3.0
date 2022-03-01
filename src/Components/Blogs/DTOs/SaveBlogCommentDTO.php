<?php

namespace Extensions\Recipes\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class SaveRecipeCommentDTO implements DTOInterface
{

    /**
     * @var string
     */
    private $recipes_id;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $userId;



    /**
     * @param  string  $id
     * @param  string  $recipes_id
     * @param  string  $comment
     */
    public function __construct(string $recipes_id, string $comment, string $userId)
    {
        $this->recipes_id = $recipes_id;
        $this->comment = $comment;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getRecipesId(): string
    {
        return $this->recipes_id;
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
    public function getUserId(): string
    {
        return $this->userId;
    }


    public function getId(): string
    {
        return '';
    }
}
