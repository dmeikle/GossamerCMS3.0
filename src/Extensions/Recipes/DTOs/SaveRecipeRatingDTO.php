<?php

namespace Extensions\Recipes\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class SaveRecipeRatingDTO implements DTOInterface
{

    private $id;

    private string $recipesId;

    private int $rating;

    private string $usersId;

    /**
     * @param  string  $id
     * @param  string  $recipes_id
     * @param  int     $rating
     */
    public function __construct(string $id = null, string $recipesId, int $rating, string $usersId)
    {
        $this->id = $id;
        $this->recipesId = $recipesId;
        $this->rating = $rating;
        $this->usersId = $usersId;
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRecipesId(): string
    {
        return $this->recipesId;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getUsersId(): string
    {
        return $this->usersId;
    }


}
