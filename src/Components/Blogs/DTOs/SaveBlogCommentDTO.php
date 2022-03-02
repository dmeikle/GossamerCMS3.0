<?php

namespace Components\Blogs\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class SaveBlogCommentDTO implements DTOInterface
{

    /**
     * @var string
     */
    private $blogs_id;

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
     * @param  string  $blogs_id
     * @param  string  $comment
     */
    public function __construct(string $blogs_id, string $comment, string $userId)
    {
        $this->blogs_id = $blogs_id;
        $this->comment = $comment;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getBlogsId(): string
    {
        return $this->blogs_id;
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


    public function getId(): ?string
    {
        return null;
    }
}
