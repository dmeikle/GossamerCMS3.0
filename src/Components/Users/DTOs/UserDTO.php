<?php

namespace Components\Users\DTOs;

use Gossamer\Core\DTOs\AbstractDTO;
use Gossamer\Core\DTOs\DTOInterface;

class UserDTO extends AbstractDTO implements DTOInterface
{

    public function __construct(string $id = '', string $firstname, TestDTO $testDTO = null)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->testDTO = $testDTO;
    }

    /**
     * @var TestDTO|null
     */
    private $testDTO;

    /**
     * @Param string
     */
    private $id;

    /**
     * @Param string
     */
    private $firstname;

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
     * @return TestDTO
     */
    public function getTestDTO(): TestDTO
    {
        return $this->testDTO;
    }

}