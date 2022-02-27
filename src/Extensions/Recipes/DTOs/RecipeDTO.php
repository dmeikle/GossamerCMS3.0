<?php

namespace Extensions\Recipes\DTOs;

use Components\Blogs\DTOs\BlogDTO;
use Gossamer\Core\DTOs\DTOInterface;

class RecipeDTO implements DTOInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var BlogDTO
     */
    private $blogDTO;


    /**
     * @var string
     */
    private $cook_time;


    /**
     * @var string
     */
    private $prep_time;



    /**
     * @var array|null
     */
    private $commentDTOs;

    /**
     * @param  string|null  $id
     * @param  BlogDTO      $blogDTO
     * @param  string       $cook_time
     * @param  string       $prep_time
     * @param  array|null   $commentDTOs
     */
    public function __construct(
        string $id = null,
        BlogDTO $blogDTO,
        string $cook_time,
        string $prep_time,
        array $commentDTOs = null
    ) {
        $this->id = $id;
        $this->blogDTO = $blogDTO;
        $this->cook_time = $cook_time;
        $this->prep_time = $prep_time;
        $this->commentDTOs = $commentDTOs;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }



    /**
     * @return string
     */
    public function getCookTime(): string
    {
        return $this->cook_time;
    }

    /**
     * @return string
     */
    public function getPrepTime(): string
    {
        return $this->prep_time;
    }


    /**
     * @return array|null
     */
    public function getCommentDTOs(): ?array
    {
        return $this->commentDTOs;
    }

    /**
     * @return BlogDTO
     */
    public function getBlogDTO(): BlogDTO
    {
        return $this->blogDTO;
    }

}
