<?php

namespace Components\Blogs\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class BlogCommentDTO implements DTOInterface
{

    private string $firstname;

    private string $lastname;

    private string $created_at;

    private string $comment;

    /**
     * @param  string  $firstname
     * @param  string  $lastname
     * @param  string  $created_at
     * @param  string  $comment
     */
    public function __construct(
        string $firstname,
        string $lastname,
        string $created_at,
        string $comment
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->created_at = $created_at;
        $this->comment = $comment;
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
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }


    public function getId(): ?string
    {
        // TODO: Implement getId() method.
    }
}
