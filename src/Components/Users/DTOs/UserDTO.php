<?php

namespace Components\Users\DTOs;

use Gossamer\Core\DTOs\AbstractDTO;
use Gossamer\Core\DTOs\DTOInterface;

class UserDTO extends AbstractDTO implements DTOInterface
{

    /**
     * @var string
     */
    private string $lastname;

    /**
     * @Param string
     */
    private $id;

    /**
     * @Param string
     */
    private $firstname;

    /**
     * @Param string
     */
    private $createdAt;


    public function __construct(string $id = null, string $firstname, string $lastname, string $createdAt = null)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->createdAt = $createdAt;
    }

    /**
     * @param  int
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname() : string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname() : string {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }




}
