<?php

namespace Components\Blogs\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class BlogDTO implements DTOInterface
{

    

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
     * @var int
     */
    private int $blog_categories_id;

    /**
     * @param  string|null $id
     * @param  string  $title
     * @param  string  $description
     * @param  string  $contents
     * @param  string  $slug
     * @param  string  $keywords
     * @param  int     $blog_categories_id
     */
    public function __construct(
        string $id = null,
        string $title,
        string $description,
        string $contents,
        string $slug,
        string $keywords,
        int $blog_categories_id
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->contents = $contents;
        $this->slug = $slug;
        $this->keywords = $keywords;
        $this->blog_categories_id = $blog_categories_id;
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
     * @return int
     */
    public function getBlogCategoriesId(): int
    {
        return $this->blog_categories_id;
    }

    public function getId(): ?string
    {
       return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

}
