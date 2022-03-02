<?php

namespace Extensions\Recipes\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class RecipeRatingDTO implements DTOInterface
{
    private string $firstname;

    private string $lastname;

    private int $rating;

    private string $created_at;

    /**
     * @param  string  $firstname
     * @param  string  $lastname
     * @param  int     $rating
     * @param  string  $created_at
     */
    public function __construct(
        string $firstname,
        string $lastname,
        int $rating,
        string $created_at
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->rating = $rating;
        $this->created_at = $created_at;
    }


    public function getId(): ?string
    {
        // TODO: Implement getId() method.
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
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
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }


}
