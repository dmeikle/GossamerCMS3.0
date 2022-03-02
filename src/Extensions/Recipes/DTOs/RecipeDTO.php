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
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var string
     */
    private string $contents;

    /**
     * @var string
     */
    private string $slug;

    /**
     * @var string
     */
    private string $keywords;


    /**
     * @var string
     */
    private $cook_time;


    /**
     * @var string
     */
    private $prep_time;


    private int $blog_categories_id;

    /**
     * @var array|null
     */
    private $commentDTOs;

    /**
     * @var array|null
     */
    private $ratingsDTOs;

    /**
     * @var string
     */
    private string $blogs_id;



    /**
     * @param  string|null  $id
     * @param  BlogDTO      $blogDTO
     * @param  string       $cook_time
     * @param  string       $prep_time
     * @param  array|null   $commentDTOs
     */
    public function __construct(
        string $id = null,
        string $blogs_id,
        string $title,
        string $description,
        string $contents,
        string $slug,
        string $keywords,
        int $blog_categories_id,
        string $cook_time,
        string $prep_time,
        array $commentDTOs = null,
        array $ratingsDTOs = null
    ) {
        $this->id = $id;
        $this->blogs_id = $blogs_id;
        $this->title = $title;
        $this->description = $description;
        $this->contents = $contents;
        $this->slug = $slug;
        $this->keywords = $keywords;
        $this->blog_categories_id = $blog_categories_id;
        $this->cook_time = $cook_time;
        $this->prep_time = $prep_time;
        $this->commentDTOs = $commentDTOs;
        $this->ratingsDTOs = $ratingsDTOs;
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
     * @return int
     */
    public function getBlogCategoriesId(): int
    {
        return $this->blog_categories_id;
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
    public function getContents(): string
    {
        return $this->contents;
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
    public function getKeywords(): string
    {
        return $this->keywords;
    }

    /**
     * @return array|null
     */
    public function getRatingsDTOs(): ?array
    {
        return $this->ratingsDTOs;
    }

    public function getTotalRatings() : int {
        return count($this->ratingsDTOs);
    }

    public function getRatingScore() : float {
        $total = 0;
        foreach($this->ratingsDTOs as $ratingsDTO) {
            $total += $ratingsDTO->getRating();
        }

        return $total / $this->getTotalRatings();
    }

    /**
     * @return string
     */
    public function getBlogsId(): string
    {
        return $this->blogs_id;
    }
}
