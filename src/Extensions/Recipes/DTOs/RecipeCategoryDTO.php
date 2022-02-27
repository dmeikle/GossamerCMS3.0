<?php

namespace Extensions\Recipes\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class RecipeCategoryDTO implements DTOInterface
{

    private string $id;

    private string $title;

    private string $description;

    private string $keywords;

    private string $slug;

    private string $image;

    /**
     * @param  string  $id
     * @param  string  $title
     * @param  string  $description
     * @param  string  $keywords
     * @param  string  $slug
     * @param  string  $image
     */
    public function __construct(
        string $id,
        string $title,
        string $description,
        string $keywords,
        string $slug,
        string $image
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->slug = $slug;
        $this->image = $image;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->keywords;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }


}
